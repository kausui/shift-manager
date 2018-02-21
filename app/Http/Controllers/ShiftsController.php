<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Office;
use App\User;
use App\Shift;

class ShiftsController extends Controller
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
    public function create()
    {
        //
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
                $shift = new Shift;
                
                
                $shift->year = date('Y', strtotime($request->date));
                $shift->month = date('n', strtotime($request->date));
                $shift->day = date('d', strtotime($request->date));
                
                $shift->user_id = $request->user_id;
                $shift->start = $request->start;
                $shift->hours = $difference;
                $shift->save();
                
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
    
    public function newShift($id)
    {
        //$shift = new Shift;
        $user = User::find($id);
        
        return view( 'shifts.create' ,[
            'user' => $user
        ]);
    }
    
    public function shifts_year_month($year, $month)
    {
        $office = \Auth::User()->office;
        $users = $office->users;
        
        $week = [
          '日', //0
          '月', //1
          '火', //2
          '水', //3
          '木', //4
          '金', //5
          '土', //6
        ];
        
        $shifts = array();
        
        foreach($users as $user)
        {
            $results = Shift::where('user_id', $user->id )->where('year', $year)->where('month', $month)->get();
            
            foreach($results as $result)
            {
                $shifts[] = $result;
            }
        }
        

        //指定した月の最後は？
        $tmpMonth = $year . '-' . $month;
        $last_day = date('d', strtotime('last day of ' . $tmpMonth));
        //$last_day = date('t');
        
        $days = array();
        
        for ($i = 1; $i <= $last_day; $i++)
        {
            $timestamp = mktime(0, 0, 0, $month, $i, $year);
            $date = date('w', $timestamp);
            $days[] = $week[$date];
        }
        
        return view('shifts.year_month_show',[
            'office' => $office,
            'users' => $users,
            'year' => $year,
            'month' => $month,
            'last_day' => $last_day,
            'shifts' => $shifts,
            'days' => $days
        ]);
    }
    
    public function shifts_year_month_edit($year, $month)
    {
        $office = \Auth::User()->office;
        $users = $office->users;
        
        $week = [
          '日', //0
          '月', //1
          '火', //2
          '水', //3
          '木', //4
          '金', //5
          '土', //6
        ];
        
        $shifts = array();
        
        foreach ($users as $user)
        {
            $shifts[] = $user->shifts;
        }
        
        //指定した月の最後は？
        $tmpMonth = $year . '-' . $month;
        $last_day = date('d', strtotime('last day of ' . $tmpMonth));
        //$last_day = date('t');
        
        $days = array();
        
        for ($i = 1; $i <= $last_day; $i++)
        {
            $timestamp = mktime(0, 0, 0, $month, $i, $year);
            $date = date('w', $timestamp);
            $days[] = $week[$date];
        }
        
        return view('shifts.year_month_edit',[
            'office' => $office,
            'users' => $users,
            'year' => $year,
            'month' => $month,
            'last_day' => $last_day,
            'shifts' => $shifts,
            'days' => $days
        ]);
    }
    
    public function shifts_year_month_update($request)
    {
        
    }
}
