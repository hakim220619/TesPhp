<?php

namespace App\Http\Controllers;

use App\Models\RajaOngkirModel;
use Illuminate\Http\Request;

class RajaOngkirController extends Controller
{
    function ShowProvinces() {
        $dataProvince = RajaOngkirModel::getProvinces();
        // dd($dataProvince[4]['province_id']);
        $this->showOngkir($dataProvince[4]['province_id']);
    }
    function showOngkir($id) {
        // dd($id);
        $showOngkir = RajaOngkirModel::getCity($id); 
    }
    function getService() {
        // dd($id);
        $showService = RajaOngkirModel::getService(); 
        // dd($showService);
    }
}
