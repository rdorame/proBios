<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Session;
use Image;
use Stripe\Stripe;
use View;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    //
    public function getSignup(){
      return view('user.signup');
    }

    public function postSignup(Request $request){
      $this->validate($request, [
          'name' => 'required',
          'email' => 'email|required|unique:users',
          'password' => 'required|min:6'
      ]);
      $user = new User([
          'name' => $request->input('name'),
          'email' => $request->input('email'),
          'password' => bcrypt($request->input('password'))
      ]);
      $user -> save();
      Auth::login($user);

      if(Session::has('oldUrl')){
          $oldUrl = Session::get('oldUrl');
          Session::forget('oldUrl');
          return redirect()->to($oldUrl);
      }
      else{
          return redirect()->route('user.profile');
      }
    }

    public function getSignin(){
      return view('user.signin');
    }

    public function postSignin(Request $request){
      $this->validate($request, [
          'email' => 'email|required',
          'password' => 'required|min:6'
      ]);

      if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])){
        if(Session::has('oldUrl')){
            $oldUrl = Session::get('oldUrl');
            Session::forget('oldUrl');
            return redirect()->to($oldUrl);
        }
        else{
            return redirect()->route('user.profile');
        }
      }
      return redirect()->back();
    }

    public function getProfile(){
      $orders = Auth::user()->orders;
      $orders->transform(function($order, $key){
        $order->cart = unserialize($order->cart);
        return $order;
      });
      return view('user.profile', ['user' => Auth::user(),'orders' => $orders]);
    }

    public function postEdit(Request $request, $id){
      $orders = Auth::user()->orders;
      $orders->transform(function($order, $key){
        $order->cart = unserialize($order->cart);
        return $order;
      });
      return redirect()->view('user.profile', ['user' => Auth::user(),'orders' => $orders])
                ->with('success','Perfil actualizado.');
    }

    public function getEdit(){
      return view('user.edit', ['user' => Auth::user()]);
    }

    public function getLogout(){
      Auth::logout();
      return redirect()->route('user.signin');
    }

    public function updateAvatar(Request $request){
      $orders = Auth::user()->orders;
      $orders->transform(function($order, $key){
        $order->cart = unserialize($order->cart);
        return $order;
      });

      if($request->hasFile('avatar')){
        $avatar = $request->file('avatar');
        $filename = time() . '.' . $avatar->getClientOriginalExtension();
        Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename ) );
        $user = Auth::user();
        $user->avatar = $filename;
        $user->save();
      }
      return view('user.profile', ['user' => Auth::user(), 'orders' => $orders] );
    }

    public function destroy($id)
    {
      User::find($id)->delete();
      return redirect()->route('admin.users')
              ->with('success','Usuario borrado.');
    }

}
