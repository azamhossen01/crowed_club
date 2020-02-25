<?php

namespace App\Http\Controllers;

use App\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::where('status',1)->get();
        return view('member.index',compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('member.create');
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
        $this->validate($request,[
            'first_name' => 'required',
            'phone' => 'required',
        ]);
        $member = new Member;
        $member->first_name = $request->first_name;
        $member->last_name = $request->last_name;
        $member->address = $request->address;
        $member->email = $request->email;
        $member->phone = $request->phone;
        if($request->image){
            $image_name = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('backend/members'),$image_name);
            $member->image = $image_name;
        }
        $member->save();
        return redirect()->route('members.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member = Member::findOrFail($id);
        return view('member.show',compact('member'));
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
        $member = Member::findOrFail($id);
        // delete image
        if($member->image){
            unlink(public_path('backend/members/').$member->image);
        }

        // delete payments of this member
        foreach($member->payments as $payment){
            $payment->delete();
        }
        $member->delete();
        return redirect()->route('members.index');
    }

    public function edit_member(Request $request){
        // return $request;
        $member = Member::findOrFail($request->member_id);
        return $member;

    }

    public function update_member(Request $request){
        // return $request;
        $member = Member::findOrFail($request->member_id);
        $member->first_name = $request->first_name;
        $member->last_name = $request->last_name;
        $member->address = $request->address;
        $member->email = $request->email;
        $member->phone = $request->phone;
        if($request->image){
            if($member->image){
                $old_image = public_path('backend/members/').$member->image;
                unlink($old_image);
            }
            $image_name = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('backend/members'),$image_name);
            $member->image = $image_name;
        }
        $member->update();
        return redirect()->route('members.index');
    }
}
