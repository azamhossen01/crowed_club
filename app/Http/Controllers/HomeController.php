<?php

namespace App\Http\Controllers;

use App\Member;
use App\MemberDetail;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $members = count(Member::all());
        $total_payments = MemberDetail::all()->sum('amount');
        // return $total_payments;
        return view('home',compact('members','total_payments'));
    }
}
