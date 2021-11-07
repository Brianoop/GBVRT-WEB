<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ActivistData;
use App\Models\ActivistServices;
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

    public function showActivistCases()
    {
        return view('dashboard.pages.activists_cases');
    }

    public function showActivistDetails($id)
    {
        $activist_details = $this->users->join('activist_data', 'activist_data.users_id', '=', 'users.id')
        ->where('users.type', 2)
        ->where('users.id', $id)
        ->select(
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

    public function showReportActivist()
    {
        return view('dashboard.pages.report_activist');
    }

    
}
