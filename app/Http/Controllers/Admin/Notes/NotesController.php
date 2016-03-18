<?php

namespace App\Http\Controllers\Admin\Notes;

use App\Facades\Core;
use App\Note;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($nameFirstName)
    {
        Core::isRouteValid($nameFirstName);

        $perfil = Core::getPerfil($nameFirstName);
        $contacto = Core::getContact($perfil);

        // User son los datos del usuario Logueado
        $userPerfil = Core::getUserPerfil();
        $userContacto = Core::getUserContact();

        // All notes from connected user
        $notes = Note::where('users_id', \Auth::id())
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('admin.Notes.notes', compact('perfil', 'contacto', 'userPerfil', 'userContacto', 'notes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $note = new Note([
            'content' => $request['content'],
            'users_id' => \Auth::id()
        ]);

        if ( $note->save() )
            $message = 'Nota creada.';
        else
            $message = 'No se pudo crear la nota.';

        $note->content = substr($note->content, 0, 41).'...';

        if ($request->ajax()) {
            return response()->json([
                'message' => $message,
                'note' => $note
            ]);
        } else {
            abort(404);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $note = Note::where('id', $request['id'])->get();

        if ($request->ajax()) {
            return response()->json([
                'note' => $note
            ]);
        } else {
            abort(404);
        }
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
    public function update(Request $request)
    {
        $note = Note::findOrFail($request['id']);
        $note->fill($request->all());

        $msg = "";
        if( $note->save() )
            $msg = "Nota actualizada";
        else
            $msg = "Ocurrio un error";

        $note->content = substr($note->content, 0, 41).'...';

        if ($request->ajax()) {
            return response()->json([
                'message' => $msg,
                'note'    => $note
            ]);
        } else {
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $msg = "";
        if( Note::destroy($request['id']) )
            $msg = "Nota eliminada";
        else
            $msg = "Ocurrio un error";

        if ($request->ajax()) {
            return response()->json([
                'message' => $msg
            ]);
        } else {
            abort(404);
        }
    }
}
