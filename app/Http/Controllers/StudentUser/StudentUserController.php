<?php

namespace App\Http\Controllers\StudentUser;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\RoleUsers;
use Illuminate\Support\Facades\DB;

class StudentUserController extends Controller
{
    protected $users;

    public function __construct(RoleUsers $user)
    {
        $this->users = $user;
    }

    public function getHome()
    {
        $count = array();
        $title = 'User | Home';
        $roles = [9=>'student', 7=>'admins', 8=>'faculty'];
        $data = $this->users
            ->select(DB::raw('count(*) as count,id'))
            ->whereIn('role_id',[7,8,9])
            ->groupBy('role_id')
            ->get()->toArray();

        foreach ($data as $key => $each) {
            $count[$roles[$each['role_id']]] = $each['count'];
        }

        return view('protected.dashboard', [
            'title' => $title,
            'count' => $count
        ]);
    }

   public function getUserProtected()
   {
        return view('protected.standardUser.userPage');
  }
}
