<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Customer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class CustomerController extends Controller
{

    public function index()
    {
        $customers = User::whereRole('user')->orderby('id','desc')->get();
        return view('admin.pages.customer.manage',['customers'=>$customers]);
    }

    public function create()
    {
        return view('admin.pages.customer.create');
    }

    public function store(Request $request)
    {


        $request->validate([

            'sign_username' => 'required|string|max:100|unique:users,username',
            'sign_email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'sign_password' => ['required', 'string', 'min:6'],
        ]);


        $user = new User();
        $user->name = $request->sign_username;
        $user->username = $request->sign_username;
        $user->email= $request->sign_email;
        $user->password = Hash::make($request->sign_password);
        $user->mobile = $request->mobile;
        $user->role ='user';
        $user->save();


//        $mailData = [
//            'name' => $data['sign_username'],
//        ];
//        $this->sendEmail('email.email-welcome',$mailData ,'Welcome to adi.com.bd', $data['sign_email']);
//        return  $user;
        return redirect()->back()
            ->with(['type'=>'success','message'=>'Customer has created Successfully']);

    }

    public function show(Customer $customer)
    {
        //
    }


    public function edit($id)
    {
        $customer=User::find($id);
        return view('admin.pages.customer.edit',['customer'=>$customer]);
    }


    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->sign_username;
        $user->username = $request->sign_username;
        $user->email= $request->sign_email;
        $user->mobile = $request->mobile;
        $user->role ='user';
        $user->save();

        return redirect('/admin/customer')
            ->with(['type'=>'success','message'=>'Customer information Updated Successfully']);
    }


    public function destroy($id)
    {
        $sub=User::find($id);
        $sub->delete();
        return back()
            ->with(['type'=>'success','message'=>'Customer deleted successfully']);
    }
    public function active($id)
    {
        $inc=User::find($id);

        $inc->is_active=1;
        $inc->save();
        return redirect('/admin/customer')
            ->with(['type'=>'success','message'=>'Customer has been made Activate']);
    }
    public function inactive($id)
    {
       $inc=User::find($id);

       $inc->is_active=0;
       $inc->save();
        return redirect('/admin/customer')
            ->with(['type'=>'success','message'=>'Customer has been made inactive']);

    }

}
