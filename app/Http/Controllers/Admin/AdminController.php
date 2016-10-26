<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\RoleUsers;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    protected $users;

    public function __construct(RoleUsers $user)
    {
        $this->users = $user;
    }

    public function getHome()
    {
		
        $count = array();
        $title = 'Admin | Home';
        $roles = ['management','admins','faculty','student','parent','pta','alumni'];
        $data = $this->users
            ->select(DB::raw('count(*) as count,role_id'))
            ->groupBy('role_id')
            ->get()->toArray();
        foreach ($data as $key => $each) {
            $count[$roles[$key]] = $each['count'];
        }

        return view('protected.dashboard', [
            'title' => $title,
            'count' => $count
        ]);
    }


}
