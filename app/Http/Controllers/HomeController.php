<?php

namespace Genealogy\Http\Controllers;

use Genealogy\Hocs\Users\UserRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $user->load('parent.couple', 'couple.children', 'children');

        $users_tree = $this->user->getToTree();

        return view('home')->with(['user' => $user, 'users_tree' => $users_tree]);
    }
}
