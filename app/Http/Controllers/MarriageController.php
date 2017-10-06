<?php

namespace Genealogy\Http\Controllers;

use Genealogy\Hocs\Users\UserRepository;
use Genealogy\Http\Requests\StoreMarriage;
use Illuminate\Http\Request;

class MarriageController extends Controller
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
    public function create(Request $request)
    {
        return view('marriages.create')->with('user', auth()->user());
    }

    public function store(StoreMarriage $request)
    {
        $datas = $request->all();

        if ($marriage = $this->marriage->store($datas)) {
            return redirect(route('home'))->with('alert-success', 'Thêm mới thành công!');
        }

        return redirect()->back()->with('alert-alert', 'Có lỗi xảy ra vui lòng thử lại!');
    }
}
