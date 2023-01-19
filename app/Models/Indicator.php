<?php 
namespace App\Models;

use CodeIgniter\Model;

class Indicator extends Model{
    protected $table = 'indicador';
    // Uncomment below if you want add primary key
    // protected $primaryKey = 'idIndicador';
    // protected $useAutoIncrement = true;

    protected $allowedFields  = [
        'idIndicador',
        'orden',
        'nombreCorto',
        'nombreLargo',
        'tipo',
        'area',
        'formula'
    ];
}