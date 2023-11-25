<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateChildrenRequest;
use App\Models\Child;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;

class ChildrenController extends Controller
{
    public function index(){
        $children = Child::where('deleted', 0)->get();
        $parents = User::where('deleted', 0)->get();
        $groups = Group::all();
        $amount_child_group = [];
        foreach ($groups as $group){
            $count = 0;
            foreach ($children as $child){
                if($group->id === $child->group_id){
                    $count++;
                }
            }
            $amount_child_group[$group->id] = $count;
        }
        return view('admin.children.index', compact('children', 'parents', 'groups', 'amount_child_group'));
    }

    public function create(Request $request){
        $data = $request->validate([
            'name' => 'required|string',
            'surname' => 'required|string',
            'birth_date' => 'required',
            'gender' => '',
            'parent_id' => 'required',
            'group_id' => 'required',
            'photo' => '',
            'birth_certificate' => '',
            'med_certificate' => '',
            'med_disability' => ''
        ]);

        $photo = Storage::disk('public')->put('childImages/photos', $data['photo']);
        $photo = "storage/".$photo;
        $birth_cert = Storage::disk('public')->put('childImages/birthCertificates', $data['birth_certificate']);
        $birth_cert = "storage/".$birth_cert;
        $med_cert = Storage::disk('public')->put('childImages/medCertificates', $data['med_certificate']);
        $med_cert = "storage/".$med_cert;
        $med_disability = Storage::disk('public')->put('childImages/meDisabilities', $data['med_disability']);
        $med_disability = "storage/".$med_disability;

        $child = Child::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'birth_date' => $data['birth_date'],
            'gender' => $data['gender'],
            'parent_id' => $request->parent_id,
            'group_id' => $request->group_id,
            'photo' => $photo,
            'birth_certificate' => $birth_cert,
            'med_certificate' => $med_cert,
            'med_disability' => $med_disability
        ]);
        $child->group_id = Group::where('id', $child->group_id)->pluck('name');

        DB::beginTransaction();
        $parent = User::where('id', $request['parent_id'])->get();
        $parent = $parent[0];
        if ($parent->role === 'ROLE_USER')
            $parent->update([
                'role' => "ROLE_PARENT"
            ]);
        $parent->update([
            'amount_child' => $parent->amount_child + 1
        ]);
        DB::commit();
        return response($child);
    }

    public function edit(Child $child){
        $parents = User::where('role', 'ROLE_PARENT')->get();
        $groups = Group::all();
        return view('admin.children.edit', compact('child', 'parents', 'groups'));
    }

    public function show(Child $child){
        return view('admin.children.show', compact('child'));
    }

    public function update(UpdateChildrenRequest $request, Child $child){
        $data = $request->validated();
        DB::beginTransaction();
        $photo = $child->photo;
        $birth_certificate = $child->birth_certificate;
        $med_certificate = $child->med_certificate;
        $med_disability = $child->med_disability;
        if(array_key_exists('photo', $data)){
            $image = Storage::disk('public')->put('childImages/photos', $data['photo']);
            $photo = "storage/".$image;
        }
        if(array_key_exists('birth_certificate', $data)){
            $image = Storage::disk('public')->put('childImages/birthCertificates', $data['birth_certificate']);
            $birth_certificate = "storage/".$image;
        }
        if(array_key_exists('med_certificate', $data)){
            $image = Storage::disk('public')->put('childImages/medCertificates', $data['med_certificate']);
            $med_certificate = "storage/".$image;
        }
        if(array_key_exists('med_disability', $data)){
            $image = Storage::disk('public')->put('childImages/meDisabilities', $data['med_disability']);
            $med_disability = "storage/".$image;
        }
        $child->update([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'birth_date' => $data['birth_date'],
            'gender' => $data['gender'],
            'parent_id' => $data['parent_id'],
            'group_id' => $data['group_id'],
            'photo' => $photo,
            'birth_certificate' => $birth_certificate,
            'med_certificate' => $med_certificate,
            'med_disability' => $med_disability
        ]);
        DB::commit();
        return redirect()->route('admin.children.index')->with('status','Child data is Updated');
    }

    public function delete(Child $child){
        $parent = User::where('id', $child->parent_id)->get();
        $parent = $parent[0];
        DB::beginTransaction();
        $child->update([
            'deleted' => 1
        ]);
        $parent->update([
            'amount_child' => $parent->amount_child - 1
        ]);
        DB::commit();
        if ($parent->amount_child === 0){
            DB::beginTransaction();
            $parent->update([
                'role' => 'ROLE_USER'
            ]);
            DB::commit();
        }
        $message = Lang::get('lang.delete_answer_child');
        return redirect()->route('admin.children.index')->with('status',$message);
    }
}
