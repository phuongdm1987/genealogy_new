<?php

namespace Genealogy\Http\Controllers;

use DB;
use Genealogy\Hocs\Users\UserRepository;
use Genealogy\Http\Requests\StoreChild;
use Genealogy\Jobs\SendInviteEmail;
use Illuminate\Http\Request;

class ChildController extends Controller
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
        return view('children.create')->with('user', auth()->user());
    }

    public function store(StoreChild $request)
    {
        DB::beginTransaction();

        try {
            $password = str_random(10);
            $datas = $request->all();
            $datas['password'] = $password;

            $user = $this->user->storeChild($datas);
            DB::commit();

            dispatch(new SendInviteEmail($user, $password));

            return redirect(route('home'))->with('alert-success', 'Thêm mới thành công!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('alert-alert', 'Có lỗi xảy ra vui lòng thử lại!');
        }
    }
}
