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

    }

   public function getUserProtected()
   {
        return view('protected.studentUser.userPage');
  }
}
