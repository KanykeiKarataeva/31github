<?php


namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Child;
use App\Models\Payment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index(Child $child){
        $child = DB::table('children')
            ->leftJoin('groups', 'groups.id', '=', 'children.group_id')
            ->where('children.id', $child->id)
            ->select('children.id','children.name', 'children.surname', 'groups.name as group_name')
            ->get();

        $user = auth()->user();
        if($user){
            if($user->role === 'ROLE_ADMIN' or $user->role === 'ROLE_TEACHER' or $user->role === 'ROLE_PARENT'){
                $children = Child::where('parent_id', $user->id)->get();
                return view('user.payment', compact('children',  'child'));
            }
            return view('user.payment',compact( 'child'));
        }
        return view('user.payment', compact( 'child'));
    }

    public function form(Request $request){
        $data = $request->validate([
            'child_id' => 'required',
            'date_from' => 'required',
            'date_to' => 'required',
        ]);
        $date_from = Carbon::createFromFormat('Y-m-d', $data['date_from']);
        $date_to = Carbon::createFromFormat('Y-m-d', $data['date_to']);
        $daysExcludingSunday = $date_from->diffInDaysFiltered(function ($date) {
            return $date->dayOfWeek !== Carbon::SUNDAY;
        }, $date_to);
        $payment_amount = $daysExcludingSunday * 250;

        $user = auth()->user();
        if($user){
            if($user->role === 'ROLE_ADMIN' or $user->role === 'ROLE_TEACHER' or $user->role === 'ROLE_PARENT'){
                $children = Child::where('parent_id', $user->id)->get();
                return view('user.paymentForm', compact('children', 'data', 'payment_amount'));
            }
            return view('user.paymentForm',compact('data', 'payment_amount'));
        }
        return view('user.paymentFrom', compact('data', 'payment_amount'));
    }

    public function create(Request $request){
        $data = $request->validate([
            'child_id' => 'required',
            'date_from' => 'required',
            'date_to' => 'required',
            'payment_amount' => 'required',
        ]);

        Payment::create([
            'child_id' => $data['child_id'],
            'date_from' => $data['date_from'],
            'date_to' => $data['date_to'],
            'payment_amount' => $data['payment_amount']
        ]);

        return redirect()->route('index')->with('status', 'Оплата ');
    }
}
