<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Tipo;

class TipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo = Tipo::get();
        return response()->json($tipo);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'descripcion' => 'required|unique:tipos',
        ]);

        $tipo = new Tipo();
        $tipo->descripcion = $request->descripcion;
        $tipo->save();
        return response()->json(['success' => 'Se agrego Tipo Persona']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipo = Tipo::where('id', $id)->first();
        return response()->json($tipo);
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
        $this->validate($request, [
            'descripcion' => 'required|unique:tipos',
        ]);

        $tipo = Tipo::findOrfail($id);
        $tipo->descripcion = $request->descripcion;
        $tipo->save();
        return response()->json(['success' => 'Se actualizo con exito Tipo Persona']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipo = Tipo::where('id', $id)->first();
        $tipo->delete();
    }
}
