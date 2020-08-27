<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Persona;

use Intervention\Image\Facades\Image;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $persona = Persona::with('tipo')->get();
        return response()->json($persona);
    }
    public function allProducts()
    {
        $persona = Persona::latest()->paginate(2);
        return response()->json($persona);
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
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'ci' => 'required|string|unique:personas',
            'cu' => 'required|string|unique:personas',
            'tipo_id' => 'required',
            'fecha_nacimiento' => 'required|date',

        ]);

        $p = new Persona();
        if ($request->perfil) {
            $position = strpos($request->perfil, ';');
            $sub = substr($request->perfil, 0, $position);
            $ext = explode('/', $sub)[1];
            $imageName = time() . "." . $ext;
            $img = Image::make($request->perfil)->resize(240, 240);
            $uploadPath = 'backEnd/assets/img/perfiles/';
            $imgUrl = $uploadPath . $imageName;
            $img->save($imgUrl);
            $p->perfil = $imgUrl;
        }
        $p->nombre = $request->nombre;
        $p->apellido = $request->apellido;
        $p->direccion = $request->direccion;
        $p->tipo_id = $request->tipo_id;
        $p->telefono = $request->telefono;
        $p->ci = $request->ci;
        $p->cu = $request->cu;
        $p->fecha_nacimiento = $request->fecha_nacimiento;
        $p->nombre_respaldo = $request->nombre_respaldo;
        $p->telefono_respaldo = $request->telefono_respaldo;
        $p->save();
        return response()->json(['success' => 'Se agrego Nuevo Registro Persona']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $persona = Persona::where('id', $id)->first();
        return response()->json($persona);
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
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'ci' => 'required|string:personas',
            'cu' => 'required|string:personas',
            'tipo_id' => 'required',
            'fecha_nacimiento' => 'required|date',


        ]);

        $p = Persona::where('id', $id)->first();
        if ($request->newPerfil) {
            $position = strpos($request->newPerfil, ';');
            $sub = substr($request->newPerfil, 0, $position);
            $ext = explode('/', $sub)[1];
            $imageName = time() . "." . $ext;
            $img = Image::make($request->newPerfil)->resize(240, 240);
            $uploadPath = 'backEnd/assets/img/perfiles/';
            $imgUrl = $uploadPath . $imageName;
            $img->save($imgUrl);
            if ($p->perfil) {
                unlink($p->perfil);
            }
            $p->perfil = $imgUrl;
        }
        $p->nombre = $request->nombre;
        $p->apellido = $request->apellido;
        $p->direccion = $request->direccion;
        $p->tipo_id = $request->tipo_id;
        $p->telefono = $request->telefono;
        $p->ci = $request->ci;
        $p->cu = $request->cu;
        $p->fecha_nacimiento = $request->fecha_nacimiento;
        $p->nombre_respaldo = $request->nombre_respaldo;
        $p->telefono_respaldo = $request->telefono_respaldo;
        $p->save();
        return response()->json(['success' => 'Se Actualizo el Registro']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $persona = Persona::where('id', $id)->first();
        $photo = $persona->perfil;
        if ($photo) {
            unlink($photo);
            $persona->delete();
        } else {
            $persona->delete();
        }
    }
}
