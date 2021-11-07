<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\UserCase;
use App\Models\User;
use App\Models\CaseReceiver;
use App\Models\CaseMedia;
use App\Models\ActivistData;
use App\Models\ActivistServices;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserCaseController extends Controller
{
    private $user_cases;
    private $users;
    private $case_receivers;
    private $activist_services;

    public function __construct(UserCase $user_cases, User $users, CaseReceiver $case_receivers, ActivistServices $activist_services)
    {
        $this->user_cases = $user_cases;

        $this->users = $users;

        $this->case_receivers = $case_receivers;

        $this->activist_services = $activist_services;
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
        ->count();
        
        $total =  $logged_in_users_cases;

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
            'user_cases' =>  $logged_in_users_cases,
            'total' => $total
        ]);
    }

    public function showUserCaseDetailPage($id){

        $logged_in_users_case = $this->user_cases->join('violences', 'user_cases.violences_id', '=', 'violences.id')
        ->join('sub_counties', 'sub_counties.id', '=', 'user_cases.sub_counties_id')
        ->where('user_cases.id', '=', $id)->select(
            'user_cases.id  as case_id',
            'user_cases.details as case_details',
            'violences.name as violence_name',
            'violences.description as violence_description',
            'sub_counties.name as sub_county' 
        )->first();

        $case_receivers = $this->case_receivers::where('user_cases_id', $logged_in_users_case->case_id)
        ->select('users_id')
        ->get();

        $number_of_case_receivers = count($case_receivers);

        $activists_list = [];

        if($number_of_case_receivers > 0)
        {
            foreach($case_receivers as $receiver)
            {
                $case_receiver = $this->users->join('activist_data', 'activist_data.users_id', '=', 'users.id')
                ->where('users.id', $receiver->users_id)
                ->select(
                    'users.id as activist_id',
                    'users.name as activist_name',
                    'users.email as activist_email',
                    'users.contact as activist_contact',
                    'users.avatar as activist_avatar',
                    'activist_data.organisation_name as activist_organisation_name',
                    'activist_data.brief_description as activist_brief_description',
                    'activist_data.detailed_decription as activist_detailed_description'
                )->first();


                $case_receiver_services = $this->activist_services::where('users_id', $receiver->users_id)->get();

                $activist_data = array(
                    'activist' => $case_receiver,
                    'activist_sevices' => $case_receiver_services
                );

                array_push($activists_list, $activist_data);
            }
        }

       

        return view('dashboard.pages.user_case_detail', [
            'user_case' => $logged_in_users_case,
            'activists' => $activists_list
        ]);
    }

    public function showConfirmDeleteCasePage($id)
    {
        return view('dashboard.pages.confirm_delete_case', ['id' => $id]);
    }


    function deleteUserCase(Request $request)
    {
        try
        {
            $user_case = $this->user_cases::findOrFail($request->id);
        }
        catch(ModelNotFoundException $e)
        {
          return back();
        }

        if($user_case->delete())
        {
            return redirect('/user-cases');
        }
        else 
        {
            return back();
        }
    }


}
