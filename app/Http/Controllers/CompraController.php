<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CompraProveedorMail;


class CompraController extends Controller
{
    public function index()
    {
        $compras = Compra::all();
        return view('admin.compras.index',compact('compras'));
    }

    public function create()
    {
        $proveedores = Proveedor::all();
        $productos = Producto::all();
        $sucursales = Sucursal::all();
        return view('admin.compras.create',compact('proveedores','productos','sucursales'));
    }

   public function store(Request $request)
   {
       //return response()->json($request->all());
       $request->validate([
        'proveedor_id' => 'required|exists:proveedors,id',
        'fecha' => 'required|date',
        'observaciones' => 'nullable|string|max:255',
       ]);

       $compra = new Compra();
       $compra->proveedor_id = $request->proveedor_id;
       $compra->fecha = $request->fecha;
       $compra->observaciones = $request->observaciones;
       $compra->total = 0;
       $compra->estado = 'Pendiente';
       $compra->save();

       return redirect()->route('compras.edit', $compra->id)
       ->with('mensaje', 'Compra creada exitosamente, ahora puede añadir productos')
       ->with('icono', 'success');
       
   }

   public function edit($id)
   {
    $compra = Compra::findOrFail($id);
    $proveedores = Proveedor::all();
    $productos = Producto::all();
    $sucursales = Sucursal::all();
    return view('admin.compras.edit',compact('compra','proveedores','sucursales','productos'));
   }

   public function enviarCorreo(Compra $compra){

    $compra->load('detalles.producto','proveedor');

    $compra->estado = 'Enviado al proveedor';

    $compra->save();

    $proveedorEmail = $compra->proveedor->email;

    Mail::to($proveedorEmail)->send(new CompraProveedorMail($compra));
    
    return redirect()->route('compras.edit', $compra->id) 
    ->with('mensaje', 'Correo enviado exitosamente al proveedor')
    ->with('icono', 'success');
   }

   
    
}
