<?php 
namespace App\Controllers;
use App\Models\Indicator;
use CodeIgniter\Controller;

trait IndicatorController
{
    function instanceIndicator()
    {
        $instance = new Indicator();
        return $instance;
    }

    function searchIndicator($name)
    {
        $query =  $this->instanceIndicator()->where('nombre', $name)
                                            ->get();
        $data = $query->getRowArray();

        return $data;
    }

    function addIndicador($indicador)
    {
        $ArrayIndicator = $this->searchIndicator($indicador);

        if (empty($ArrayIndicator)) {
            $data = [
                'nombre' => $indicador,
                'detallado' => 'KPI RECURSOS HUMANOS',
                'tipo' => 'M',
                'area' => 'RRHH'
            ];
            $this->instanceIndicator()->insert($data);
        } else {
            if ($ArrayIndicator['nombre'] == $indicador) {
                echo "El indicador ya existe";
            }
        }
    }
}