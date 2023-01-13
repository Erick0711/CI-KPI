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

    function instanceKpi()
    {
        $instance = new Kpi;
        return $instance;
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



        $longConcept = array();
        foreach($array as $key => $value)
	    {
            array_push($longConcept, $key);
	    }

        $long = count($longConcept);
     
        $arrayValue = array();

        for ($i = 1; $i < $long; $i++) { 
            $value = $array[$i];
            array_push($arrayValue, $value);
    }

        $dates = $array[0];
        $lastDate = end($dates);

        // $this->addDataValue();
        return array($array, $indicador, $lastDate, $arrayValue);
    }

    
   function searchKpiData($idConcept, $value, $lastDate)
   {

            $array = ['concepto_id' => $idConcept, 'periodo' => $lastDate, 'valor' => $value];
            $query = $this->instanceKpi()->where($array)
                                        ->get();
            $data = $query->getRowArray();

            return $data;
   }

    function addAll()
    {
        $kpi = new Kpi;
        $array = $this->getValues();
        list($array, $indicador, $lastDate, $arrayValue) = $array;
        $data= $this->getConcept();

        $this->addIndicador($indicador); echo "<br>";
        $this->addConcepto(); echo "<br>";
 
        list($concept, $indicador) = $data;
        $search = $this->searchConcept($concept);

        $long = count($search);

        for ($i=0; $i < $long ; $i++) { 
            $value = end($arrayValue[$i]);
            $idConcept= $search[$i]['id'];
            $dataKpi = $this->searchKpiData($idConcept, $value, $lastDate);
            if(isset($dataKpi))
            {   
                if($dataKpi['concepto_id'] != $idConcept && $dataKpi['periodo'] != $lastDate && $dataKpi['valor'] != $value){
                    $kpiData = [
                        'sucursal' => '900',
                        'concepto_id' => $idConcept,
                        'periodo' => $lastDate,
                        'tipo_combustible' => '',
                        'producto' => '',
                        'valor' => $value
                    ];
                    $kpi->insert($kpiData);
                }else{
                    echo "Los datos ya existen";
                }
            }
        }
    }
}
