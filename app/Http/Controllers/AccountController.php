<?php

namespace Genealogy\Http\Controllers;

use Genealogy\Hocs\Users\UserRepository;
use Genealogy\Http\Requests\UpdateProfile;
use Illuminate\Http\Request;
use \DB;

class AccountController extends Controller
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

    public function index(Request $request)
    {
        return view('account.profile')->with(['user' => auth()->user()]);
    }

    public function update(UpdateProfile $request)
    {
        DB::beginTransaction();

        try {
            $this->user->update(auth()->user(), $request->all());
            DB::commit();

            return redirect(route('profile.index'))->with('alert-success', 'Cập nhật thành công!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('alert-alert', 'Có lỗi xảy ra vui lòng thử lại!');
        }
    }
}
