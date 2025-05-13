<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function allData1 (){
        Return View('Dashboard.Admin');
    }

    public function allData2 (){
        $orders = Pesanan::latest()->take(10)->get(); 
        Return View('Dashboard.Kasir', compact('orders'));
    }

    public function allData3 (){
        $pesanan = Pesanan::latest()->take(10)->get(); 
        Return View('Dashboard.StaffDapur', compact('pesanan'));    
    }

}
