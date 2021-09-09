<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivistsController extends Controller
{
    public function showActivists()
    {
        return view('dashboard.pages.view_activists');
    }

    public function showActivistCases()
    {
        return view('dashboard.pages.activists_cases');
    }

    public function showActivistDetails()
    {
        return view('dashboard.pages.activist_detail_page');
    }

    public function showReportActivist()
    {
        return view('dashboard.pages.report_activist');
    }

    
}
