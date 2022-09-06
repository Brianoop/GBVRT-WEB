<?php 


 

if(!function_exists('loginToSMSPortal'))
{

     function loginToSMSPortal($email, $password)
    {
        $pay_load = array(
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password
        );
        $curl = curl_init();
        // We POST the data
        curl_setopt($curl, CURLOPT_POST, 1);
        // Set the url path we want to call
        curl_setopt($curl, CURLOPT_URL, config('sms.SMS_PORTAL_LOGIN_URL'));
        // Make it so the data coming back is put into a string
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // Insert the data
        curl_setopt($curl, CURLOPT_POSTFIELDS, $pay_load);
        // Send the request
        $result = curl_exec($curl);
        // Get some cURL session information back
        $info = curl_getinfo($curl);
        curl_close($curl);
        return json_decode($result);
    }

}

if(!function_exists('checkMessageStatus'))
{

   function checkMessageStatus($message_id, $token)
    {
        $check_message_status_endpoint = config('sms.SMS_PORTAL_CONFIRM_SMS_URL');
        $curl = curl_init();

        $data = array(
            'message_id' => (string)$message_id 
        );

     
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_URL, $check_message_status_endpoint);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl, CURLOPT_HTTPHEADER,  array(
            "Content-Type: application/json",
            "Authorization: Bearer " . $token
        ));
        $result = curl_exec($curl);
        $info = curl_getinfo($curl);
        curl_close($curl);

        return $result;
    }
}

if(!function_exists('phonize'))
{
     function phonize($phoneNumber, $country) 
    {
 
         $countryCodes = array(
             'ug' => '+256',
             'ke' => '+254',
             
         );
     
         return preg_replace('/[^0-9+]/', '',
                preg_replace('/^0/', $countryCodes[$country], $phoneNumber));
     }
}

if(!function_exists('sendSMS'))
{
    function sendSMS($title, $message, $contact)
    {

        $login_result = loginToSMSPortal(config('sms.SMS_PORTAL_EMAIL'),
         config('sms.SMS_PORTAL_PASSWORD'));

        $token = $login_result->token;

        $contact = phonize($contact, "ug");
        
      
        $message =  $title . PHP_EOL . $message;

        $some_data = array(
            'message' => $message,
            'title' => $title,
            'contact' => $contact
        );

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_URL, config('sms.SMS_PORTAL_SEND_SMS_URL'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($some_data));
        curl_setopt($curl, CURLOPT_HTTPHEADER,  array(
            "Content-Type: application/json",
            "Authorization: Bearer " . $token
        ));

        $result = curl_exec($curl);
        $info = curl_getinfo($curl);
        curl_close($curl);
        // return array instead of object by using true as second argument
        $decoded_data = json_decode($result, true);

        $status = "None";

        if($info['http_code'] == 200)
        {
            $status = checkMessageStatus($decoded_data['message_id'], $token);
        }  

        $decoded_data['http_code'] = $info['http_code'];

        //return 

        return $decoded_data;

        // return response()->json([
        //     'sending_response' => $decoded_data,
        //     'confirmation_response' => json_decode($status) 
        // ]);
    }  
}



   

  

  






?>