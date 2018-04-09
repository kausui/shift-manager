<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;

use App\Office;
use App\User;
use App\Shift;
use App\RequiredStaffNumber;
use App\Availability;

class ShiftsController extends Controller
{
    
    private $week_ja = [
          '日', //0
          '月', //1
          '火', //2
          '水', //3
          '木', //4
          '金', //5
          '土', //6
        ];
    
    private $week_en = [
          'Sun', //0
          'Mon', //1
          'Tue', //2
          'Wed', //3
          'Thu', //4
          'Fri', //5
          'Sat', //6
        ];
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
                
                //登録された勤務時間を表示する処理が必要
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
        $shift = Shift::find($id);
        $user = $shift->user;
        
        return view('shifts.edit',[
            'shift' => $shift,
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
        $shift = Shift::find($id);
        $user = $shift->user;
        
        if( \Auth::user()->office_id == $user->office_id && \Auth::user()->role == 'manager') {
            
            $difference = $request->end - $request->start;
            
            if( $difference > 0) {
                
                $shift->year = date('Y', strtotime($request->date));
                $shift->month = date('n', strtotime($request->date));
                $shift->day = date('d', strtotime($request->date));
                
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shift = Shift::find($id);
        $user = $shift->user;
        
        $shift->delete();

        //削除後にユーザの詳細へ戻る
        return redirect()->action(
            'UsersController@show', ['id' => $user->id]
        );
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
            $days[] = $this->week_ja[$date];
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
            $days[] = $this->week_ja[$date];
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
    
    public function shifts_year_month_day($year, $month, $day)
    {
        $office = \Auth::User()->office;
        $users = $office->users;
        
        $shifts = array();
        
        foreach($users as $user)
        {
            $results = Shift::where('user_id', $user->id )->where('year', $year)->where('month', $month)->where('day', $day)->get();
            
            foreach($results as $result)
            {
                $shifts[] = $result;
            }
        }
        
        //指定した月の最後は？
        $tmpMonth = $year . '-' . $month;
        $last_day = date('d', strtotime('last day of ' . $tmpMonth));
        
        //時間ごとの必要人数の取得
        $timestamp = mktime(0, 0, 0, $month, $day, $year);
        $date = date('w', $timestamp);
        $required_staff_numbers = RequiredStaffNumber::where('office_id', $office->id)->where('weekday', $date)->orderBy('time', 'asc')->get();
        
        //時間ごとの人数過不足計算
        foreach($required_staff_numbers as $required_staff_number)
        {
            $husoku[] = $required_staff_number->number * -1;
        }
        
        foreach($shifts as $shift)
        {
            $start = $shift->start;
            $end = $shift->start + $shift->hours;
            
            for ($i = $start; $i < $end; $i++)
            {
                $husoku[$i]++;
            }
        }
        
        //日本語の曜日取得
        $weekday = $this->week_ja[$date];
        
        return view('shifts.year_month_day',[
            'office' => $office,
            'users' => $users,
            'year' => $year,
            'month' => $month,
            'day' => $day,
            'last_day' => $last_day,
            'shifts' => $shifts,
            'required_staff_numbers' => $required_staff_numbers,
            'weekday' => $weekday,
            'husoku' => $husoku,
        ]);
    }
    
    public function shifts_year_month_generate($year, $month)
    {
        $office = \Auth::User()->office;
        
        
        //シフト自動生成できるかどうかの条件の確認
        //人時の不足確認
        
        $required_man_hour = app('App\Http\Controllers\OfficesController')->calcRequiredManHour($office->id);
        $current_man_hour = app('App\Http\Controllers\OfficesController')->calcCurrentManHour($office->id);
        
        $hours_difference = $current_man_hour - $required_man_hour;
        
        if($required_man_hour > $current_man_hour)
        {
            
            //適切なValidatorの作り方が必要
            $validator = Validator::make(
                ['hours_difference' => $current_man_hour],
                ['hours_difference' => "max:${required_man_hour}"]
            );
            
            
            //dd($validator);
            //エラーを表示して生成を中断
            $validator->getMessageBag()->add('hours_difference', '１週間に必要な従業員の労働時間が足りません。従業員を追加して出勤可能な曜日を登録してください。');
            
            
            //return redirect()->action('ShiftsController@shifts_year_month', [$year, $month]);
            return redirect()->back()->withErrors($validator);
        }
        
        //曜日と時間別の不足確認
        //事業所の必要人数を２次元配列に展開
        $required_staff_numbers = $office->required_staff_numbers;
        
        $weekday_time_array = array( 0 => array(), 1=> array(), 2=> array(), 3=> array(), 4=> array(), 5=> array() , 6 => array());
        
        foreach ($required_staff_numbers as $required_staff_number) {
            $weekday_time_array[$required_staff_number->weekday] =  $weekday_time_array[$required_staff_number->weekday] + array( $required_staff_number->time => $required_staff_number->number);
        }
        
        //2次元配列から従業員の労働可能時間を引く
        $users = $office->users;
        $error_weekday_time_array = array();
        

        foreach($users as $user)
        {
            $results = Availability::where('user_id', $user->id )->get();

            foreach($results as $result)
            {
                $i = 0;
                $end = $result->start + $result->hours;
                
                for ($i = $result->start; $i < $end; $i++)
                {
                    $weekday_time_array[$result->weekday][$i]--;
                    
                    //$userが最後の要素で $weekday_time_array[$result->weekday][$i]が+だった場合はエラー配列に記録
                    if ($user === end($users))
                    {
                        if ($weekday_time_array[$result->weekday][$i] > 0)
                        {
                            $error_weekday_time_array = '${result->weekday}曜日の${i}時で${weekday_time_array[$result->weekday][$i]人足りていません。}';
                        }
                    }
                }
            }
        }
        
        dd($weekday_time_array);
        dd($error_weekday_time_array);
        
        //今月のシフトをクリア
        $users = $office->users;
        
        $shifts = array();
        
        foreach($users as $user)
        {
            $results = Shift::where('user_id', $user->id )->where('year', $year)->where('month', $month)->get();
            
            foreach($results as $result)
            {
                $result->delete();
            }
        }
        
        
        
        //シフト生成した月の表示に戻る
        return redirect()->action('ShiftsController@shifts_year_month', [$year, $month]);
    }
}
