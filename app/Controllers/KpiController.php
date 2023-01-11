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

    function getValues()
    {   
        $data = $this->convertArray();

        list($array, $indicador) = $data;

        $long = count($array[1]);
        for ($i = 0; $i < $long; $i++) {
            unset($array[$i][0]);
        }

        $value = $array;

        $arrayValue = array();

        for ($i = 1; $i < 3; $i++) { 
            $value = $array[$i];
            array_push($arrayValue, $value);
    }

        $dates = $array[0];
        $lastDate = end($dates);

        // $this->addDataValue();
        return array($array, $indicador, $lastDate, $arrayValue);
    }

    function addAll()
    {
        $kpi = new Kpi;
        $array = $this->getValues();
        list($array, $indicador, $lastDate, $arrayValue) = $array;
        $data= $this->getConcept();

        // $this->addIndicador($indicador); echo "<br>";
        $this->addConcepto(); echo "<br>";
 
        // list($concept, $indicador) = $data;
        // $search = $this->searchConcept($concept);
        // $long = count($search);

        // for ($i=0; $i < $long ; $i++) { 
        //     $value = end($arrayValue[$i]);
        //     $idConcept= $search[$i]['id'];

        //     $kpiData = [
        //         'sucursal' => '900',
        //         'concepto_id' => $idConcept,
        //         'periodo' => $lastDate,
        //         'tipo_combustible' => '',
        //         'producto' => '',
        //         'valor' => $value
        //     ];
        //     $kpi->insert($kpiData);
        //     echo $value;
        // }
    }
}
