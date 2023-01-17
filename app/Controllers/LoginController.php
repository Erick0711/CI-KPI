<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\UserAgent;

class LoginController extends Controller
{
    function index()    
    {
        return view('rrhh/login');
    }
    function login()
    {
        $data = $this->request->getPost();
        $agent = $this->request->getUserAgent();

        $SO = $agent->getPlatform();
        $IP = $this->request->getIPAddress();
        echo $SO ." - ". $IP. " - ". $data['user'] . " - ". $data['password'];
    }
}