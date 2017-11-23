<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterFieldRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\Field;
use App\Models\Calendar;
use App\Models\FavoritesField;
use App\Models\User;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Webpatser\Uuid\Uuid;
use Illuminate\Support\Facades\DB;
use JWTAuth;

class HomeController extends Controller
{
    public function create()
    {
        return response()
            ->json([
                'form' => User::initialize()
            ]);
    }

    public function store(RegisterUserRequest $request)
    {
        $user = User::create([
            'uuid' => Uuid::generate(4),
            'name'   => $request->name,
            'email'   => $request->email,
            'password'   => bcrypt($request->password),
            'codeActive' => str_random(6)
        ]);

        Mail::send('emails.welcome', ['user' => $user], function ($m) use ($user) {
            $m->from('jumaru-97@hotmail.com', 'QueCotejo');

            $m->to($user->email, $user->name)->subject('Welcome to QueCotejo!');
        });

        return response()->json(['saved' => true]);
    }

    public function login(LoginUserRequest $request)
    {
        $user = User::where('email',$request->email)->first();
        if($user != null){
            if($user->active == '1')
            {
                try{
                    $token = JWTAuth::attempt($request->only('email','password'),[
                        'exp' => Carbon::now()->addWeek()->timestamp,
                    ]);

                }catch (JWTException $e){
                    return response()->json(
                        ['incorrect' => 'Email o password incorrect'],500
                    );
                }
            }else{
                return response()->json(
                    ['incorrect' => 'Email not active'],481
                );
            }
        }else{
            return response()->json(
                ['incorrect' => 'Email o password incorrect'],481
            );
        }


        if($token == false){
            return response()->json(
                ['incorrect' => 'Verify email and password'],481
            );
        }else{
            return response()->json(['token'=> $token]);
        }
    }


    public function field()
    {
        return response()
            ->json([
                'form' => Field::initialize()
            ]);
    }
    public function fieldStore(RegisterFieldRequest $request){
        $user = User::create([
            'uuid' => Uuid::generate(4),
            'rol' => 'admin',
            'name'   => $request->name,
            'email'   => $request->email,
            'password'   => bcrypt($request->password),
            'codeActive' => str_random(6)
        ]);
        Field::create([
            'uuid' => Uuid::generate(4),
            'field_name'   => $request->field_name,
            'address'   => $request->address,
            'phone'   => $request->phone,
            'admin_id' => $user->id
        ]);

        Mail::send('emails.welcome', ['user' => $user], function ($m) use ($user) {
            $m->from('jumaru-97@hotmail.com', 'QueCotejo');

            $m->to($user->email, $user->name)->subject('Welcome to QueCotejo!');
        });

        return response()->json(['saved' => true]);
    }

    public function home(Request $request)
    {
        return JWTAuth::parseToken()->toUser();
    }

    public function verify(Request $request)
    {
        $user = User::where('codeActive', $request->name)->first();
        if($user != null)
        {
            $userBy = User::find($user->id);
            $userBy->active = '1';
            $userBy->save();
            return response()->json(
                ['saved' => true]);

        }else{
            return response()->json(
                ['incorrect' => 'Code incorrect'],481
            );
        }

    }

    public function fields()
    {
       $fields = Field::all();
        return response()->json(['fields' => $fields]);
    }

    public function showField($id)
    {
      $field = Field::byUuid($id);
      $visit = FavoritesField::create([
          'field_id' => $field->id,
          'user_id' => 1,
          'visit' => 1
      ]);
      return response()
          ->json([
              'model' => $field
          ]);
    }

    public function visitFields()
    {
        $visits = FavoritesField::with('field')
        ->select('field_id', DB::raw('SUM(visit) as total_visits'))
            ->groupBy('field_id')->get();

        return response()->json(['visits' => $visits]);
    }

    public function reserverFields()
    {
        $reserves = Calendar::with('field')
        ->select('field_id', DB::raw('count(*) as total_reserves'))
            ->groupBy('field_id')->get();

        return response()->json(['reserves' => $reserves]);
    }

}
