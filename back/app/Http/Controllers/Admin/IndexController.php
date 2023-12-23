<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function __invoke()
    {
        return view('admin.index');
    }

    public function index(){
        $groups = Group::all();
//        $teachers = User::where('role', 'ROLE_TEACHER')->get();
        $teachers = DB::table('users')
            ->leftJoin('groups', 'groups.teacher_id', '=', 'users.id')
            ->where('users.role',  'ROLE_TEACHER')
            ->select('users.name as name', 'users.surname as surname',
                'users.id as id', 'groups.teacher_id')
            ->where('teacher_id', '=', null)
            ->get();
        return view('admin.group.index', compact('groups', 'teachers'));
    }
}
