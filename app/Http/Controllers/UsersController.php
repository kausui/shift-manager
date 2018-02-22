<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Availability;
use App\Shift;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $creater = \Auth::user();
        
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'office_id' => $creater->office_id,
            'role' => 'viewer',
            'password' => bcrypt($request['password']),
        ]);
        
        return redirect()->action('UsersController@show', ['id' => $user->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        
        if( \Auth::user()->office_id == $user->office_id) {
                $office = $user->office;
                $availabilities = $user->availabilities;
                
                $year = date('Y');
                $month = date('n');
                
                $shifts = Shift::where('user_id', $user->id )->where('year', $year)->where('month', $month)->get();

                return view('users.show', [
                    'user' => $user,
                    'office' => $office,
                    'availabilities' => $availabilities,
                    'shifts' => $shifts
                ]);
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
        $user = User::find($id);
        
        return view('users.edit', [
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
        $user = User::find($id);
        
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->monthly_max_workhours = $request->monthly_max_workhours;
        $user->daily_max_workhours = $request->daily_max_workhours;
        $user->daily_min_workhours = $request->daily_min_workhours;
        $user->role = $request->role;
        
        $user->save();
        
        return redirect()->action('UsersController@show', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    
}
