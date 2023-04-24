<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    protected $cliente = null;
    
    public function __construct(Cliente $cliente) {
		$this->cliente = $cliente;
    }
    
    public function listClientes() {
        $clientes = Cliente::listarClientes();

        return response()->json([
            'status' => 'OK',
            'data' => $clientes
        ]);
    }

    public function kpiClientes() {
        $clientes = Cliente::kpiClientes();

        return response()->json([
            'status' => 'OK',
            'data' => $clientes
        ]);
    }

    public function creaCliente(Request $request) {
        try {
            $request->validate([
                'nombre' => 'required|max:50',
                'apellido' => 'required|max:50',
                'fecha_nacimiento' => 'required|date',
            ]);

            $this->cliente->creaCliente($request);
    
            return response()->json([
                'cliente' => [
                    'status' => 'OK',
                    'message' => 'El cliente se ha agregado correctamente!'
                ]
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}
