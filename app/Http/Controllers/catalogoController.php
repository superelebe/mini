<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cate;
use App\SubCate;
use App\Ima;
use App\Produ;

class catalogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, Request $request)
    {
        $productos = Produ::obtenerProductos($id);
        $subcategoria = SubCate::findOrfail($id);
        return view('catalogo.index', compact('productos', 'subcategoria'));
    }
    public function detalleSubcate($id, Request $request)
    {
        $producto = Produ::with('Ima')->findOrfail($id);
        $tallaOrden = Produ::find($id)->talla()->orderBy('orden', 'desc')->get();
        return view('catalogo.detalle', compact('producto', 'tallaOrden'));
    }
    public function detalle($id, Request $request)
    {
        $producto = Produ::with('Ima')->findOrfail($id);
        $tallaOrden = Produ::find($id)->talla()->orderBy('orden')->get();
        dd($tallaOrden);
        return view('catalogo.detalle', compact('producto', 'tallaOrden'));
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
}
