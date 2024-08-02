<?php

namespace App\Http\Controllers;


use App\Models\Municipio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use TCG\Voyager\Http\Controllers\Controller as Controllers;

class AjaxController extends Controllers
{
    public function obtener_municipios(Request $request)
    {
        if ($request->ajax()) {
            try {
                $departamentoId = $request->departamento;
                $municipios = Municipio::where('departamento_id', $departamentoId)->get();
                return response()->json($municipios);
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
    }
}
