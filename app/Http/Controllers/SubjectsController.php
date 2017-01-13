<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Subjects;

class SubjectsController extends Controller
{
    public function getList()
    {
        $subjects = Subjects::orderBy('id', 'desc')->paginate(10);
        $quantity = count(Subjects::all());
        return view('admin.subject.list', ['subjects'=>$subjects, 'quantity'=>$quantity]);
    }

    public function getAdd()
    {
        return view('admin.subject.add');
    }

    public function postAdd(Request $request)
    {
        $this->validate($request, [
                'name' => 'required|min:6|max:100|unique:subjects,name'
            ], [
                'name.required' => 'Tên môn không được để trống',
                'name.min' => 'Tên môn học phải nhiều hơn 6 ký tự',
                'name.max' => 'Tên môn học phải ít hơn 100 ký tự',
                'name.unique' => 'Tên môn học đã tồn tại'
            ]
        );

        $subject = new Subjects;
        $subject->name = $request->name;
        $subject->name_without_sign = changeTitle($request->name);
        $subject->save();

        return redirect('admin/subject/add')->with('noti', 'Thêm mới môn học thành công');
    }

    public function getEdit($id)
    {
        $subject = Subjects::find($id);
        return view('admin.subject.edit', ['subject'=>$subject]);
    }

    public function postEdit($id, Request $request)
    {
        $subject = Subjects::find($id);
        if ($request->name != $subject->name)
        {
            $this->validate($request, [
                    'name' => 'required|min:6|max:100|unique:subjects,name'
                ], [
                    'name.required' => 'Tên môn không được để trống',
                    'name.min' => 'Tên môn học phải nhiều hơn 6 ký tự',
                    'name.max' => 'Tên môn học phải ít hơn 100 ký tự',
                    'name.unique' => 'Tên môn học đã tồn tại'
                ]
            );

            $subject->name = $request->name;
            $subject->name_without_sign = changeTitle($request->name);
            $subject->save();

            return redirect('admin/subject/edit/'.$id)->with('noti', 'Sửa môn học thành công');
        }
        return redirect('admin/subject/edit/'.$id)->with('noti', 'Môn học không thay đổi');
    }

    public function getDelete($id)
    {
        $subject = Subjects::find($id);
        $subject->delete();
        return redirect('admin/subject/list')->with('noti', 'Xóa môn học thành công');
    }
}
