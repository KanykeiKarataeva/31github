<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Child;
use App\Models\Group;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index(){
        $children = DB::table('children')
            ->leftJoin('groups', 'groups.id', '=', 'children.group_id')
            ->select('children.id', 'children.name', 'children.surname', 'groups.name as group_name')
            ->get();
        $payment = DB::table('payments')
            ->orderBy('id', 'desc')
            ->select('child_id', 'payment_amount', 'date_from', 'date_to')
            ->get();

        return view('admin.payment.index',compact('children', 'payment'));
    }

    public function create(Request $request){
        $data = $request->validate([
            'child_id' => 'required',
            'date_from' => 'required',
            'date_to' => 'required',
            'payment_amount' => 'required',
        ]);

        $date_from = Carbon::createFromFormat('Y-m-d', $data['date_from']);
        $date_to = Carbon::createFromFormat('Y-m-d', $data['date_to']);
        $daysExcludingSunday = $date_from->diffInDaysFiltered(function ($date) {
            return $date->dayOfWeek !== Carbon::SUNDAY;
        }, $date_to);
        $payment_amount = $daysExcludingSunday * 250;

        if($data['payment_amount'] < $payment_amount){
            return redirect()->back()->with('status', 'Payment amount is not enough');
        }
        else{
            Payment::create([
                'child_id' => $data['child_id'],
                'date_from' => $data['date_from'],
                'date_to' => $data['date_to'],
                'payment_amount' => $data['payment_amount']
            ]);
            return redirect()->back()->with('status', 'Payment was successful');
        }
    }
}
