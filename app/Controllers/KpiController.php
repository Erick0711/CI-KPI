<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Kpi;
use CodeIgniter\Database\Query;

class KpiController extends Controller
{
    function searchIndicador($indicador)
    {
        $kpi = new Kpi();
        $query =    $kpi->where('nombre', $indicador)
                        ->get();
        $data = $query->getRowArray();
        // foreach($data[0] as $regis){
        //     // echo $regis['nombre'];
        // }
        print_r($data['nombre']);
    }

    function addIndicador($indicador)
    {
        $getIndicador = new KpiController;
        $arregloIndicador = ($getIndicador->searchIndicador($indicador));
        // print_r($arregloIndicador[0]['nombre']);
        print_r($arregloIndicador);
        $kpi = new Kpi();
        die();
        $data = [
            'nombre'=> $indicador,
            'detallado' => 'KPI RECURSOS HUMANOS',
            'tipo' => 'M',
            'area' => 'RRHH'
        ];
        
        $kpi->insert($data);
    }
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
    function getValues()
    {
        $getConvert = new KpiController;
        $getIndicador = new KpiController;

        $data = $getConvert->convertArray();
        list($array, $indicador) = $data;

        $long = count($array[1]);
        for ($i = 0; $i < $long; $i++) {
            unset($array[$i][0]);
        }
        // GUARDAR LOS INDICADORES
        $getIndicador->addIndicador($indicador);
        // echo "<pre>";
        // print_r($array);
        // echo "</pre>";
    }
}
