<?php

namespace App\Http\Controllers\Admin;

use App\Dvarchar;
use App\Form;
use App\Input;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    /**
     * Export all data from Dvarchar to Excel document
     */
    public function exportAll()
    {
        Excel::create('Laravel Excel', function($excel) {

            $excel->sheet('Collections', function($sheet) {
                $registros = Dvarchar::all();
                $sheet->fromArray($registros);
            });

        })->export('xls');
    }

    /*
     *
     */
    public function importAllToCollection(Request $request, $id)
    {
        /*
         * ALMACENAR ARCHIVO
         */
        //obtenemos el campo file definido en el formulario
        $file = $request->file('file');

        //obtenemos el nombre del archivo
        $nombre = Carbon::now()->second . $file->getClientOriginalName();

        //indicamos que queremos guardar un nuevo archivo en el disco local
        \Storage::disk('local')->put($nombre,  \File::get($file));

        /*
         * OBTENER ARCHIVO
         */
        $public_path = public_path();
        $url = $public_path.'/documents/'.$nombre;

        //si no se encuentra lanzamos un error 404.
        if ( !(\Storage::exists($nombre)) )
        {
            abort(404);
            // return response()->download($url);
        }


        /*
         * ALMACENAR DATOS DEL DOCUMENTO EXCEL A LA COLLECTION ASIGNADA
         */
        // Nombre Collection
        $form = Form::findOrFail($id);

        // Inputs info
        $inputs = Input::where('form_id', $id)->get( array('id', 'title', 'type_validation') );

        // asignar nuevo numero de fila
        $newRowId = Dvarchar::getNewRowId( $id );

        // Cargar archivo con callback para recuperar la información
        $array = array();
        Excel::load('documents/' . $nombre, function( $archivo ) use ( $inputs, $id )
        {

            $result = $archivo->get();
            foreach ($result as $key => $values)
            {
                $array = array();
                $control = 0;
                $newRowId = Dvarchar::getNewRowId( $id );
                foreach ( $values as $value )
                {

                    \DB::table('dvarchars')->insert([
                        'dtitle'            => (string) $inputs[$control]['title'],
                        'content'           => Dvarchar::changeValToTypeValidation( $inputs[$control]['type_validation'] , (string) $value),
                        'form_id'           => $id,
                        'input_id'          => $inputs[$control]['id'],
                        'row_id'            => $newRowId,
                        'type_validation'   => $inputs[$control]['type_validation'],
                        'created_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                        'updated_at'        => \Carbon\Carbon::now()->toDateTimeString()
                    ]);

                    $control++;

                }

            }

        })->get();


        /**
         * OPERACIONES EXTRA PARA ELIMINAR UN ARCHIVO
         */
        // Eliminar uno o mas archivos
        \Storage::delete($nombre);
        // Storage::delete(['file1.jpg', 'file2.jpg']);

        // copiar archivos a un nuevo directorio
        // Storage::copy('old/file1.jpg', 'new/file1.jpg');

        // Mover archivos a un nuevo directorio
        // Storage::move('old/file1.jpg', 'new/file1.jpg');


        $message = 'Datos almacenados';
        Session::flash('message', $message);
        return \Redirect::route('admin.colecciones.form.data.index', $id);
    }

}
