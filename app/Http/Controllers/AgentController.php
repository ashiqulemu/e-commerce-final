<?php

namespace App\Http\Controllers;

use App\agent;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agent=DB::table('users')
            ->select('*')
            ->where('role','=','agent')
            ->get();

        return view('admin.pages.agent.manage',['agent'=>$agent]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.pages.agent.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        $user->credit_balance = 0;
        $user->singUp_credit = 0;
        $user->role ='agent';
        $user->save();


//        $mailData = [
//            'name' => $data['sign_username'],
//        ];
//        $this->sendEmail('email.email-welcome',$mailData ,'Welcome to adi.com.bd', $data['sign_email']);
//        return  $user;
        return redirect()->back()
            ->with(['type'=>'success','message'=>'Agent has created Successfully']);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function show(agent $agent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $agent=User::find($id);
       return view('admin.pages.agent.edit',['agent'=>$agent]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $user = User::find($id);
        $user->name = $request->sign_username;
        $user->username = $request->sign_username;
        $user->email= $request->sign_email;
        $user->mobile = $request->mobile;
        $user->role ='agent';
        $user->save();

        return redirect('/admin/agent')
            ->with(['type'=>'success','message'=>'Agent information Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sub=User::find($id);
        $sub->delete();
        return back()
            ->with(['type'=>'success','message'=>'Agent deleted successfully']);
    }
    public function active($id)
    {
        $inc=User::find($id);

        $inc->is_active=1;
        $inc->save();
        return redirect('/admin/agent')
            ->with(['type'=>'success','message'=>'Customer has been made Activate']);
    }
    public function inactive($id)
    {
        $inc=User::find($id);

        $inc->is_active=0;
        $inc->save();
        return redirect('/admin/agent')
            ->with(['type'=>'success','message'=>'Agent has been made inactive']);

    }
}
