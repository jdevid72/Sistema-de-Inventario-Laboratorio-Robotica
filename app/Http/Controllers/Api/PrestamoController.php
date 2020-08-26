<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Prestamo;
use App\User;
use Illuminate\Support\Facades\Auth;

class PrestamoController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prestamo = Prestamo::with('user', 'material', 'persona')->get();
        return response()->json($prestamo);
    }
    public function allProducts()
    {
        $prestamo = Prestamo::latest()->paginate(2);
        return response()->json($prestamo);
    }


    public function getUser($id)
    {
        $user = User::where('id', $id)->first();
        return response()->json($user);
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
            'persona_id' => 'required|numeric',
            'material_id' => 'required|numeric',
            'cantidad_prestamo' => 'required|numeric',
            'fecha_prestamo' => 'required|date',

        ]);

        $p = new Prestamo();
        $p->persona_id = $request->persona_id;
        $p->material_id = $request->material_id;
        $p->user_id = rand(1, 2);
        $p->cantidad_prestamo = $request->cantidad_prestamo;
        $p->persona_idev = $request->persona_idev;
        $p->fecha_prestamo = $request->fecha_prestamo;
        $p->fecha_devolucion = $request->fecha_devolucion;
        $p->save();
        return response()->json(['success' => 'Se Agrego el Prestamo']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prestamo = Prestamo::where('id', $id)->first();
        return response()->json($prestamo);
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
            'persona_id' => 'required|numeric',
            'material_id' => 'required|numeric',
            'cantidad_prestamo' => 'required|numeric',
            'persona_idev' => 'required',
            'fecha_prestamo' => 'required|date',
            'fecha_devolucion' => 'required|date',


        ]);

        $p = Prestamo::where('id', $id)->first();

        $p->persona_id = $request->persona_id;
        $p->material_id = $request->material_id;
        $p->user_id = $request->user_id;
        $p->cantidad_prestamo = $request->cantidad_prestamo;
        $p->persona_idev = $request->persona_idev;
        $p->fecha_prestamo = $request->fecha_prestamo;
        $p->fecha_devolucion = $request->fecha_devolucion;
        $p->status = 2;
        $p->save();
        return response()->json(['success' => 'Actualizar Prestamo']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prestamo = Prestamo::where('id', $id)->first();
        $photo = $prestamo->image;
        if ($photo) {
            unlink($photo);
            $prestamo->delete();
        } else {
            $prestamo->delete();
        }
    }
}
