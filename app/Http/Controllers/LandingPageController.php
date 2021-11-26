<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Carbon\Carbon;

class LandingPageController extends Controller
{
    public function index()
    {
        return view('landing_page');
    }

    public function chartsPage()
    {
        return view('chart');
    }

    public function visualsPage()
    {
        $year = ['2015','2016','2017','2018','2019','2020', '2021'];

        $user = [];
        foreach ($year as $key => $value) {
            $user[] = User::where(\DB::raw("DATE_FORMAT(created_at, '%Y')"),$value)->count();
        }

    	return view('visual')->with('year',json_encode($year,JSON_NUMERIC_CHECK))->with('user',json_encode($user,JSON_NUMERIC_CHECK));
    }

    public function sleekPage()
    {
        $record = User::select(\DB::raw("COUNT(*) as count"), \DB::raw("DAYNAME(created_at) as day_name"), \DB::raw("DAY(created_at) as day"))
        ->where('created_at', '>', Carbon::today()->subDay(6))
        ->groupBy('day_name','day')
        ->orderBy('day')
        ->get();
     
         $data = [];
    
         foreach($record as $row) {
            $data['label'][] = $row->day_name;
            $data['data'][] = (int) $row->count;
          }
    
        $data['chart_data'] = json_encode($data);
        return view('sleek', $data);
    }


}
