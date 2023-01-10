<?php 
namespace App\Models;

use CodeIgniter\Model;

class Concept extends Model{
    protected $table = 'concepto';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    protected $allowedFields  = [
        'id_kpi',
        'descripcion'
    ];
}