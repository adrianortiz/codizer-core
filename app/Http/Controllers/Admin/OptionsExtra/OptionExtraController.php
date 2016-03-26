<?php

namespace App\Http\Controllers\Admin\OptionsExtra;

use App\Categoria;
use App\Empresa;
use App\EmpresaHasCategoria;
use App\EmpresaHasFabricante;
use App\EmpresaHasOferta;
use App\Fabricante;
use App\Facades\Core;
use App\Oferta;
use App\Tienda;
use App\UsuarioEmpleadoInfo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OptionExtraController extends Controller
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
            return \Redirect::route('stores.index', $userPerfil[0]->perfil_route);

        Core::isRouteValid($userPerfil[0]->perfil_route);

        // Saber si el usuario tiene empresa
        $empresa = Empresa::where('users_id', \Auth::user()->id)->first();

        if ($empresa === null) {
            return view('admin.company.new-company', compact('perfil', 'contacto', 'userPerfil', 'userContacto'));

        } else {

            $countTiendas = Tienda::where('empresa_id', $empresa->id)->count();
            $countEmpleados = UsuarioEmpleadoInfo::where('empresa_id', $empresa->id)->count();

            $ofertas = Core::getOfertas($empresa->id);
            $fabricantes = Core::getFabricantes($empresa->id);
            $categorias = Core::getCategorias($empresa->id);

            return view('admin.company.extras', compact('perfil', 'contacto', 'userPerfil', 'userContacto', 'empresa', 'countTiendas', 'ofertas', 'categorias', 'fabricantes', 'countEmpleados'));
        }
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
    public function storeOferta(Request $request)
    {
        if ($request->ajax() ) {

            $oferta = new Oferta();
            $oferta->fill($request->all());
            $oferta->save();

            $empresa = Empresa::where('users_id', \Auth::user()->id)->first();

            $empresaHasOferta = new EmpresaHasOferta();
            $empresaHasOferta->empresa_id = $empresa->id;
            $empresaHasOferta->oferta_id = $oferta->id;
            $empresaHasOferta->save();

            return response()->json([
               'oferta' => $oferta
            ]);
        }
    }

    public function showOferta(Request $request)
    {
        if ($request->ajax() ) {

            $oferta = Oferta::findOrFail($request['id']);

            return response()->json([
                'oferta' => $oferta
            ]);
        }
    }

    public function updateOferta(Request $request)
    {
        if ($request->ajax() ) {

            $oferta = Oferta::findOrFail($request['id']);
            $oferta->fill($request->all());
            $oferta->save();

            return response()->json([
                'oferta' => $oferta
            ]);
        }
    }


    public function storeFabrica(Request $request)
    {
        if ($request->ajax() ) {

            $fabricante = new Fabricante();
            $fabricante->fill($request->all());
            $fabricante->save();

            $empresa = Empresa::where('users_id', \Auth::user()->id)->first();

            $empresaHasFabricante = new EmpresaHasFabricante();
            $empresaHasFabricante->empresa_id = $empresa->id;
            $empresaHasFabricante->fabricante_id = $fabricante->id;
            $empresaHasFabricante->save();

            return response()->json([
                'fabrica' => $fabricante
            ]);
        }
    }

    public function showFabrica(Request $request)
    {
        if ($request->ajax() ) {

            $fabricante = Fabricante::findOrFail($request['id']);

            return response()->json([
                'fabrica' => $fabricante
            ]);
        }
    }

    public function updateFabrica(Request $request)
    {
        if ($request->ajax() ) {

            $fabricante = Fabricante::findOrFail($request['id']);
            $fabricante->fill($request->all());
            $fabricante->save();

            return response()->json([
                'fabrica' => $fabricante
            ]);
        }
    }


    public function storeCategoria(Request $request)
    {
        if ($request->ajax() ) {

            $categoria = new Categoria();
            $categoria->fill($request->all());
            $categoria->save();

            $empresa = Empresa::where('users_id', \Auth::user()->id)->first();

            $empresaHasCategoria = new EmpresaHasCategoria();
            $empresaHasCategoria->empresa_id = $empresa->id;
            $empresaHasCategoria->categoria_id = $categoria->id;
            $empresaHasCategoria->save();

            return response()->json([
                'categoria' => $categoria
            ]);
        }
    }

    public function showCategoria(Request $request)
    {
        if ($request->ajax() ) {

            $categoria = Categoria::findOrFail($request['id']);

            return response()->json([
                'categoria' => $categoria
            ]);
        }
    }

    public function updateCategoria(Request $request)
    {
        if ($request->ajax() ) {

            $categoria = Categoria::findOrFail($request['id']);
            $categoria->fill($request->all());
            $categoria->save();

            return response()->json([
                'categoria' => $categoria
            ]);
        }
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
}
