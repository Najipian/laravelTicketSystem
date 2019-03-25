<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $loggedAs = TENANT_USER ;
    protected $viewLocation = 'tenant';
    function __construct(){
        if(Request::is('landlord/*')){
            $this->loggedAs = LANDLORD_USER;
            $this->viewLocation = 'landlord';
        }
    }
}
