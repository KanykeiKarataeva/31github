<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Child;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceContoller extends Controller
{
    public function index(){
        return view('admin.attendance.index');
    }

    public function show(Request $request){
        $data = $request->validate([
            'date' => 'required',
        ]);
        $date = \Carbon\Carbon::parse($data['date']);
        $year = $date->format('Y');
        $month = $date->format('m');
        $groups = Group::all();
        $children = DB::table('children')
            ->leftJoin('groups', 'groups.id', '=', 'children.group_id')
            ->select('children.id', 'children.name', 'children.surname', 'children.group_id')
            ->get();
        $attendance = Attendance::whereYear('date', $year)
            ->whereMonth('date', $month)
            ->orderBy('date', 'asc')
            ->select('date', 'group_id', 'children')
            ->get();

        if(!($attendance && $attendance->count())){
            $attendance = null;
            return view('admin.attendance.show', compact('children', 'attendance'));
        }
        return view('admin.attendance.show', compact('groups' ,'children', 'attendance'));
    }

}
