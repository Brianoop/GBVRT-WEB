<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CaseFeedback;
use App\Models\UserCase;
use App\Models\User;
use App\Models\SmsCredit;

class CaseFeedbackController extends Controller
{
    public function saveCaseFeedback(Request $request)
    {
        $request->validate([
            'feedback' => 'required|string',
            'case_id' => 'required|string',
            'given_by' => 'required|string'
        ]);

      //  return $request;

        $activist = User::find($request->given_by);

        $case = UserCase::find($request->case_id);

        $victim = User::find($case->users_id);


        $feedback = new CaseFeedback();
        $feedback->case_id = $request->case_id;
        $feedback->given_by = $request->given_by;
        $feedback->feedback = $request->feedback;

        $title = "GBV CASE FEEDBACK";
        $message_body = $request->feedback . PHP_EOL . ' Call us on: ' . 
        $activist->contact  . PHP_EOL . ' Email us on: ' . $activist->email;
        $contact = $victim->contact;

        // return array(
        //   'title' => $title,
        //   'message' => $message_body,
        //   'contact' => $contact
        // );
        
        if($feedback->save())
        {
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

                    $sms_credit = new SmsCredit();
                    $sms_credit->sms_title = $data['sms_title'];
                    $sms_credit->sms_message = $data['sms_message'];
                    $sms_credit->sms_contact = $data['sms_contact'];
                    $sms_credit->sent_to = $data['sent_to'];
                    $sms_credit->details = $data['details'];
                    $sms_credit->message_id = $data['message_id'];
                    $sms_credit->sms_credit_balance = $data['sms_credit_balance'];
                    $sms_credit->status_code = $data['status_code'];
                    $sms_credit->save();

            return back()->withSuccess('Feedback sent successfully!');
        }
        else 
        {
            return back()->withError('Failed to send feedback');
        }

    }
}
