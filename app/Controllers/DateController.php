<?php

namespace App\Controllers;

use CodeIgniter\Controller;

trait DateController
{
    function newDate($lastDate)
    {
        $newDate = explode(' ', $lastDate);
        $month = $newDate[0];
        $year = $newDate[1];
        return [$month, $year];
    }
    function getMonth($lastDate)
    {
        $array = $this->newDate($lastDate);
        list($month, $year) = $array;

        $months = [
            'ENERO' => '01',
            'FEBRERO' => '02',
            'MARZO' => '03',
            'ABRIL' => '04',
            'MAYO' => '05',
            'JUNIO' => '06',
            'JULIO' => '07',
            'AGOSTO' => '08',
            'SEPTIEMBRE' => '09',
            'OCTUBRE' => '10',
            'NOVIEMBRE' => '11',
            'DICIEMBRE' => '12'
        ];

        foreach ($months as $MM => $value) {
            if ($MM == $month) {
                return $value;
            }
        }
    }

    function getYear($lastDate)
    {
        $array = $this->newDate($lastDate);
        list($month, $year) = $array;
        $years = [
            '21' => '2021',
            '22' => '2022',
            '23' => '2023',
            '24' => '2024',
            '25' => '2025',
            '26' => '2026',
            '27' => '2027'
        ];
        foreach ($years as $YY => $value) {
            if($YY == $year){
                return $value;
            }
        }
    }
}
