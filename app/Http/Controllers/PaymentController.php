<?php

namespace App\Http\Controllers;

use App\Member;
use App\MemberDetail;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = MemberDetail::all()->groupBy('member_id');
        // return $payments;
        return view('payment.index',compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members = Member::where('status',1)->get();
        return view('payment.create',compact('members'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $member = Member::findOrFail($request->member_id);
        $total_amount = ($member->total_amount+$request->amount);
        // return $total_amount;
        $member->total_amount = $total_amount;
        $member->update();

        $member_detail = new MemberDetail;
        $member_detail->member_id = $request->member_id;
        $member_detail->amount = $request->amount;
        $member_detail->save();
        return redirect()->route('payments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function edit_payment(Request $request){
        $payment = MemberDetail::findOrFail($request->payment_id);
        return $payment;
    }

    public function update_payment(Request $request){
        // return $request;
        $payment = MemberDetail::findOrFail($request->payment_id);
        $payment->amount = $request->amount;
        $payment->update();
        return redirect()->route('members.show',$payment->member_id);
    }
}
