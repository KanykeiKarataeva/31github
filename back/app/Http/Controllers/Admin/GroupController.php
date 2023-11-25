<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\Gallery;
use App\Models\Group;
use App\Models\User;
use App\Services\Admin\GalleryService;
use App\Services\Admin\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;


class GroupController extends Controller
{
    private GalleryService $galleryService;

    public function __construct()
    {
        $this->galleryService = new GalleryService();
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

    public function create(Request $request){
        $data = $request->validate([
            'name'=>'required|string',
            'teacher_id' => 'required',
            'limit'=>'required',
            'description'=>'required|string',
            'image'=>''
        ]);
        $image = Storage::disk('public')->put('groupImages', $data['image']);
        $image = "storage/".$image;

        $group = Group::create([
            'name' => $data['name'],
            'teacher_id' => $request->teacher_id,
            'limit' => $data['limit'],
            'description' => $data['description'],
            'image' => $image
        ]);

        return response()->json($group);

    }

    public function show(Group $group){
        return view('admin.group.show', compact('group'));
    }

    public function edit(Group $group){
        $teachers = User::where('role', 'ROLE_TEACHER')->get();
        return view('admin.group.edit',compact('group', 'teachers'));
    }

    public function update(UpdateGroupRequest $request, Group $group){
        $data = $request->validated();
        DB::beginTransaction();
        if(array_key_exists('image', $data)){
            $image = Storage::disk('public')->put('groupImages', $data['image']);
            $image = "storage/".$image;
            $group->update([
                'name' => $data['name'],
                'teacher_id' => $data['teacher_id'],
                'limit' => $data['limit'],
                'description' => $data['description'],
                'image' => $image,

            ]);
        }
        else {
            $group->update([
                'name' => $data['name'],
                'teacher_id' => $data['teacher_id'],
                'limit' => $data['limit'],
                'description' => $data['description'],
            ]);
        }
        DB::commit();
        return redirect()->route('admin.group.index')->with('status','Group data is Updated');
    }

    public function delete(Group $group){
        $group->delete();
        $message = Lang::get('lang.delete_answer_group');
        return redirect()->route('admin.group.index')->with('status', $message);
    }

    public function Gallery(Group $group){
        if(!$group) abort(404);
        $galleries = $group->gallery;
        return view('admin.group.addGallery',compact('group', 'galleries'));
    }

    public function galleryCreate(Request $request, Group $group)
    {
        $this->galleryService->store($request, $group);

        return redirect()->back();
    }
    public function galleryDelete(Gallery $gallery){
        $gallery->delete();
        return redirect()->route('admin.group.Gallery');
    }
}
