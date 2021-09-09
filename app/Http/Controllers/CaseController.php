<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\UserCase;
use App\Models\User;
use App\Models\CaseReceiver;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class CaseController extends Controller
{
    public function showManageCases()
    {
        return view('dashboard.pages.manage_cases');
    }

    public function storeCase(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'location' => 'required|string',
            'violence' => 'required|integer',
            'details' => 'required|string',
            'activist' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $user_case = new UserCase();

        $user_case->users_id = $request->user()->id;

        $user_case->violences_id = $request->violence;

        $user_case->location = $request->location;

        $user_case->details = $request->details;




        //dd($user_case);

        if (!$user_case->save()) 
        {
            return back()->with('error', 'Failed to report your case. Please try again later.');
        }


        if ($request->activist == 0)
        {
            $all_activists = User::where('type', 2)->get();

            if (count($all_activists) > 0) 
            {
                foreach ($all_activists as $activist) 
                {
                    $case_receiver = new CaseReceiver();

                    $case_receiver->users_id = $activist->id;

                    $case_receiver->user_cases_id = $user_case->id;

                    $case_receiver->save();
                }
            }

            return back()->with(['success' => 'Your case has been reported successfully']);
        } 

        else 

        {
            $case_receiver = new CaseReceiver();

            $case_receiver->users_id = $request->activist;

            $case_receiver->user_cases_id = $user_case->id;

            if ($case_receiver->save()) {
                // echo 'Yo';
                // return redirect()->route('report.case')->with('success', 'Your case has been reported successfully');
              return back()->with('success', 'Your case has been reported successfully');
              
            }
        }
    }
}
