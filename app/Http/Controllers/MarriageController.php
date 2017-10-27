<?php

namespace Genealogy\Http\Controllers;

use DB;
use Genealogy\Hocs\Marriages\MarriageRepository;
use Genealogy\Hocs\Users\UserRepository;
use Genealogy\Http\Requests\StoreMarriage;
use Genealogy\Jobs\SendInviteEmail;
use Illuminate\Http\Request;

class MarriageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MarriageRepository $marriage, UserRepository $user)
    {
        $this->marriage = $marriage;
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
        $current_id = $request->get('current_id', 0);
        if (!$user = $this->user->getById($current_id)) {
            $user = auth()->user();
        }

        return view('marriages.create')->with('user', $user);
    }

    public function store(StoreMarriage $request)
    {
        DB::beginTransaction();

        try {
            $password = str_random(10);
            $datas = $request->all();
            $datas['user']['password'] = $password;

            $result = $this->marriage->store($datas);
            DB::commit();

            dispatch(new SendInviteEmail($result['user'], $password));

            return redirect(route('home'))->with('alert-success', 'Thêm mới thành công!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('alert-alert', 'Có lỗi xảy ra vui lòng thử lại!');
        }
    }
}
