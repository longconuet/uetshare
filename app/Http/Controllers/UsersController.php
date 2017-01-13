<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

use App\User;

use Mail;

class UsersController extends Controller
{
    // -------------------Admin----------------------------
    public function getList()
    {
    	$users = User::paginate(10);
        $quantity = count(User::all());
    	return view('admin.user.list', ['users'=>$users, 'quantity'=>$quantity]);
    }

    public function getEdit($id)
    {
    	$user = User::find($id);
    	return view('admin.user.edit', ['user'=>$user]);
    }

    public function postEdit($id, Request $request)
    {
    	$user = User::find($id);
    	$user->is_admin = $request->is_admin;
    	$user->save();

    	return redirect('admin/user/edit/'.$id)->with('noti', 'Đổi quyền thành công');
    }
    // ------------------------End Admin-------------------------------


    // -----------------------Login and Register-----------------------
    public function getLogin()
    {
        return view('user.login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
                'username' => 'required',
                'password' => 'required'
            ], [
                'username.required' => 'Bạn chưa nhập tên đăng nhập',
                'password.required' => 'Bạn chưa nhập mật khẩu'
            ]
        );

        $username = $request->username;
        $password = $request->password;
        if (Auth::attempt(['username'=>$username, 'password'=>$password]))
        {
            if (Auth::user()->active == 1)
                return redirect('/');
            else
                return redirect('login')->with('noti', 'Tài khoản chưa được kích hoạt. Vui lòng truy cập email của bạn để kích hoạt!');
        }
        else
        {
            return redirect('login')->with('noti', 'Đăng nhập không thành công');
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function getSignup()
    {
        return view('user.signup');
    }

    public function postSignup(Request $request)
    {
        $this->validate($request, [
                'username' => 'required|min:6|max:20|unique:users,username',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|max:20',
                'confirmpass' => 'required|same:password'
            ], [
                'username.required' => 'Chưa nhập tên đăng nhập',
                'username.min' => 'Tên đăng nhập phải ít nhất có 6 ký tự',
                'username.max' => 'Tên đăng nhập tối đa 20 ký tự',
                'username.unique' => 'Tên đăng nhập đã tồn tại',
                'email.required' => 'Chưa nhập email',
                'email.unique' => 'Email đã tồn tại',
                'email.email' => 'Email không đúng',
                'password.required' => 'Chưa nhập mật khẩu',
                'password.min' => 'Mật khẩu phải ít nhất có 6 ký tự',
                'password.max' => 'Mật khẩu tối đa có 20 ký tự',
                'confirmpass.required' => 'Chưa nhập lại mật khẩu',
                'confirmpass.same' => 'Mật khẩu không khớp'
            ]
        );

        do {
            $code = str_random(30);
            $user_code = User::where('code', $code)->first();
        } while(!empty($user_code));

        $user = new User;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->email = $request->email;
        $user->code = $code;
        $user->active = 0;
        $user->is_admin = 0;

        Mail::send('user.mail', ['user'=>$user], function ($message) use ($user) {
            $message->from('ptudweb7@gmail.com', 'UET-Share');         
            $message->to($user->email, $user->username);           
            $message->subject('Active code');
        });

        $user->save();
        return redirect('signup')->with('noti-success', 'Đăng ký tài khoản thành công. Vui lòng truy cập email của bạn để xác nhận kích hoạt tài khoản');
    }

    public function activeCode($code)
    {
        $user = User::where('code', $code)->first();
        if ($user->active == 1)
        {
            echo "Tài khoản này đã được kích hoạt trước đó.";
        }
        else
        {
            $user->active = 1;
            $user->save();
            return redirect('login')->with('noti-success', 'Kích hoạt tài khoản thành công!');
        }            
    }

}
