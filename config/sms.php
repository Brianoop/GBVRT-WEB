<?php 


return [


  /*
    |--------------------------------------------------------------------------
    | SMS DRIVER Configuration
    |--------------------------------------------------------------------------
    |
    | Here you define SMS URLS and Passwords for accessing these URLS
    |
    |
    */


    'SMS_PORTAL_LOGIN_URL' => env('SMS_PORTAL_LOGIN_URL', 'https://sms.thefavplaces.com/api/login'),
    'SMS_PORTAL_SEND_SMS_URL' => env('SMS_PORTAL_SEND_SMS_URL', 'https://sms.thefavplaces.com/api/send_sms'),
    'SMS_PORTAL_CONFIRM_SMS_URL' => env('SMS_PORTAL_CONFIRM_SMS_URL', 'https://sms.thefavplaces.com/api/check_message_status'),
    'SMS_PORTAL_EMAIL' => env('SMS_PORTAL_EMAIL', 'brianangoda99@gmail.com'),
    'SMS_PORTAL_PASSWORD' => env('SMS_PORTAL_PASSWORD', '12345678'),


];

















?>