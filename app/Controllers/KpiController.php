<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Kpi;
use App\Models\Concepto;
use CodeIgniter\Database\Query;
use App\Controllers\IndicatorController;
use App\Controllers\ConceptController;
class KpiController extends Controller
{
    use IndicatorController, ConceptController;

    function main()
    {
        return view('rrhh/main');
    }
    function ausentismo()
    {
        return view('rrhh/kpi');
    }

    public function getData()
    {
        if (!empty($_POST['dato'])) {
            $data = $_POST;
            return $data;
        } else {
            return "El post dato esta vacio";
        }
    }

    function convertArray()
    {
        $getData = new KpiController;
        $data = $getData->getData();
        $getIndicador = explode("\t", $data['dato']);
        $convert = explode("\n", $data['dato']);
        $i = 0;
        $j = 0;
        foreach ($convert as $array) {
            $convert[$i] = explode("\t", $array);
            $convert[$i][0] = $j;
            $j++;
            $i++;
        }
        return array($convert, $getIndicador[0]);
    }
    function getDate(){
        $valor = $arreglo;

        $valorArreglo = array();


        for ($i = 1; $i < 3; $i++) { 
            $valor = $arreglo[$i];
            array_push($valorArreglo, $valor);
        }

    $fechas = $arreglo[0];
    $fecha = end($fechas);

    $datos = array($conceptoArreglo, $fecha, $valorArreglo);
    return $datos;
    }
    
    function getValues()
    {   
        $kpi = new KpiController;
        $data = $kpi->convertArray();

        list($array, $indicador) = $data;

        $long = count($array[1]);
        for ($i = 0; $i < $long; $i++) {
            unset($array[$i][0]);
        }
        $this->getDate();
        $this->addIndicador($indicador); echo "<br>";
        $this->addConcepto(); echo "<br>";
    }
}
