<?php

namespace Genealogy\Http\Controllers;

use Genealogy\Hocs\Users\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
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

    public function show(Request $request, $id)
    {
        $id = array_first(\Hashids::decode($id));
        $user = $this->user->getById($id);
        $users_tree = $this->user->getToTree($user);

        return view('home')->with(['user' => $user, 'users_tree' => $users_tree]);
    }
}
