<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\UserCase;
use App\Models\User;
use App\Models\CaseReceiver;
use App\Models\CaseMedia;
use App\Models\SmsCredit;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class CaseController extends Controller
{
       

    public function showManageCases()
    {
       $case_number = UserCase::get()->count();
       $cases = UserCase::join('users', 'users.id', '=', 'user_cases.users_id')
       ->select(
        'users.id as user_id',
        'users.name',
        'users.contact',
        'users.email',
        'user_cases.*')
       ->paginate(6);

   

        return view('dashboard.pages.manage_cases', ['cases' => $cases, 'case_number' => $case_number]);
    }

    public function showAdminCaseDetailPage()
    {

        return view('dashboard.pages.admin_case_detail');
    }

    public function storeCase(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'victim_name' => 'required|string',
            'victim_location' => 'required|string',
            'victim_contact' => 'required|string',
            'details' => 'required|string',
            'activist' => 'required|integer',
            'files.*' => 'max:20000'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }


        $user_case = new UserCase();

        $user_case->users_id = $request->user_id;

        $user_case->victim_name = $request->victim_name;

        $user_case->victim_location = $request->victim_location;

        $user_case->victim_contact = $request->victim_contact;

        $user_case->details = $request->details;

 

        if (!$user_case->save()) 
        {
            return back()->with('error', 'Failed to report your case. Please try again later.');
        }

        
        $title = "NEW CASE FROM " . $user_case->victim_name;

        //$contact = auth()->user()->contact;
        $message_body =  $user_case->details . ' ' . PHP_EOL . 'CONTACT ME ON: ' . $user_case->victim_contact;

        // return array(
        //     'title' => $title,
        //     'message' => $message,
        //     'contact' => "0775502474"
        // );

       

        /* STORE THE MEDIA FILES IF ANY */

        $allowed_case_media_extensions_array = ['mp4', 'mov', 'wmv', 'avi', 'avchd', 'mkv', 'mpeg', 'jpg', 'gif', 'png', 'svg','jpeg'];

        $image_files_array = ['jpg', 'gif', 'png', 'svg','jpeg'];

        $video_files_array = ['mp4', 'mov', 'wmv', 'avi', 'avchd', 'mkv'];

        if($request->hasFile('files'))
        {
            foreach($request->file('files') as $file)
            {

                $file_type = "";

                $extension = $file->extension();

                if (in_array($extension, $allowed_case_media_extensions_array) == false) 
                {
                    return back()->with([
                        'status' => false,
                        'error' => "Invalid file format ". $extension .". Allowed file formats are mp4, mov, wmv, avi, avchd, mkv, mpeg, jpg, gif, png, svg, jpeg"
                    ]);
                }


                if (in_array($extension,  $image_files_array) == true) 
                {
                    $file_type = 'IMAGE';
                }

                if (in_array($extension,  $video_files_array) == true) 
                {
                    $file_type = 'VIDEO';
                }



                $name = time().rand(1,100).'.'.$file->extension();

                $file->move(public_path('uploads/evidence/' . $file_type), $name);

                $case_media_file = new CaseMedia();
                $case_media_file->user_cases_id = $user_case->id;
                $case_media_file->file_type = $file_type;
                $case_media_file->file_extension = $extension;
                $case_media_file->file_path = 'uploads/evidence/' . $file_type . '/' . $name;
                
                if(!$case_media_file->save())
                {

                }


            }
        }
        
        $sent_messages_results = [];
       
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

                    $contact = $activist->contact;

                    $sent_sms = sendSMS($title, $message, $contact);

                 

                    $message_id = array_key_exists("message_id", $sent_sms) ? $sent_sms['message_id'] : "Error";
                    $sms_credit_balance = array_key_exists("credits", $sent_sms) ? $sent_sms['credits'] : "Error";
                    $status_code = array_key_exists("http_code", $sent_sms) ? $sent_sms['http_code'] : "Error";
                    $message = array_key_exists("message", $sent_sms) ? $sent_sms['message'] : "Error";

                    $data =   array(
                            'sms_title' => $title,
                            'sms_message' => $message_body,
                            'sms_contact' => $contact,
                            'sent_to' => $activist->id,
                            'details' => 'Reporting a GBV Case: '. $message,
                            'message_id' => $message_id,
                            'sms_credit_balance' => $sms_credit_balance,
                            'status_code' => $status_code
                        );

                    array_push($sent_messages_results, $data);
                }
            }

            foreach($sent_messages_results as $result)
            {
                $sms_credit = new SmsCredit();
                $sms_credit->sms_title = $result['sms_title'];
                $sms_credit->sms_message = $result['sms_message'];
                $sms_credit->sms_contact = $result['sms_contact'];
                $sms_credit->sent_to = $result['sent_to'];
                $sms_credit->details = $result['details'];
                $sms_credit->message_id = $result['message_id'];
                $sms_credit->sms_credit_balance = $result['sms_credit_balance'];
                $sms_credit->status_code = $result['status_code'];
                $sms_credit->save();
            }

           // return $sent_messages_results;

            return back()->with(['success' => 'Your case has been reported successfully']);
        } 

        else 

        {
            $activist = User::find($request->activist);
            $case_receiver = new CaseReceiver();
            $case_receiver->users_id = $activist->id;
            $case_receiver->user_cases_id = $user_case->id;



            if ($case_receiver->save()) {

                $contact = $activist->contact;

                $sent_sms = sendSMS($title, $message_body, $contact);
               
                $message_id = array_key_exists("message_id", $sent_sms) ? $sent_sms['message_id'] : "Error";
                $sms_credit_balance = array_key_exists("credits", $sent_sms) ? $sent_sms['credits'] : "Error";
                $status_code = array_key_exists("http_code", $sent_sms) ? $sent_sms['http_code'] : "Error";
                $message = array_key_exists("message", $sent_sms) ? $sent_sms['message'] : "Error";

                    $data =   array(
                            'sms_title' => $title,
                            'sms_message' => $message_body,
                            'sms_contact' => $contact,
                            'sent_to' => $activist->id,
                            'details' => 'Reporting a GBV Case: ' . $message,
                            'message_id' => $message_id,
                            'sms_credit_balance' => $sms_credit_balance,
                            'status_code' => $status_code
                        );

                array_push($sent_messages_results, $data);

                foreach($sent_messages_results as $result)
                {
                    $sms_credit = new SmsCredit();
                    $sms_credit->sms_title = $result['sms_title'];
                    $sms_credit->sms_message = $result['sms_message'];
                    $sms_credit->sms_contact = $result['sms_contact'];
                    $sms_credit->sent_to = $result['sent_to'];
                    $sms_credit->details = $result['details'];
                    $sms_credit->message_id = $result['message_id'];
                    $sms_credit->sms_credit_balance = $result['sms_credit_balance'];
                    $sms_credit->status_code = $result['status_code'];
                    $sms_credit->save();
                }
            
                return back()->with('success', 'Your case has been reported successfully');
              
            }
        }
    }
}
