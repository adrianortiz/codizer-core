<?php

namespace App\Http\Controllers\Admin\Social;

use App\Contacto;
use App\Facades\Core;
use App\Http\Requests;
use App\User;
use App\UserHasFollowerUser;
use App\UserHasFriendUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;

class PerfilController extends Controller
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

        $userPerfil = Core::getUserPerfil();
        $userContacto = Core::getUserContact();

        $contacts = Core::getContactos($contacto);
        $friends = Core::getAmigos($contacto);
        $followers = Core::getFollowers($contacto);

        $idUserView = User::where('contacto_id', $contacto[0]->id)
            ->select('id')
            ->first();

        $isMyFriend = UserHasFriendUser::where('users_id', \Auth::user()->id)
            ->where('users_id_friend', $idUserView->id)
            ->count();

        $amIFollower = UserHasFollowerUser::where('users_id', \Auth::user()->id)
            ->where('users_id_followers', $idUserView->id)
            ->count();

        return view('admin.social.perfil', compact('perfil', 'contacto', 'userPerfil', 'userContacto', 'contacts', 'friends', 'followers', 'idUserView', 'isMyFriend', 'amIFollower'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function updatePhotoUser(Request $request)
    {
        if ($request->ajax()) {
            // Campo file definido en el formulario
            $file = $request->file('file');

            // Nombre del archivo
            $nombre = 'photo-' .\Auth::user()->id . Carbon::now()->second . $file->getClientOriginalName();

            // Guardar archivo en el disco local
            \Storage::disk('photo')->put($nombre,  \File::get($file));

            // Guardar el nombre de la imagen en el perfil de usuario logueado
            Contacto::where('id', $request['id'])
                ->update(['foto' => $nombre]);

            // Devolver una respuesta JSON que contenga
            // la ruta de la imagen que se acaba de subir
            return response()->json([
                'cover' => URL::to('/') . '/media/photo-perfil/' . $nombre
            ]);
        }
        abort(404);
    }

    /**
     * Agrega o quita a un usuario de tu lista de amigos
     *
     * Si agregas a un usuario a tu lista de amigos
     * por defecto también serás agregado a su
     * lista de amigos y viceversa
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addOrNotAddToFriend(Request $request) {

        if ( $request->ajax() ) {

            $isMyFriend = UserHasFriendUser::where('users_id', \Auth::user()->id)
                ->where('users_id_friend', $request['id'])
                ->count();

            $result = null;

            if ($isMyFriend === 0) {

                $addFriend = new UserHasFriendUser();
                $addFriend->users_id        = \Auth::user()->id;
                $addFriend->users_id_friend = $request['id'];
                $addFriend->save();

                $addFriend = new UserHasFriendUser();
                $addFriend->users_id        = $request['id'];
                $addFriend->users_id_friend = \Auth::user()->id;
                $addFriend->save();

                $result = 1;

            } else {
                UserHasFriendUser::where('users_id', \Auth::user()->id)
                    ->where('users_id_friend', $request['id'])
                    ->delete();

                UserHasFriendUser::where('users_id', $request['id'])
                    ->where('users_id_friend', \Auth::user()->id)
                    ->delete();

                $result = 0;
            }

            return response()->json([
                'result' => $result
            ]);
        }

        abort(404);
    }


    public function addOrNotAddToFollower(Request $request) {

        if ( $request->ajax() ) {

            $amIFollower = UserHasFollowerUser::where('users_id', \Auth::user()->id)
                ->where('users_id_followers', $request['id'])
                ->count();

            $result = null;

            if ($amIFollower === 0) {

                $addFollower = new UserHasFollowerUser();
                $addFollower->users_id        = \Auth::user()->id;
                $addFollower->users_id_followers = $request['id'];
                $addFollower->save();

                $result = 1;

            } else {
                UserHasFollowerUser::where('users_id', \Auth::user()->id)
                    ->where('users_id_followers', $request['id'])
                    ->delete();

                $result = 0;
            }

            return response()->json([
                'result' => $result
            ]);
        }

    }
}
