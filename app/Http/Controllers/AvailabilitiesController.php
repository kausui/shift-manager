<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Availability;

class AvailabilitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     /*
    public function create()
    {
        return view('availabilities.create');
    }
    */
    
    public function newAvailability($id)
    {
        $user = User::find($id);
        
        return view('availabilities.create',[
            'user' => $user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::find($request->user_id);
        
        if( \Auth::user()->office_id == $user->office_id && \Auth::user()->role == 'manager') {
            
            $difference = $request->end - $request->start;
            
            if( $difference > 0) {
                $availability = new Availability;
                $availability->user_id = $request->user_id;
                $availability->weekday = $request->weekday;
                $availability->start = $request->start;
                $availability->hours = $difference;
                $availability->save();
                
                //登録された勤務時間を表示する
                return redirect()->back();
            } else {
                //勤務時間をマイナスにできないというエラーを出して戻す
                return redirect()->back();
            }
        } else {
            return redirect('/');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $availability = Availability::find($id);
        $user = $availability->user;
        
        return view('availabilities.edit',[
            'availability' => $availability,
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dd($id);
        
        $availability = Availability::find($id);
        
        dd($availability);
        
        $user = $availability->user;
        
        $difference = $request->end - $request->start;
        
        $availability->weekday = $request->weekday;
        $availability->start = $request->start;
        $availability->hours = $difference;
        
        $availability->save();
                
        //登録された勤務時間を表示する
        return redirect()->route('users', ['id' => $user->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $availability = Availability::find($id);
        $user = $availability->user;
        
        $availability->delete();

        //削除後にユーザの詳細へ戻る
        return redirect()->action(
            'UsersController@show', ['id' => $user->id]
        );
    }
}
