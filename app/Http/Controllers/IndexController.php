<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function allData1 (){
        Return View('Dashboard.Admin');
    }

    public function allData2 (){
        Return View('Dashboard.Kasir');
    }

    public function allData3 (){
        Return View('Dashboard.StaffDapur');
    }
}
