<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function listClientes() {
        $clientes = Cliente::listarClientes();

        return response()->json(["clientes" => $clientes]);
    }

    public function kpiClientes() {
        $clientes = Cliente::kpiClientes();

        return response()->json(["clientes" => $clientes]);
    }

    public function crearcliente(Request $request) {
        $cliente = new Cliente();
        $cliente->nombre = $request->nombre;
        $cliente->apellido = $request->apellido;
        $cliente->fecha_nacimiento = date("Y-m-d", strtotime($request->fecha_nacimiento));
        $cliente->save();

        return response()->json(["cliente" => $cliente]);
    }
}
