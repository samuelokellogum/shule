<?php

namespace App\Http\Controllers;

use App\GlobalModel;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Session::get('usergroupid') != null){
                $global = new GlobalModel();
                $userMenu = $global->getMenuForUser(Session::get('usergroupid'));
               view()->share('userMenu' ,$userMenu);
            }

            return $next($request);
        });

    }
}
