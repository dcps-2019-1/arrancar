<?php

namespace App\Http\Controllers;

use Auth;
use App\Conductor;
use App\Empresa;
use App\Viaje;
use App\Ruta;
use App\Bus;
use Illuminate\Http\Request;

class ViajeController extends Controller
{
    public function listarRutas(){
        $empresa = Empresa::where('user_id', Auth::id())->first();
        return view('empresa.programar-viaje',["empresa"=>$empresa,"user"=>Auth::user()]);
    }

    public function registrarViaje()
    {
        $datos = request();

        $datos = request()->validate([
            "bus" => ["required", "exists:buses,placa", "regex:/[aA-zZ][aA-zZ][aA-zZ][\W|\s]{0,1}[0-9][0-9][0-9]/"],
            "fecha" => "required|date|after:today",
            "hora" => "required|date_format:H:i",
            "precio" =>"required|numeric|min:1",
            "ruta" => "required|exists:rutas,id",
            "conductor" => "required|exists:conductores,id"
        ], [
            "bus.required" => "El bus es requerido",
            "bus.regex" => "La placa del bus no tiene un formato válido",
            "bus.exists" => "La placa del bus no existe en la base de datos",
            "fecha.required" => "La fecha de entrada es requerida",
            "fecha.date" => "Se debe especificar un formato de fecha",
            "fecha.after" => "La fecha de salida debe ser después de hoy",
            "hora.required" => "La hora de salida es requerida",
            "hora.date_format" => "El formato de la hora no es válido",
            "precio.required" => "El precio es requerido",
            "precio.numeric" => "El precio ingresado debe ser de tipo numérico",
            "precio.min" => "El precio ingresado debe ser mayor a 1",
            "ruta.required" => "La ruta es requerida",
            "ruta.exists" => "La ruta ingresada no existe",
            "conductor.required" => "El conductor es requerido",
            "conductor.exists" => "El conductor no existe en la base de datos",
        ]);

        $empresa = Empresa::where('user_id', Auth::id())->first();
        $viaje = Viaje::create(["fecha"=>$datos["fecha"], "hora"=>$datos["hora"], "precio"=>$datos["precio"], "ruta_id"=>$datos["ruta"]
        , "empresa_id"=>$empresa->id, "conductor_id"=>$datos["conductor"], "bus_placa"=>$datos["bus"]]);
        if ($viaje->wasRecentlyCreated == true) {
            return redirect()->back()->with('alert', 'Viaje agregado exitosamente');
        }
    }
}
