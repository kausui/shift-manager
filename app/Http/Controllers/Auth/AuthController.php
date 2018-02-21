<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Office;
use App\RequiredStaffNumber;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;


    protected $redirectTo = '/';
    protected $loginPath = '/login';
    
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'office_name' => 'required|max:255',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        //Officeを作成
        $office = new Office;
        $office->name = $data['office_name'];
        $office->save();
        
        //Officeの初期RequiredStaffNumbersも作成
        $weekdays = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        
        foreach ($weekdays as $weekday) {
            for ($i = 0; $i < 24; $i++) {
                //RequiredStaffNumberを作成
                $rSN = new RequiredStaffNumber;
                $rSN->office_id = $office->id;
                $rSN->weekday = $weekday;
                $rSN->time = $i;
                $rSN->number = 0;
                $rSN->save();
            }
        }
        
        //Userの出勤可能設定も作成する必要があると思ったが、なくてもいいと気づいた
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'office_id' => $office->id,
            'role' => 'manager',
            'password' => bcrypt($data['password']),
        ]);
    }
}
