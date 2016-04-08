<?php

namespace App\Http\Controllers\Admin\Search;

use App\Facades\Core;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;

class SearchController extends Controller
{

    /**
     * Busqueda global para usuarios, productos y tiendas
     *
     * @param $searh
     */
    public function searchGlobal(Request $request) {

        if ($request->ajax()) {

            $users      = Core::searchGlobalUser($request->input('searh-global'));
            $items      = Core::searchGlobalItem($request->input('searh-global'));
            $stores     = Core::searchGlobalStore($request->input('searh-global'));
            $message    = "Great search ;)";

            $url = URL::to('/');
            $urlImgUser = $url . '/media/photo-perfil/';
            $urlImgItem = $url . '/media/photo-product/';
            $urlImgStore = $url . '/media/photo-store/';

            return response()->json([
                'message'       => $message,
                'items'         => $items,
                'urlImgItem'    => $urlImgItem,
                'users'         => $users,
                'urlImgUser'    => $urlImgUser,
                'stores'        => $stores,
                'urlImgStore'   => $urlImgStore,
                'url'           => $url
            ]);
        }

        abort(404);
        // Petición normal
        // return $users;

    }

}
