<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Mail;

use App\Http\Requests;

use App\Documents;

use App\Subjects;

use App\User;

use App\Comments;

class PagesController extends Controller
{
	function __construct() {
		$subjects = Subjects::all()->sortBy('name');
		view()->share('subjects', $subjects);
	}

    public function home()
    {
    	$documents = Documents::orderBy('id', 'desc')->paginate(12);
    	return view('pages.home')->with('documents', $documents);
    }

    public function subject($id)
    {
        $documents = Documents::where('id_subject', $id)->get();
        $subject = Subjects::find($id);
        return view('pages.subject', ['documents' => $documents, 'subject' => $subject]);
    }

    public function document($id)
    {
        $document = Documents::find($id);
        $document->view = $document->view + 1; // increase view
        $document->save();
        $relatedDocs = Documents::where('id_subject', $document->id_subject)->where('id', '<>', $id)->take(4)->get();
        $comments = Comments::where('id_document', $id)->orderBy('created_at', 'DESC')->get();
        return view('pages.document')->with('document', $document)->with('comments', $comments)->with('relatedDocs', $relatedDocs);
    }

    public function about()
    {
        return view('pages.about');
    }

    public function download($id)
    {
        $document = Documents::find($id);
        return response()->download('public/upload/'.$document->path);
    }

    public function getUpload()
    {
        $subjects = Subjects::all()->sortBy('name');
        return view('pages.upload')->with('subjects', $subjects);
    }

    public function postUpload(Request $request)
    {
        $this->validate($request, [
                'name' => 'required|min:6|max:100',
                'id_subject' => 'required',
                'file' => 'required'
            ], [
                'name.required' => 'Bạn phải nhập tên tài liệu',
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
            return redirect('upload-file')->with('alert', 'Bạn chỉ được upload file jpg, png, doc, docx, pdf');
        }
        $path = "[uet-share]".str_random(5)."-".$name;
        $file->move('public/upload', $path);

        $document->path = $path;
        $document->extension = $extension;

        $document->save();
        return redirect('upload-file')->with('noti', 'Thêm mới tài liệu thành công');
    }

    public function search(Request $request)
    {
        if ($request->keyword == "")
        {
            return redirect('/');   
        }
        else
        {           
            $keyword = $request->keyword;
            $key = changeTitle($request->keyword);
            $documents = Documents::where('name_without_sign', 'like', "%$key%")->paginate(12);
            return view('pages.search', ['keyword'=>$keyword, 'documents'=>$documents]); 
        }            
    }

    public function myUpload()
    {
        $documents = Documents::where('id_user', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(9);
        return view('pages.myupload.list')->with('documents', $documents);
    }

    public function myUploadEdit($id)
    {
        $document = Documents::find($id);
        return view('pages.myupload.edit')->with('document', $document);
    }

    public function postUploadEdit(Request $request, $id)
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
        $document->id_user = Auth::user()->id;

        if ($request->hasFile('file')) 
        {
            $file = $request->file('file');
            $name = $file->getClientOriginalName();
            $extension = strtolower($file->getClientOriginalExtension());
            if ($extension != "jpg" && $extension != "png" && $extension != "doc" && $extension != "docx" && $extension != "pdf")
            {
                return redirect('my-upload/edit/'.$id)->with('alert', 'Bạn chỉ được upload file jpg, png, doc, docx, pdf');
            }
            $path = "[uet-share]".str_random(5)."-".$name;
            unlink("public/upload/".$document->path);
            $file->move('public/upload', $path);

            $document->extension = extension;
            $document->path = $path;
        }

        $document->save();
        return redirect('my-upload/edit/'.$id)->with('noti', 'Sửa tài liệu thành công');
    }

    public function myUploadDelete($id)
    {
        $document = Documents::find($id);
        unlink("public/upload/".$document->path);
        $document->delete();
        return redirect('my-upload/list');
    }

    public function getProfile()
    {
        $user = Auth::user();
        return view('pages.profile')->with('user', $user);
    }

    public function postProfile(Request $request)
    {
        $user = Auth::user();

        if ($request->changePass == "on")
        {
            $this->validate($request,
                [
                    'newPassword' => 'required|min:6',
                    'reNewPassword' => 'required|same:newPassword'
                ],
                [
                    'newPassword.required' => 'Bạn chưa nhập mật khẩu',
                    'reNewPassword.required' => 'Bạn chưa nhập lại mật khẩu',
                    'reNewPassword.same' => 'Mật khẩu nhập lại không khớp',
                ]
            );
            $user->password = bcrypt($request->newPassword);
            $user->save();
            return redirect('profile')->with('noti', 'Đổi mật khẩu thành công');
        }
         return redirect('profile');
    }
}
