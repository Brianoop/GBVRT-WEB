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
use App\Models\CaseFeedback;
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

        $logged_in_users_cases = $this->user_cases
        ->where('users_id', '=', auth()->user()->id)
        ->count();
        
        $total =  $logged_in_users_cases;

        $logged_in_users_cases = $this->user_cases
        ->where('user_cases.users_id', '=', auth()->user()->id)
        ->paginate(10);

         

        return view('dashboard.pages.user_cases',[
            'user_cases' =>  $logged_in_users_cases,
            'total' => $total
        ]);
    }

    public function showUserCaseDetailPage($id){

        $logged_in_users_case = $this->user_cases
        //->join('users', 'user_cases.users_id', '=', 'users.id')
       // ->join('sub_counties', 'sub_counties.id', '=', 'user_cases.sub_counties_id')
        ->where('user_cases.id', '=', $id)
        ->select()
        ->first();

         $activists = $this->users->join('case_receivers', 'users.id', '=', 'case_receivers.users_id')  
         ->where('case_receivers.user_cases_id', $logged_in_users_case->id)
         ->select(
             'users.id as activist_id',
             'users.name as activist_name',
             'users.email as activist_email',
             'users.contact as activist_contact',
             'users.avatar as activist_avatar',
             'users.organisation_name as activist_organisation_name',
             'users.brief_description as activist_brief_description',
             'users.detailed_description as activist_detailed_description',
         )
         ->paginate(10);

         foreach($activists as $activist)
         {
            $feedback_count = CaseFeedback::where(['case_id' => $logged_in_users_case->id, 'given_by' => $activist->id])
            ->get()
            ->count();

            $activist->feedback_count = $feedback_count;
         }

    

       
       

        return view('dashboard.pages.user_case_detail', [
            'user_case' => $logged_in_users_case,
            'activists' => $activists
        ]);
    }

    public function showUserViewActivistFeedbackOnCasePage(Request $request)
    {
        $request->validate([
            'case_id' => 'required',
            'activist_id' => 'required'
        ]);

         $user_case = UserCase::find($request->case_id);
         $activist = User::find($request->activist_id);
         $feedback = CaseFeedback::where(['case_id' => $request->case_id,
          'given_by' => $request->activist_id])
         ->latest()
         ->paginate(5);
       
        return view('dashboard.pages.view_activist_feedback_on_case', [
            'user_case' => $user_case,
            'activist' => $activist,
            'feedback' => $feedback
        ]);
    }

  


    function deleteUserCase(Request $request)
    {
        $request->validate([
            'case_id' => 'required|string'
        ]);

        try
        {
            $user_case = $this->user_cases::findOrFail($request->case_id);
        }
        catch(ModelNotFoundException $e)
        {
          return back();
        }

        if($user_case->delete())
        {
            return response()->json("success");
            
        }
        else 
        {
            return response()->json("failed!");
           
        }
    }


}
