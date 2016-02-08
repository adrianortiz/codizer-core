<?php

namespace App\Http\Controllers\Admin;

use App\Dvarchar;
use App\Input;
use App\Form;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class InputsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Requests\CreateInputRequest $request)
    {
        // if($request->ajax()) { return response()->json([ "mensaje" => $request->all() ]); }

        //
        $existeColumn = Input::where('form_id' , $request->form_id)->where('title' , $request->title)->count();

        $msg = "";
        if( $existeColumn == 0){
            Input::create($request->all());
            $msg = "Campo creado correctamente.";
        } else {
            $msg = "El Título del campo ya existe.";
        }

        return response()->json([
           "message" => $msg
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $inputs = Input::where('form_id', $id)->get();

        return response()->json(
            $inputs->toArray()
        );
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $input = Input::findOrFail($id);
        $input->delete();

        // Destroy all content from Input = $id
        $dVarchars = Dvarchar::where('input_id', $id);
        $dVarchars->delete();

        $message = 'El Input ' . $input->name . ' y sus datos fueron eliminados';

        if ($request->ajax()) {
            return response()->json([
                'message' => $message
            ]);
        }

        Session::flash('message', $message);
        return \Redirect::route('admin.colecciones.index');
    }










    /**
     * Draw form from conllection data
     *
     * @param $id
     * @return \Illuminate\View\View
     */

    public function drawForm($id)
    {

        $form = Form::findOrFail($id);

        $inputs = Input::where('form_id', $id)->get();

        return view('admin.colections.complements.form', compact('form', 'inputs'));
    }

}
