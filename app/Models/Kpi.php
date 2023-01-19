<?php 
namespace App\Models;

use CodeIgniter\Model;

class Kpi extends Model{
    protected $table = 'kpi_tthh';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    protected $allowedFields  = [
        'sucursal',
        'concepto_id',
        'periodo',
        'tipo_combustible',
        'producto',
        'valor'
    ];
}
