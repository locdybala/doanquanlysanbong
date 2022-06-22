<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index(){
    $admin=User::with('roles')->orderBy('id','DESC')->get();
    return view('admin.user.index',compact('admin'));
    }
    public function add_user(){
        return view('admin.user.add');
    }

    //Chuyển quyền
    public function impersonate($id){
        $user=User::where('id',$id)->first();
        if($user){
            session()->put('impersonate',$user->id);
        }
        return redirect('/admin/all_users');
    }
    public function impersonate_destroy(){
        session()->forget('impersonate');
        return redirect('/admin/all_users');
    }
    public function addUser(Request $request){
         $this->validation($request);
        $data=$request->all();
        $user=new User();
        $user->name=$data['name'];
        $user->phone=$data['phone'];
        $user->email=$data['email'];
        $user->password=md5($data['password']);
        $user->save();
        $user->roles()->attach(Role::where('name','user')->first());
        return view('admin.user.index')->with('success','Đăng ký thành công');

    }

    public function assign_roles(Request $request){
        if(Auth::id()==$request->id){
            return redirect()->back()->with('message','Không được phân quyền chính mình');
        }
        $user=User::where('email',$request->email)->first();
        $user->roles()->detach();
        if($request->auth_role){
            $user->roles()->attach(Role::where('name','auth')->first());
        }
        if($request->admin_role){
            $user->roles()->attach(Role::where('name','admin')->first());
        }
        if($request->user_role){
            $user->roles()->attach(Role::where('name','user')->first());
        }
        
        return redirect()->back()->with('success','Cấp quyền thành công');

    }
    public function deleteUser_role($id){
        if(Auth::id()==$id){
            return redirect()->back()->with('message','Không được xóa chính mình');
        }
            $user=User::find($id);
            if($user){
                $user->roles()->detach();
                $user->delete();
            }
            
            return redirect()->back()->with('success','Xóa user thành công');
        
    }
}
