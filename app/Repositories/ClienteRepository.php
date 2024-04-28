<?php

namespace App;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Interfaces\ClienteRepositoryInterface;

class ClienteRepository implements ClienteRepositoryInterface
{
    private $cliente;

    public function __construct(Cliente $cliente)
    {
        $this->cliente = $cliente;
    }

    public function listClientes() {
        return $this->cliente->listClientes();
    }

    public function kpiDeClientes() {
        return $this->cliente->kpiDeClientes();
    }

    public function creaCliente(Request $request) {
        return $this->cliente->creaCliente($request);
    }
}
