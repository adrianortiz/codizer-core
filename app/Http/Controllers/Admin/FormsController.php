<?php

namespace App\Http\Controllers\Admin;

use App\Dvarchar;
use App\Form;
use App\Input;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FormsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forms = Form::where('user_id', Auth::user()->id)->paginate(5);
        return view('admin.colections.index', compact('forms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.colections.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\EditFormRequest $request)
    {
        $form = new Form($request->all());
        $form->save();
        return \Redirect::route('admin.colecciones.index');
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
        $form = Form::findOrFail($id);
        $tiene = Form::where('user_id', Auth::user()->id)
            ->where('id', $id)->count();

        if($tiene == 1)
            return view('admin.colections.edit', compact('form'));
        else
            return \Redirect::route('admin.colecciones.index');

        return null;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\EditFormRequest $request, $id)
    {
        $form = Form::findOrFail($id);
        $form->fill($request->all());
        $form->save();

        return \Redirect::route('admin.colecciones.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {

        $form = Form::findOrFail($id);
        $form->delete();

        Input::where('form_id', $id)->delete();
        Dvarchar::where('form_id', $id)->delete();

        $message = 'La colección ' . $form->name . ' fue eliminada';

        if ($request->ajax()) {
            return response()->json([
                'message' => $message
            ]);
        }

        Session::flash('message', $message);
        return \Redirect::route('admin.colecciones.index');
    }
}
