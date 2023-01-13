<?php

namespace App\Controllers;

class Home extends BaseController
{
    function main()
    {
        return view('rrhh/main');
    }
    function ausentismo()
    {
        return view('rrhh/kpi');
    }
}
