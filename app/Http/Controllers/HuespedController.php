<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Huesped;
use App\Persona;
use App\Http\Traits\PersonaTrait;
use App\Http\Traits\HuespedTrait;
use App\Http\Traits\PagoTrait;
use Carbon\Carbon;

class HuespedController extends Controller{

  public function guardar(Request $request){

    $this->validate($request, [
      'dni'=>'required|digits:8',
      'nombres'=>'required',
      'apellidos'=>'required',
      'telefono'=>'nullable',
      'salida'=>'nullable|date',
      'habitacion_id'=>'required|exists:habitaciones,id'
    ]);

    $datosPersona = ['dni'=>$request->dni, 'nombres'=>$request->nombres, 'apellidos'=>$request->apellidos,
      'direccion'=>null, 'telefono'=>$request->telefono];
    if ($persona = Persona::where('dni', $request->dni)->first()) {
      $pesona = PersonaTrait::modificar($persona, $datosPersona);
    }else{
      $persona = PersonaTrait::guardar($datosPersona);
    }
    
    $datosHuesped = ['persona_dni'=>$persona->dni, 'habitacion_id'=>$request->habitacion_id, 
      'inicio'=>Carbon::now()->format('Y-m-d H:i:s'), 'salida'=>$request->salida];
    $huesped = HuespedTrait::guardar($datosHuesped);

    PagoTrait::guardar(['huesped_id'=>$huesped->id, 'tipo_pago_id'=>1, 'fecha'=>$huesped->inicio,
      'monto'=>$huesped->habitacion->precio]);
  }

  public function buscar($id){
    return Huesped::with('habitacion.edificio')->with('pagos.tipoPago')->with('persona')->where('id', $id)->first();
  }

  public function modificar(Request $request, $id){

    $huesped = Huesped::find($id);
    
    $datosPersona = ['dni'=>$request->dni, 'nombres'=>$request->nombres, 'apellidos'=>$request->apellidos,
      'direccion'=>null, 'telefono'=>$request->telefono];
    if ($request->dni != $huesped->persona->dni) {
      if ($persona = Persona::where('dni', $request->dni)->first()) {
        $pesona = PersonaTrait::modificar($persona, $datosPersona);
      }else{
        $persona = PersonaTrait::guardar($datosPersona);
      }
    }else{
      $pesona = PersonaTrait::modificar($huesped->persona, $datosPersona);
    }
    
    $datosHuesped = ['salida'=>$request->salida];
    $huesped = HuespedTrait::modificar($huesped, $datosHuesped);

    return redirect()->back()->with('correcto', 'EL HUESPED '.$huesped->persona->nombres.' '.
      $huesped->persona->apellidos.' FUE MODIFICADO EN LA HABITACION '.$huesped->habitacion->numero.
      ' '.$huesped->habitacion->edificio->nombre.' CON ÉXITO');
  }
  



}
