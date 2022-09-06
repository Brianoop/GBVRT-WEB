<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ActivistData;
use App\Models\ActivistServices;
use App\Models\CaseReceiver;
use App\Models\CaseMedia;
use App\Models\UserCase;
use App\Models\CaseFeedback;
use Illuminate\Http\Request;

class ActivistsController extends Controller
{
    private $users;
    private $activist_data;
    private $activist_services;


    public function __construct(User $users, ActivistData $activist_data, ActivistServices $activist_services)
    {
        $this->users = $users;
        $this->activist_data = $activist_data;
        $this->activist_services = $activist_services;
    }

    public function showActivists()
    {

        $detailed_activist_list = $this->users
        ->where('users.type', 2)
        ->select(
            'users.id as activist_id',
            'users.name as activist_name',
            'users.email as activist_email',
            'users.contact as activist_contact',
            'users.avatar as activist_avatar',
            'users.created_at as created_at',
            'users.organisation_name as organisation_name',
            'users.brief_description as brief_description',
            'users.detailed_description as detailed_description'
        )->paginate(10);

        return view('dashboard.pages.view_activists', ['activists' =>  $detailed_activist_list]);
    }

    public function showActivistCases($id)
    {

        $all_cases = User::join('user_cases', 'users.id', '=', 'user_cases.users_id')
       // ->join('violences', 'violences.id', '=', 'user_cases.violences_id')
       // ->join('sub_counties', 'sub_counties.id', '=', 'user_cases.sub_counties_id')
        ->select(
            'users.*',
            'user_cases.id as case_id',
            'user_cases.details as users_case_details',
        )
        ->get();

        $new_list_of_activist_cases = [];
         
        $case_receivers = CaseReceiver::where('users_id', $id)->get();
        
        foreach($all_cases as $case)
        {
            foreach($case_receivers as $receiver) 
            {
                if($case->case_id == $receiver->user_cases_id)
                {
                    array_push($new_list_of_activist_cases, $case);
                }
            }
        }

        return view('dashboard.pages.activists_cases', ['user_cases' => $new_list_of_activist_cases]);
    }

    public function activistViewCaseDetail($id)
    {
        $case = UserCase::join('users', 'users.id', '=', 'user_cases.users_id')
        ->where('user_cases.id', $id)
        ->select(
        'user_cases.*',
        'users.name',
        'users.email',
        'users.contact'
        )
        ->first();

       // return $case;

        $feedback = User::join('case_feedback', 'users.id', '=', 'case_feedback.given_by')
        ->where('case_feedback.case_id', $id)
        ->select(
            'users.name',
            'case_feedback.*'
        )
        ->paginate(10);


       // return $feedback;

        return view('dashboard.pages.activist_view_case_detail', ['user_case' => $case, 'feedback' => $feedback]);
    }

    public function showActivistDetails($id)
    {
        $activist_details = $this->users
        ->where('users.type', 2)
        ->where('users.id', $id)
        ->select(
            'users.id as activist_id',
            'users.name as activist_name',
            'users.email as activist_email',
            'users.contact as activist_contact',
            'users.avatar as activist_avatar',
            'users.created_at as created_at',
            'users.organisation_name as organisation_name',
            'users.brief_description as brief_description',
            'users.detailed_description as detailed_description'
        )
        ->first();

        $activist_services = $this->activist_services::where('users_id', $id)->get();

        return view('dashboard.pages.activist_detail_page', [
            'activist' => $activist_details,
            'activist_services' => $activist_services
        ]);
    }

    public function showReportActivist($id)
    {
        return view('dashboard.pages.report_activist', [
            'id' => $id
        ]);
    }



    
}
