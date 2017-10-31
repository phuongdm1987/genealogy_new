<?php

namespace Genealogy\Http\Controllers;

use Genealogy\Hocs\Educations\EducationRepository;
use Genealogy\Http\Requests\StoreEducation;
use Genealogy\Http\Requests\UpdateEducation;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(EducationRepository $education)
    {
        $this->education = $education;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('educations.create');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $education = $this->education->getById($id);
        return view('educations.edit', ['education' => $education]);
    }

    public function store(StoreEducation $request)
    {
        try {
            $datas = $request->all();

            $model = $this->education->store($datas);
            return redirect(route('users.show', $model->user->hashid))->with('alert-success', 'Thêm mới thành công!');
        } catch (\Exception $e) {
            return back()->with('alert-alert', 'Có lỗi xảy ra vui lòng thử lại!' . $e->getMessage());
        }
    }

    public function update(UpdateEducation $request, $id)
    {
        $education = $this->education->getById($id);
        try {
            $model = $this->education->update($education, $request->all());
            return redirect(route('users.show', $model->user->hashid))->with('alert-success', 'Cập nhật thành công!');
        } catch (\Exception $e) {
            return back()->with('alert-alert', 'Có lỗi xảy ra vui lòng thử lại!' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $education = $this->education->getById($id);
        try {
            $this->education->delete($education);
            return redirect(route('users.show', $education->user->hashid))
                ->with('alert-success', 'Xóa thành công!');
        } catch (\Exception $e) {
            return back()->with('alert-alert', 'Có lỗi xảy ra vui lòng thử lại! ' . $e->getMessage());
        }
    }
}
