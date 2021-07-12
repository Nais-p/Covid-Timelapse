<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Departement;

class APIController extends Controller
{


    public static function get_all()
    {
        $ret = DB::select('SELECT * FROM data_france');
        return response(json_encode($ret), 200);
    }

    public static function get_date($date)
    {
        $ret = DB::select('SELECT * FROM data_france WHERE date = \'' . $date . '\';');
        return response(json_encode($ret), 200);
    }

    // REGION FUNCTIONS

    public static function get_region($region, $date)
    {
        $ret = DB::select('SELECT * FROM data_regions WHERE maille_code = \'' . $region . '\' AND date = \'' . $date . '\';');
        return response(json_encode($ret), 200);
    }

    public static function get_region_closest($region, $date)
    {
        $ret = DB::select('SELECT * FROM data_regions WHERE date < NOW() ORDER BY date LIMIT 1;');
        return response(json_encode($ret), 200);
    }

    // DEPARTEMENTS FUNCTIONS

    public static function get_date_dep($date)
    {
        $ret = DB::select('SELECT * FROM data_dep WHERE date = \'' . $date . '\';');
        return response(json_encode($ret), 200);
    }

    public static function get_dep($dep, $date)
    {
        $ret = DB::select('SELECT * FROM data_dep WHERE  maille_code = \'' . $dep . '\' AND date = \'' . $date . '\';');
        return response(json_encode($ret), 200);
    }

    public static function get_dep_closest($dep, $date)
    {
        $ret = DB::select('SELECT * FROM data_dep WHERE date < NOW() AND  maille_code = \'' . $dep . '\' ORDER BY date LIMIT 1;');
        return response(json_encode($ret), 200);
    }

    public static function get_dep_deaths($dep, $date)
    {
        $ret = json_encode(DB::select('SELECT * FROM data_dep WHERE  maille_code = \'' . $dep . '\' AND date = \'' . $date . '\' ORDER BY date LIMIT 1;'));
        $test = json_decode($ret[1]);
        print($test);
        return response(json_encode($ret), 200);
    }

    // GET DATE FROM COOKIE

    public static function get_current_dep($dep, Request $request)
    {
        $value = $request->cookie('date_cookie');
        $ret = DB::select('SELECT * FROM data_dep WHERE  maille_code = \'' . $dep . '\' AND date = \'' . $value . '\';');
        return response(json_encode($ret), 200);
    }

    public static function get_current_reg($dep, Request $request)
    {
        $value = $request->cookie('date_cookie');
        $ret = DB::select('SELECT * FROM data_regions WHERE  maille_code = \'' . $dep . '\' AND date = \'' . $value . '\';');
        return response(json_encode($ret), 200);
    }

    public function displayRegion(Request $request)
    {
        // récupération de la value du cookkie afin d'utiliser la date sélectionner dans la requête, si le cookie est un vide on lui attribue directement une date
        $value = $request->cookie('date_cookie');
        if (empty($value))
            $value = "2021-06-28";

        $ret = DB::select('SELECT * FROM data_dep WHERE  date = \'' . $value . '\';');
        $regions = Region::hydrate($ret);
        return view('carte')->with("region", $regions);
    }

    public function displayDepartement(Request $request)
    {
        // récupération de la value du cookkie afin d'utiliser la date sélectionner dans la requête
        $value = $request->cookie('date_cookie');
        if (empty($value))
            $value = "2021-06-28";
        
        $ret = DB::select('SELECT * FROM data_dep WHERE date = \'' . $value . '\';');
        $departements = Region::hydrate($ret);
        return view('departement')->with("departement", $departements);
    }
}
