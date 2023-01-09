<?php 
namespace App\Models;

use CodeIgniter\Model;

class Kpi extends Model{
    protected $table = 'indicador';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    protected $allowedFields  = [
        'nombre',
        'detallado',
        'tipo',
        'area'
    ];
}