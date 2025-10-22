<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CompraProveedorMail;
use App\Models\InventarioSucursalLote;
use App\Models\MovimientoInventario;
use Illuminate\Support\Facades\DB;

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

   public function finalizarCompra(Request $request,Compra $compra){

    $compra->load('detalles.producto','proveedor');

   // $detalles = $compra->detalles();

    if($compra->detalles->isEmpty()){
        return redirect()->back()
        ->with('mensaje', 'No hay productos en la compra!!! No se puede finalizar')
        ->with('icono', 'error');
    }

    $request->validate([
        'sucursal_id' => 'required',
    ]);

    DB::beginTransaction();
        try{
          
            foreach($compra->detalles as $detalle){
                $lote = $detalle->lote;
                $producto = $detalle->producto;
               
                //actualizar la cantidad del lote en la tabla lotes
                $lote->cantidad_actual = $lote->cantidad_actual + $detalle->cantidad;
                $lote->save();

                //actualizar o crear el registro en inventario sucursales lotes
                $inventarioLote = InventarioSucursalLote::firstOrCreate([
                    'lote_id' => $lote->id,
                    'sucursal_id' => $request->sucursal_id,
                    'cantidad_en_sucursal' => 0,
                    ]);


                $inventarioLote->cantidad_en_sucursal = $inventarioLote->cantidad_en_sucursal + $detalle->cantidad;
                $inventarioLote->save();

                //registrar el la tabla movimiento_inventario
                $movimientoInventario = MovimientoInventario::create([
                    'producto_id' => $producto->id,
                    'lote_id' => $lote->id,
                    'sucursal_id' => $request->sucursal_id,
                    'tipo_movimiento' => 'Entrada',
                    'cantidad' => $detalle->cantidad,
                    'fecha' => now(),
                    
                ]);
            }

            //ACTUALIZAR EL ESTADO DE LA COMPRA
            $compra->estado = 'Finalizada';
            $compra->save();

            DB::commit();

             return redirect()->route('compras.index') 
                    ->with('mensaje', 'La xompra se finalizo exitosamente')
                    ->with('icono', 'success');

        }catch(\Exception $e){
            
            DB::rollBack();
            dd('error al finalizar compra'.$e->getMessage());

        }
    
   }
}