<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Gallery;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index(){
        if (count($galleries) != 0){
            $created_at_dates = DB::table('galleries')
                ->where('group_id', $galleries[0]->group_id)
                ->distinct()
                ->orderBy('created_at', 'desc')
                ->pluck('created_at');
            $count = [];
            $index = 0;
            foreach ($created_at_dates as $created_at_date){
                $i = 0;
                foreach ($galleries as $gallery){
                    if ($created_at_date === $gallery->created_at){
                        $i++;
                    }
                }
                $count[$index] = $i;
                $index++;
            }
            return view('employee.gallery.index', compact('galleries', 'created_at_dates',  'count', 'group_id'));
        }
        else
            return view('employee.gallery.index', compact('galleries', 'group_id'));
    }

    public function create(Request $request, Group $group){
        $data = $request->validate([
            'info' => ''
        ]);
        if($request->has('images')){
            foreach ($request->file('images') as $image) {
                $imageName = Storage::disk('public')->put('group_gallery', $image);
                $imageName = "storage/".$imageName;
            }
        }
        if($request->has('videos')){
            foreach ($request->file('videos') as $video) {
                $videoName = Storage::disk('public')->put('group_gallery', $video);
                $videoName = "storage/".$videoName;
                Gallery::create([
                    'group_id'=>$group->id,
                    'image'=>null,
                    'video'=>$videoName,
                    'info' => $data['info']
                ]);
            }
        }
        $message = Lang::get('lang.add_successful');
        return redirect()->back()->with('status', $message);;
    }

    public function showArchive(Request $request){
        $data = $request->validate([
            'date' => 'required',
        ]);
        $date = \Carbon\Carbon::parse($data['date']);
        $year = $date->format('Y');
        $month = $date->format('m');
        $days = $date->format('d');
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
    public function delete($date){
        $galleries = Gallery::where('created_at', $date)
            ->get();
        foreach ($galleries as $gallery){
            $gallery->delete();
        }
        return redirect()->back()->with('status', $message);
    }
}
