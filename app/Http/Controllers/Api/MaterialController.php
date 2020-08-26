<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Material;
use App\Model\Persona;
use Intervention\Image\Facades\Image;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $material = Material::get();
        return response()->json($material);
    }

    public function allProducts()
    {
        $material = Material::latest()->paginate(2);
        return response()->json($material);
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
            'modelo' => 'required|string',
            'caracteristicas' => 'required|string:materials',
            'cantidad_total' => 'required|numeric:materials',
            'cantidad_prestamo' => 'numeric',
            'fecha' => 'required|date',
        ]);

        $e = new Material();
        if ($request->imagen) {
            $position = strpos($request->imagen, ';');
            $sub = substr($request->imagen, 0, $position);
            $ext = explode('/', $sub)[1];
            $imageName = time() . "." . $ext;
            $img = Image::make($request->imagen)->resize(240, 240);
            $uploadPath = 'backEnd/assets/img/material/';
            $imgUrl = $uploadPath . $imageName;
            $img->save($imgUrl);
            $e->imagen = $imgUrl;
        }
        $e->nombre = $request->nombre;
        $e->modelo = $request->modelo;
        $e->caracteristicas = $request->caracteristicas;
        $e->cantidad_total = $request->cantidad_total;
        $e->cantidad_prestamo = $request->cantidad_prestamo;
        $e->fecha = $request->fecha;
        $e->save();
        return response()->json(['success' => 'Se Agrego Material']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $material = Material::where('id', $id)->first();
        return response()->json($material);
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
            'modelo' => 'required|string',
            'caracteristicas' => 'required|string:materials',
            'cantidad_total' => 'required|numeric:materials',
            'fecha' => 'required|date',
        ]);
        $e = Material::where('id', $id)->first();
        if ($request->newimagen) {
            $position = strpos($request->newimagen, ';');
            $sub = substr($request->newimagen, 0, $position);
            $ext = explode('/', $sub)[1];
            $imageName = time() . "." . $ext;
            $img = Image::make($request->newimagen)->resize(240, 240);
            $uploadPath = 'backEnd/assets/img/material/';
            $imgUrl = $uploadPath . $imageName;
            $img->save($imgUrl);
            if ($e->imagen) {
                unlink($e->imagen);
            }
            $e->imagen = $imgUrl;
        }
        $e->nombre = $request->nombre;
        $e->modelo = $request->modelo;
        $e->caracteristicas = $request->caracteristicas;
        $e->cantidad_total = $request->cantidad_total;
        $e->cantidad_prestamo = $request->cantidad_prestamo;
        $e->fecha = $request->fecha;
        $e->save();

        return response()->json(['success' => 'Actualizar Material']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $material = Material::where('id', $id)->first();
        $photo = $material->image;
        if ($photo) {
            unlink($photo);
            $material->delete();
        } else {
            $material->delete();
        }
    }
}
