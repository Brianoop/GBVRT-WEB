<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ActivistsController extends Controller
{
    private $users;

    public function __construct(User $users)
    {
        $this->users = $users;
    }

    public function showActivists()
    {
        $activists = $this->users::where('type', 2)->paginate(10);

        return view('dashboard.pages.view_activists', ['activists' => $activists]);
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
