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
        $this->user->setRelations('educations');
        $user = $this->user->getById($id);
        $users_tree = $this->user->getToTree($id);

        return view('home')->with(['user' => $user, 'users_tree' => $users_tree]);
    }

    public function edit(Request $request, $id)
    {
        $id = array_first(\Hashids::decode($id));
        $user = $this->user->getById($id);
        $parents = $this->user->getToTree($user->parent_id, 'list');

        return view('users.edit')->with(['user' => $user, 'parents' => $parents]);
    }

    public function update(UpdateUser $request, $id)
    {
        $id = array_first(\Hashids::decode($id));
        $user = $this->user->getById($id);

        \DB::beginTransaction();
        try {
            $this->user->update($user, $request->all());
            \DB::commit();

            return redirect(route('users.show', ['user' => $user->hashid]))
                ->with('alert-success', 'Cập nhật thành công!');
        } catch (\Exception $e) {
            \DB::rollback();
            return back()->with('alert-alert', 'Có lỗi xảy ra vui lòng thử lại!');
        }
    }
}
