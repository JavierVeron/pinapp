<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface ClienteRepositoryInterface
{
    public function listClientes();
    public function kpiDeClientes();
    public function creaCliente(Request $request);
}
