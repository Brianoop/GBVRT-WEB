<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Violence;
use App\Models\SubCounties;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    

    public function showReportCasePage()
    {
        return view('dashboard.pages.report_case', ['activists' => User::where('type', 2)->get(), 'violence' => Violence::all(), 'sub_counties' => SubCounties::all()]);
    }

    public function showSendComplaintPage()
    {
        return view('dashboard.pages.send_complaint');
    }
}
