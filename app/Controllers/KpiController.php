<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Kpi;
class KpiController extends Controller
{
    function main()
    {
        return view('rrhh/main');
    }
    function ausentismo()
    {
        return view('rrhh/add');
    }
}