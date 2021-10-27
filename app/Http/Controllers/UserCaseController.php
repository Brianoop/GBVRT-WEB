<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\UserCase;
use App\Models\User;
use App\Models\CaseReceiver;
use App\Models\CaseMedia;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserCaseController extends Controller
{
    private $user_cases;
    private $users;

    public function __construct(UserCase $user_cases, User $users)
    {
        $this->user_cases = $user_cases;

        $this->users = $users;
    }

    public function showUserCasesPage()
    {
      

        $logged_in_users_cases = $this->user_cases->join('violences', 'user_cases.violences_id', '=', 'violences.id')
        ->join('sub_counties', 'sub_counties.id', '=', 'user_cases.sub_counties_id')
        ->where('user_cases.users_id', '=', auth()->user()->id)->select(
            'user_cases.id  as case_id',
            'user_cases.details as case_details',
            'violences.name as violence_name',
            'violences.description as violence_description',
            'sub_counties.name as sub_county' 
        )
        ->paginate(10);

        return view('dashboard.pages.user_cases',[
            'user_cases' =>  $logged_in_users_cases
        ]);
    }


}
