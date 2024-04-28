<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre', 'apellido', 'fecha_nacimiento', 'fecha_muerte'];

    public function listClientes() {
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

    static function calcularEdadPromedio() {
        $edadPromedio = DB::table('clientes')
            ->select(DB::raw('AVG(YEAR(now()) - YEAR(fecha_nacimiento)) as edad'))
            ->first();

        return number_format($edadPromedio->edad, 2);
    }

    static function calcularDesviacionEstandar() {
        $desviacionEstandar = DB::table('clientes')
            ->select(DB::raw('STD(YEAR(now()) - YEAR(fecha_nacimiento)) as edad'))
            ->first();

        return number_format($desviacionEstandar->edad, 2);
    }

    public function kpiDeClientes() {
        return [
            'edadPromedio' => self::calcularEdadPromedio(),
            'desviacionEstandar' => self::calcularDesviacionEstandar(),
        ];
    }

    public function creaCliente(Request $request) {
        $cliente = self::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'fecha_nacimiento' => Carbon::createFromFormat('d-m-Y', $request->fecha_nacimiento),
            'fecha_muerte' => $this->fechaProbableMuerte($request->fecha_nacimiento)
        ]);
        
        return $cliente;
    }

    public function toArray() {
        $clientes = [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'fechaNacimiento' => Carbon::parse($this->fecha_nacimiento)->format('d-m-Y'),
            'edad' => $this->calcularEdad(),
            'fechaProbableMuerte' => Carbon::parse($this->fecha_muerte)->format('d-m-Y')
        ];

        return $clientes;
    }
}
