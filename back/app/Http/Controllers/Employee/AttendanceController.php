<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\UpdateArchiveRequest;
use App\Models\Attendance;
use App\Models\Child;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AttendanceController extends Controller
{
    public function index(){
        $children = DB::table('groups')
            ->leftJoin('children', 'children.group_id', '=', 'groups.id')
            ->leftJoin('users', 'users.id', '=', 'children.parent_id')
            ->where('groups.teacher_id', auth()->user()->id)
            ->select('children.id', 'children.name', 'children.surname', 'children.birth_date', 'children.deleted', 'groups.id as group_id')
            ->get();
        $group_id = Group::where('teacher_id', auth()->user()->id)
            ->select('id')
            ->get();
        $attendance = Attendance::where('group_id', $group_id[0]->id)
            ->whereBetween('date', [date('Y-m-01'), date('Y-m-31')])
            ->orderBy('date', 'asc')
            ->select('date', 'children')
            ->get();
        return view('employee.attendance.index', compact('children', 'attendance'));
    }
    public function create(Request $request){
        $data = $request->validate([
            'group_id' => 'required',
            'date' => 'required',
            'children' => 'required'
        ]);
        $date = Attendance::where('group_id', $data['group_id'])
            ->where('date', $data['date'])
            ->get();
        if(!count($date)){
            Attendance::create([
                'group_id' => $data['group_id'],
                'date' => $data['date'],
                'children' => $data['children']
            ]);
            return response(['status'=>'Вы успешно отметили детей']);
        }
        return response()->setStatusCode(500);
    }

    public function showArchive(Request $request){
        $data = $request->validate([
            'date' => 'required',
        ]);
        $date = \Carbon\Carbon::parse($data['date']);
        $year = $date->format('Y');
        $month = $date->format('m');
        $children = DB::table('groups')
            ->leftJoin('children', 'children.group_id', '=', 'groups.id')
            ->leftJoin('users', 'users.id', '=', 'children.parent_id')
            ->where('groups.teacher_id', auth()->user()->id)
            ->select('children.id', 'children.name', 'children.surname', 'children.birth_date', 'groups.id as group_id')
            ->get();
        $group_id = Group::where('teacher_id', auth()->user()->id)
            ->select('id')
            ->get();
        $attendance = Attendance::where('group_id', $group_id[0]->id)
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->orderBy('date', 'asc')
            ->select('date', 'children')
            ->get();
        if(!($attendance && $attendance->count())){
            $attendance = null;
            return view('employee.attendance.archive', compact('children', 'attendance'));
        }
        return view('employee.attendance.archive', compact('children', 'attendance'));
    }

    public function editArchive(Request $request){
        $data = $request->validate([
            'date' => 'required',
        ]);
        $children = DB::table('groups')
            ->leftJoin('children', 'children.group_id', '=', 'groups.id')
            ->leftJoin('users', 'users.id', '=', 'children.parent_id')
            ->where('groups.teacher_id', auth()->user()->id)
            ->select('children.id', 'children.name', 'children.surname', 'children.birth_date', 'groups.id as group_id')
            ->get();
        $group_id = Group::where('teacher_id', auth()->user()->id)
            ->select('id')
            ->get();
        $attendance = Attendance::where('group_id', $group_id[0]->id)
            ->where('date', $data['date'])
            ->orderBy('date', 'asc')
            ->select('id','group_id','date', 'children')
            ->get();
        $attendance_array = json_decode($attendance[0]->children, true);
        $i = 0;
        foreach ($children as $child)
        {
            if(array_key_exists($child->id, $attendance_array))
                $child->attendance = $attendance_array[$child->id];
            else{
                unset($children[$i]);
            }
            $i++;
        }
        return view('employee.attendance.archiveEdit', compact('children', 'attendance'));
    }

    public function updateArchive(UpdateArchiveRequest $request, Attendance $attendance){
        $data = $request->validated();
        DB::beginTransaction();
        $attendance->update([
            'children' => $data['children']
        ]);
        DB::commit();
        return response(['status'=>'Вы успешно отметили детей']);
    }
}
