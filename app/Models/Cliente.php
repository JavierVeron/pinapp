<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'cliente';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre', 'apellido', 'fecha_nacimiento', 'fecha_muerte'];

    static function listarClientes() {
        return self::all();
    }

    private function calcularEdad() {
        return Carbon::parse($this->fecha_nacimiento)->age;
    }

    private function fechaProbableMuerte($fecha) {
        $dia_muerte = rand(1, 30);
        $mes_muerte = rand(0, 11);
        $anio_muerte = rand(72, 79);
        $fecha_muerte = Carbon::createFromFormat('d-m-Y', $fecha);
        $fecha_muerte->addDays($dia_muerte);
        $fecha_muerte->addMonths($mes_muerte);
        $fecha_muerte->addYears($anio_muerte);

        return $fecha_muerte;
    }

    static function kpiClientes() {
        $clientes = self::all();


    }

    public function creaCliente(Request $request) {
        $cliente = self::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'fecha_nacimiento' => date('Y-m-d', strtotime($request->fecha_nacimiento)),
            'fecha_muerte' => $this->fechaProbableMuerte($request->fecha_nacimiento)
        ]);
        
        return $cliente;
    }

    public function toArray() {
        $clientes = [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'fechaNacimiento' => date("d-m-Y", strtotime($this->fecha_nacimiento)),
            'edad' => $this->calcularEdad(),
            'fechaProbableMuerte' => $this->fecha_muerte
        ];

        return $clientes;
    }
}
