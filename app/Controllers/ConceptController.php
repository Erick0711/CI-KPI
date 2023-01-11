<?php

namespace App\Controllers;

use App\Models\Concept;
use CodeIgniter\Controller;
use App\Controllers\IndicatorController;
trait ConceptController
{
    use IndicatorController;
    function instanceConcept()
    {
        $instance = new Concept();
        return $instance;
    }

    function searchConcept($concepts)
    {
        $dataConcept = array();
        foreach ($concepts as $concept) {
            $query =    $this->instanceConcept()->where('descripcion', $concept)
                                                ->get();
            $data = $query->getRowArray();
            array_push($dataConcept, $data);
        }
        if (in_array(NULL, $dataConcept)) {
        } else {
            return $dataConcept;
        }
    }

    function getConcept()
    {
        $getConvert = new KpiController;
        $data = $getConvert->convertArray();
        list($arrays, $indicador) = $data;

        // $arrayConcept = array();
        echo "<pre>";
            var_dump($arrays);
            echo "</pre>";
        // foreach ($arrays as $array) {
        //     $concept = $array;
        //     // array_push($arrayConcept, $concept);
        //     echo "<pre>";
        //     var_dump($concept);
        //     echo "</pre>";
        // }

        // for ($i = 1; $i < 3; $i++) {
        //     $concept = $arrays[$i][1];
        //     array_push($arrayConcept, $concept);
        // }
        // return array($arrayConcept, $indicador);
    }

    function addConcepto()
    {
        $arreglo = $this->getConcept();
        // list($concepts, $indicador) = $arreglo;
        // print_r($concepts);
        die();
        $indicador = $this->searchIndicator($indicador);
        $searchConcepts = $this->searchConcept($concepts);

        if(!empty($indicador)){
            if (empty($searchConcepts)) {
                foreach ($concepts as $concept) {
                    $id = $indicador['id'];
                    $data = [
                        'id_kpi' => $id,
                        'descripcion' => $concept
                    ];
                    $this->instanceConcept()->insert($data);
                }
            } else {
                echo "El concepto ya existe";
            }
        }else{
            echo "No existe ningun indicador";
        }
    }
}
