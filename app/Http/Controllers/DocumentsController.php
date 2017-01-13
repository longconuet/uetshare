<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

use App\Documents;

use App\Subjects;

class DocumentsController extends Controller
{
    public function getList()
    {
    	$documents = Documents::orderBy('id', 'desc')->paginate(10);
        $quantity = count(Documents::all());
    	return view('admin.document.list', ['documents'=>$documents, 'quantity'=>$quantity]);
    }

    public function getAdd()
    {
    	$subjects = Subjects::all()->sortBy('name');
    	return view('admin.document.add')->with('subjects', $subjects);
    }

    public function postAdd(Request $request)
    {
    	$this->validate($request, [
    			'name' => 'required|min:6|max:100',
    			'id_subject' => 'required',
    			'file' => 'required'
    		], [
    			'name.required' => 'Tên tài liệu không được để trống',
    			'name.min' => 'Tên tài liệu phải ít nhất 6 ký tự',
    			'name.max' => 'Tên tài liệu phải ít hơn 100 ký tự',
    			'id_subject.required' => 'Chưa chọn môn học',
    			'file.required' => 'Bạn chưa chọn tài liệu upload'
    		]
    	);

    	$document = new Documents;
    	$document->name = $request->name;
    	$document->name_without_sign = changeTitle($request->name);
    	$document->id_subject = $request->id_subject;
    	$document->description = $request->description;
    	$document->id_user = Auth::user()->id;
    	$document->view = 0;

		$file = $request->file('file');
		$name = $file->getClientOriginalName();
        $extension = strtolower($file->getClientOriginalExtension());
        if ($extension != "jpg" && $extension != "png" && $extension != "doc" && $extension != "docx" && $extension != "pdf")
        {
            return redirect('admin/document/add')->with('alert', 'Bạn chỉ được upload file jpg, png, doc, docx, pdf');
        }      
		$path = "[uet-share]".str_random(5)."-".$name;
		$file->move('public/upload', $path);
		$document->path = $path;
        $document->extension = $extension;

    	$document->save();
    	return redirect('admin/document/add')->with('noti', 'Thêm mới tài liệu thành công');
    }

    public function getEdit($id)
    {
    	$document = Documents::find($id);
    	$subjects = Subjects::all();
    	return view('admin.document.edit', ['document'=>$document, 'subjects'=>$subjects]);
    }

    public function postEdit($id, Request $request)
    {
    	$document = Documents::find($id);
    	$this->validate($request, [
    			'name' => 'required|min:6|max:100',
    			'id_subject' => 'required',
    		], [
    			'name.required' => 'Tên tài liệu không được để trống',
    			'name.min' => 'Tên tài liệu phải nhiều hơn 6 ký tự',
    			'name.max' => 'Tên tài liệu phải ít hơn 100 ký tự',    			
    			'id_subject.required' => 'Chưa chọn môn học',
    		]
    	);

		$document->name = $request->name;
		$document->name_without_sign = changeTitle($request->name);
    	$document->id_subject = $request->id_subject;
    	$document->description = $request->description;

		if ($request->hasFile('file')) 
		{
			$file = $request->file('file');
			$name = $file->getClientOriginalName();
            $extension = strtolower($file->getClientOriginalExtension());
            if ($extension != "jpg" && $extension != "png" && $extension != "doc" && $extension != "docx" && $extension != "pdf")
            {
                return redirect('admin/document/edit/'.$id)->with('alert', 'Bạn chỉ được upload file jpg, png, doc, docx, pdf');
            }
			$path = "[uet-share]".str_random(5)."-".$name;
            unlink("public/upload/".$document->path);
			$file->move('public/upload', $path);

			$document->path = $path;
            $document->extension = $extension;
		}

		$document->save();
	    return redirect('admin/document/edit/'.$id)->with('noti', 'Sửa tài liệu thành công');
    }

    public function getDelete($id)
    {
    	$document = Documents::find($id);
        unlink("public/upload/".$document->path);
    	$document->delete();
    	return redirect('admin/document/list')->with('noti', 'Xóa tài liệu thành công');
    }
}
