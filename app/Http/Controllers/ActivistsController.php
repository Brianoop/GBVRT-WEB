<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ActivistData;
use App\Models\ActivistServices;
use App\Models\CaseReceiver;
use App\Models\CaseMedia;
use App\Models\UserCase;
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

        $detailed_activist_list = $this->users->join('activist_data', 'activist_data.users_id', '=', 'users.id')
        ->where('users.type', 2)
        ->select(
            'users.id as activist_id',
            'users.name as activist_name',
            'users.email as activist_email',
            'users.contact as activist_contact',
            'users.avatar as activist_avatar',
            'users.created_at as created_at',
            'activist_data.organisation_name as organisation_name',
            'activist_data.brief_description as brief_description'
        )->paginate(10);

        return view('dashboard.pages.view_activists', ['activists' =>  $detailed_activist_list]);
    }

    public function showActivistCases($id)
    {

        $all_cases = User::join('user_cases', 'users.id', '=', 'user_cases.users_id')
        ->join('violences', 'violences.id', '=', 'user_cases.violences_id')
        ->join('sub_counties', 'sub_counties.id', '=', 'user_cases.sub_counties_id')
        ->select(
            'users.*',
            'sub_counties.name as sub_county_name',
            'user_cases.id as case_id',
            'violences.name as violence_name',
            'violences.description as violence_description',
            'user_cases.details as users_case_details',
        )
        ->get();

        $new_list_of_activist_cases = [];
         
        $case_receivers_ids = CaseReceiver::where('users_id', $id);

        foreach($all_case_receivers as $case_reiver)
        {
            foreach($all_cases as $case)
            {
                if(true)
                {

                }
            }
        }


        return response()->json($activist_cases, 200);

        return view('dashboard.pages.activists_cases', ['user_cases' => $activist_cases]);
    }

    public function showActivistDetails($id)
    {
        $activist_details = $this->users->join('activist_data', 'activist_data.users_id', '=', 'users.id')
        ->where('users.type', 2)
        ->where('users.id', $id)
        ->select(
            'users.id as activist_id',
            'users.name as activist_name',
            'users.email as activist_email',
            'users.contact as activist_contact',
            'users.avatar as activist_avatar',
            'users.created_at as created_at',
            'activist_data.organisation_name as organisation_name',
            'activist_data.brief_description as brief_description',
            'activist_data.detailed_decription as detailed_description'
        )->first();

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
