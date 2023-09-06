<?php

namespace App\Http\Controllers;

use App\Models\RajaOngkirModel;
use Illuminate\Http\Request;

class RajaOngkirController extends Controller
{
    function view()
    {
        $dataProvince = RajaOngkirModel::getProvinces();
        return view('rajaongkir', compact('dataProvince'));
    }

    public function getLocation(Request $request)
    {
        $id = $request->id;
        $getLocation = RajaOngkirModel::getCity($id);
        $list = "<option></option>";
        foreach ($getLocation as $d) {
            $list .= "<option value='" . $d['city_id'] . "'>" . $d['type'] . ' ' . $d['city_name'] . "</option>";
        }
        echo json_encode($list);
    }

    public function getService(Request $request)
    {
        $jne = RajaOngkirModel::getService(["jne", $request->destination]);
        $list = "<option></option>";
        $cost = "";
        if (count($jne) > 0) {
            foreach ($jne as $s) {
                $list .= '<option value="' . $s['results'][0]['costs'][0]['cost'][0]['value'] . "-" . $s['results'][0]['costs'][0]['service'] . '-jne">' . "JNE" . " " . $s['results'][0]['costs'][0]['description'] . " Rp. " . number_format($s['results'][0]['costs'][0]['cost'][0]['value']) . " (" . $s['results'][0]['costs'][0]['service'] . ") Estimasi (" . $s['results'][0]['costs'][0]['cost'][0]['etd'] . " hari)" . '</option>';
            };
        }
        echo json_encode($list);
    }
}
