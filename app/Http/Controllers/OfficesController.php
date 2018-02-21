<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Office;
use App\RequiredStaffNumber;

class OfficesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $office = \Auth::user()->office;
        $users = $office->users;
        $requiredManHours = $this->calcRequiredManHour($office->id);
        $currentManHours = $this->calcCurrentManHour($office->id);
        $required_staf_numbers = $office->required_staff_numbers()->orderBy('time', 'asc')->paginate(56);
        
        return view('offices.index', [
            'office' => $office,
            'users' => $users,
            'required_staff_numbers' => $required_staf_numbers,
            'required_man_hours' => $requiredManHours,
            'current_man_hours' => $currentManHours,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $office = $this->store();
        //ユーザ登録を行なった際に呼び出されて新しい事業所が作成される
        //return view('offices.create');
        return $office;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $office = new Office;
        $office->name = '事業所名が設定されていません';
        
        $office->save();
        
        //新しいoffice作成後にidをuserに与えなければならない
        return $office;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if( \Auth::user()->office_id == $id) {
            $office = Office::find($id);
            $users = $office->users;
            $requiredManHours = $this->calcRequiredManHour($id);
            $required_staf_numbers = $office->required_staff_numbers()->orderBy('time', 'asc')->paginate(56);
            
            return view('offices.show', [
                'office' => $office,
                'users' => $users,
                'required_staff_numbers' => $required_staf_numbers,
                'required_man_hours' => $requiredManHours,
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
        if( \Auth::user()->office_id == $id) {
            $office = Office::find($id);
            $required_staf_numbers = $office->required_staff_numbers()->orderBy('time', 'asc')->paginate(56);
            
            return view('offices.edit', [
                'office' => $office,
                'required_staff_numbers' => $required_staf_numbers,
            ]);
        } else {
            return redirect('/');
        }
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
        if( \Auth::user()->office_id == $id && \Auth::user()->role == 'manager') {
            $office = Office::find($id);
            $office->name = $request->name;
            $office->save();
    
            $rSN = $office->required_staff_numbers;
            
            //スタッフの数の保存
            foreach ($rSN as $required_staff_number) {
                $key = $required_staff_number->weekday . $required_staff_number->time;
                
                if(isset($request[$key])) {
                    $required_staff_number->number = $request[$key];
                    $required_staff_number->save();
                }
            }
        }

        return redirect()->action('OfficesController@index');
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
    
    public function calcRequiredManHour($id)
    {
        $office = Office::find($id);
        $rSN = $office->required_staff_numbers;
        
        $hours = 0;
        
        foreach ($rSN as $required_staff_number) {
            $hours += $required_staff_number->number;
        }
        
        return $hours;
    }
    
    public function calcCurrentManHour($id)
    {
        $office = Office::find($id);
        $users = $office->users;
        
        $hours = 0;
        
        foreach ($users as $user) {
            $availabilities = $user->availabilities;
            foreach ($availabilities as $availability) {
                $hours += $availability->hours;
            }
        }
        
        return $hours;
    }
}
