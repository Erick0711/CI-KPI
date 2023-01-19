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
        $query =  $this->instanceIndicator()->where('nombreCorto', $name)
                                            ->get();
        $data = $query->getRowArray();
        
        return $data;
    }

    function addIndicador($indicador)
    {
        $ArrayIndicator = $this->searchIndicator($indicador);

        if (empty($ArrayIndicator)) {
            $data = [
                'idIndicador' => '',
                'orden' => '',
                'nombreCorto' => $indicador,
                'nombreLargo' => '(TT-HH)',
                'tipo' => 'M',
                'area' => 'Recursos Humanos',
                'formula' => ''
            ];
            $this->instanceIndicator()->insert($data);
        } else {
            if ($ArrayIndicator['nombreCorto'] == $indicador) {
                echo "El indicador ya existe";
            }
        }
    }
}