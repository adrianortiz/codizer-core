<?php

namespace App\Http\Controllers\Admin;

use App\Dvarchar;
use App\Form;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DvarcharController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {

        $form = Form::findOrFail($id);

        // Columnas de los datos
        $dTitlesColums = DB::table('dvarchars')
            ->distinct()
            ->select('dtitle')
            ->where('form_id', $id)
            ->groupBy('input_id')
            ->get();


        // Filas de la tabla
        $dTitlesRows = DB::table('dvarchars')
            ->distinct()
            ->select('row_id')
            ->where('form_id', $id)
            ->where('content', 'LIKE', "%" .trim($request->get('content')). "%")
            ->groupBy('row_id')
            ->paginate(40);


        // CREAR ARRAY
        $arrayRows = array();
        foreach ($dTitlesRows as $dTitlesRow) {
            $arrayRows[] = Dvarchar::where('form_id', '=', $id)
                ->where('row_id', '=', $dTitlesRow->row_id)
                ->groupBy('input_id')
                ->get();
        }


        //dd($arrayRows);
        $numList = 1;
        $rowIdDelete = 0;
        return view('admin.colections.complements.listaDatos', compact('form', 'inputs', 'dTitlesColums', 'numList', 'dTitlesRows', 'arrayRows', 'rowIdDelete'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $content = Dvarchar::changeValToTypeValidation(
            Dvarchar::findOrFail($id)->type_validation,
            $request->input('content'));

        DB::update('update dvarchars set content = ? where id = ?', [ $content, $id]);

        $message = 'Registro actualizado';

        if ($request->ajax()) {
            return response()->json([
                'message' => $message,
                'content' => $content
            ]);
        }

        Session::flash('message', $message);
        return \Redirect::route('admin.colecciones.complements.listaDatos');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $input = Dvarchar::where('row_id', $id);
        $input->delete();

        $message = 'Registro eliminado';

        if ($request->ajax()) {
            return response()->json([
                'message' => $message
            ]);
        }

        Session::flash('message', $message);
        return \Redirect::route('admin.colecciones.complements.listaDatos');

    }


    /**
     * @param Request $request
     * @param $id = form_id
     */

    public function storeFormData(Request $request, $id)
    {

        // dd( $request->all());
        $typeValidations = ['val_text', 'val_text_num', 'val_num', 'val_double', 'val_date'];


        $newRowId = Dvarchar::getNewRowId( $id );

        foreach( $typeValidations as $typeValidation)
        {
            if ($request->has( $typeValidation ))
                Dvarchar::storeData( $request, $id, $typeValidation, $newRowId);
        }

        $message = 'Datos almacenados';
        Session::flash('message', $message);
        return \Redirect::route('admin.colecciones.form.data.index', $id);
    }
}
