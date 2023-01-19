<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Kpi;
use App\Models\Concepto;
use CodeIgniter\Database\Query;
use App\Controllers\IndicatorController;
use App\Controllers\ConceptController;
use App\Controllers\DateController;
class KpiController extends Controller
{
    use IndicatorController, ConceptController, DateController;

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
    function convertFloat($value)
    {
        
        $deleteSpace = trim($value);
        if(substr($deleteSpace, -1) == "%"){
            $newValue = floatval($deleteSpace) / 100;
            return $newValue;
        }else{
            return floatval($value);
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
        foreach ($array as $key => $value) {
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


    function searchKpiData($idConcept, $value, $newFormatDate)
    {

        $array = ['concepto_id' => $idConcept, 'periodo' => $newFormatDate, 'valor' => $value];
        $query = $this->instanceKpi()->where($array)
                                    ->get();
        $data = $query->getRowArray();
        return $data;
    }

    function addAll()
    {
        $array = $this->getValues();
        list($array, $indicador, $lastDate, $arrayValue) = $array;

        // OBTENIENDO AÑO Y MES, CONVERTIDO A FORMATO 202101 O 202202 ++
        $year = $this->getYear($lastDate);
        $month = $this->getMonth($lastDate);
        $newFormatDate = $year.$month;
        echo $newFormatDate;

        //  OBTENIENDO EL CONCEPTO
        $data = $this->getConcept();       

        // GUARDANDO Y VALIDANDO QUE NO EXISTA DATOS DUPLICADOS DE INDICADO Y CONCEPTO
        $indicator = $this->searchIndicator($indicador);
        list($concept, $indicador) = $data;
        $searchConcept = $this->searchConcept($concept);

        if(!empty($searchConcept))
        {   
            if(isset($indicator['nombreCorto']))
            {
                $long = count($searchConcept);
                // GUADANDO TODOS LOS DATOS A LA TABLA PRINSIPAL DONDE RECORRERA CADA DATO
                for ($i = 0; $i < $long; $i++) {
                    $value = end($arrayValue[$i]);
                    $newValue = $this->convertFloat($value);
        
                    $idConcept = $searchConcept[$i]['id'];
                    $dataKpi = $this->searchKpiData($idConcept, $newValue, $newFormatDate);
        
                    if (empty($dataKpi)) {
                        $kpiData = [
                            'sucursal' => '900',
                            'concepto_id' => $idConcept,
                            'periodo' => $newFormatDate,
                            'tipo_combustible' => '',
                            'producto' => '',
                            'valor' => $newValue
                        ];
                        $this->instanceKpi()->insert($kpiData);
                    } else {
        
                        if ($dataKpi['concepto_id'] != $idConcept && $dataKpi['periodo'] != $newFormatDate && $dataKpi['valor'] != $newValue) {
                            $kpiData = [
                                'sucursal' => '900',
                                'concepto_id' => $idConcept,
                                'periodo' => $newFormatDate,
                                'tipo_combustible' => '',
                                'producto' => '',
                                'valor' => $newValue
                            ];
                            $this->instanceKpi()->insert($kpiData);
                        } else {
                            $mensaje = '<div class="alert alert-success text-center" role="alert"> Datos existentes dentro del sistema </div>';
                            return redirect()->to('kpi/rrhh')->with('menssage', $mensaje);
                        }
                    }
                }
            }
            else{
                $mensaje = '<div class="alert alert-warning text-center" role="alert"> No existe el indicador dentro del sistema </div>';
                return redirect()->to('kpi/rrhh')->with('menssage', $mensaje);
            }
        }else{
            $mensaje = '<div class="alert alert-warning text-center" role="alert"> No existe el concepto dentro del sistema </div>';
            return redirect()->to('kpi/rrhh')->with('menssage', $mensaje);
        }
    }
}
