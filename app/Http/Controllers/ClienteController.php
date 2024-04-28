<?php

namespace App\Http\Controllers;

use App\ClienteRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClienteController extends Controller
{
    private $clienteRepository;
    
    public function __construct(ClienteRepository $clienteRepository) {
        $this->clienteRepository = $clienteRepository;
    }

    public function listClientes() {
        $result = $this->clienteRepository->listClientes();

        return response()->json([
            'status' => 'OK',
            'data' => $result
        ]);
    }

    public function kpiDeClientes() {
        $result = $this->clienteRepository->kpiDeClientes();

        return response()->json([
            'status' => 'OK',
            'data' => $result
        ]);
    }

    public function creaCliente(Request $request) {
        try {
            $request->validate([
                'nombre' => 'required|max:50',
                'apellido' => 'required|max:50',
                'fecha_nacimiento' => 'required|date',
            ]);

            $this->clienteRepository->creaCliente($request);
    
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
