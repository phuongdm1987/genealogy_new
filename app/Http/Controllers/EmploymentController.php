<?php

namespace Genealogy\Http\Controllers;

use Genealogy\Hocs\Employments\EmploymentRepository;
use Genealogy\Http\Requests\StoreEmployment;
use Genealogy\Http\Requests\UpdateEmployment;
use Illuminate\Http\Request;

class EmploymentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(EmploymentRepository $employment)
    {
        $this->employment = $employment;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('employments.create');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employment = $this->employment->getById($id);
        return view('employments.edit', ['employment' => $employment]);
    }

    public function store(StoreEmployment $request)
    {
        try {
            $datas = $request->all();

            $model = $this->employment->store($datas);
            return redirect(route('users.show', $model->user->hashid))->with('alert-success', 'Thêm mới thành công!');
        } catch (\Exception $e) {
            return back()->with('alert-alert', 'Có lỗi xảy ra vui lòng thử lại!' . $e->getMessage());
        }
    }

    public function update(UpdateEmployment $request, $id)
    {
        $employment = $this->employment->getById($id);
        try {
            $model = $this->employment->update($employment, $request->all());
            return redirect(route('users.show', $model->user->hashid))->with('alert-success', 'Cập nhật thành công!');
        } catch (\Exception $e) {
            return back()->with('alert-alert', 'Có lỗi xảy ra vui lòng thử lại!' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $employment = $this->employment->getById($id);
        try {
            $this->employment->delete($employment);
            return redirect(route('users.show', $employment->user->hashid))
                ->with('alert-success', 'Xóa thành công!');
        } catch (\Exception $e) {
            return back()->with('alert-alert', 'Có lỗi xảy ra vui lòng thử lại! ' . $e->getMessage());
        }
    }
}
