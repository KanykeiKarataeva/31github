<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\Admin\UserService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class UserController extends Controller
{
    private UserService $service;
    public function __construct()
    {
        $this->service = new UserService();
    }

    public function index(){
        $users = User::all();
        return view('admin.user.index', compact('users'));

    }

    public function edit(User $user){
        return view('admin.user.edit', compact('user'));
    }

    public function create(StoreRequest $request):Response
    {
        return $this->service->store($request);
    }

    public function show(User $user):View
    {
        return view('admin.user.show',compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        return $this->service->update($request, $user);
    }

    public function delete(User $user){
        $user->delete();
        $message = Lang::get('lang.delete_answer_user');
        return redirect()->route('admin.user.index')->with('status',$message);
    }
}
