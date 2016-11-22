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
        $roles = ['management','admins','faculty','student','parent','pta','alumni','administrator'];

        $roles = ['management','Administrator','admins','faculty','student','parent','pta','alumni'];
        $roles = [9=>'student', 7=>'admins', 8=>'faculty'];
        $data = $this->users
          ->select(DB::raw('count(*) as count,role_id'))
            ->groupBy('role_id')
            ->whereIn('role_id',[7,8,9])
            ->get()->toArray();
            
        foreach ($data as $key => $each) {
            $count[$roles[$each['role_id']]] = $each['count'];
        }

        return view('protected.dashboard', [
            'title' => $title,
            'count' => $count
        ]);
    }


}
