<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'cliente';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre', 'apellido', 'fecha_nacimiento'];

    static function listarClientes() {
        return self::all();
    }

    private function fechaProbableMuerte($fecha) {
        $dia_probable_muerte = rand(1, 30);
        $mes_probable_muerte = rand(0, 11);
        $anio_probable_muerte = rand(72, 79);
        return date("d-m-Y", strtotime($fecha ."+{$dia_probable_muerte} day +{$mes_probable_muerte} month +{$anio_probable_muerte} year"));
    }

    static function kpiClientes() {
        $clientes = self::all();
    }

    public function crearCliente(Request $request) {
        $this->cliente_nombre = $request->nombre;
        $this->cliente_apellido = $request->apellido;
        $this->cliente_fecha_nacimiento = $request->fecha_nacimiento;
        $this->save();
    }

    public function toArray() {
        $clientes = [
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'fechaNacimiento' => date("d-m-Y", strtotime($this->fecha_nacimiento)),
            'fechaProbableMuerte' => $this->fechaProbableMuerte($this->fecha_nacimiento)
        ];

        return $clientes;
    }
}
