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
        $userPerfil = Core::getUserPerfil();
        $userContacto = Core::getUserContact();
        $perfil = $userPerfil;
        $contacto = $userContacto;

        // Nos aseguramos de que la ruta sea la del usuario logueado
        if ( $nameFirstName != $userPerfil[0]->perfil_route)
            return \Redirect::route('notes', $userPerfil[0]->perfil_route);

        Core::isRouteValid($userPerfil[0]->perfil_route);

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
        if ($request->ajax()) {

            $note = new Note([
                'content' => $request['content'],
                'users_id' => \Auth::id()
            ]);

            if ( $note->save() )
                $message = 'Nota creada.';
            else
                $message = 'No se pudo crear la nota.';

            $note->content = substr($note->content, 0, 41).'...';

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
        if ($request->ajax()) {

            $note = Note::where('id', $request['id'])->get();

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
        if ($request->ajax()) {

            $note = Note::findOrFail($request['id']);
            $note->fill($request->all());

            $msg = "";
            if( $note->save() )
                $msg = "Nota actualizada";
            else
                $msg = "Ocurrio un error";

            $note->content = substr($note->content, 0, 41).'...';

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
        if ($request->ajax()) {
            $msg = "";
            if( Note::destroy($request['id']) )
                $msg = "Nota eliminada";
            else
                $msg = "Ocurrio un error";

            return response()->json([
                'message' => $msg
            ]);
        } else {
            abort(404);
        }
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {

            // Search all notes from connected user and note content name
            $notes = Note::where('users_id', \Auth::id())
                ->where('content', 'LIKE', '%'.$request['content'].'%')
                ->orderBy('updated_at', 'asc')
                ->get();

            return response()->json([
                'notes'    => $notes
            ]);

        } else {
            abort(404);
        }
    }
}
