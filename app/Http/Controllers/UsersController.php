<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Violence;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function showUsersCases()
    {
        return view('dashboard.pages.user_cases');
    }

    public function showReportCasePage()
    {
        return view('dashboard.pages.report_case', ['activists' => User::where('type', 2)->get(), 'violence' => Violence::all()]);
    }

    public function showSendComplaintPage()
    {
        return view('dashboard.pages.send_complaint');
    }
}
