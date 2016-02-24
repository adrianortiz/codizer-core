<?php

namespace App\Http\Controllers\Admin\Search;

use App\Search;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{

    /**
     * @param $searh
     */
    public function searchGlobal(Request $request) {

        $users = Search::searchGlobal($request->input('searh-global'));
        $message = "Great search ;)";

        if ($request->ajax()) {
            return response()->json([
                'message' => $message,
                'users' => $users
            ]);
        }

        return "Ups! :(";

    }

}
