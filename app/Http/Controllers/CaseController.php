<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\UserCase;
use App\Models\User;
use App\Models\CaseReceiver;
use App\Models\CaseMedia;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class CaseController extends Controller
{
       

    public function showManageCases()
    {
       
        return view('dashboard.pages.manage_cases');
    }

    public function showAdminCaseDetailPage()
    {

        return view('dashboard.pages.admin_case_detail');
    }

    public function storeCase(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'sub_county' => 'required|integer',
            'violence' => 'required|integer',
            'details' => 'required|string',
            'activist' => 'required|integer',
            'files.*' => 'max:20000'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }


        $user_case = new UserCase();

        $user_case->users_id = $request->user()->id;

        $user_case->violences_id = $request->violence;

        $user_case->sub_counties_id = $request->sub_county;

        $user_case->details = $request->details;

 

        if (!$user_case->save()) 
        {
            return back()->with('error', 'Failed to report your case. Please try again later.');
        }

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
              return back()->with('success', 'Your case has been reported successfully');
              
            }
        }
    }
}
