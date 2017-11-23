<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use App\Models\FavoritesField;
use App\Models\Field;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminController extends Controller
{

    public function field(Request $request)
    {
        $user = JWTAuth::parseToken()->toUser();
        $field = Field::adminField($user->id);
        $calendars = Calendar::with('user')->where('field_id',$field->id)->get();
        $i = 0;
        $dates = [];
        $start = Carbon::now()->startOfWeek()->toDateString();
        $end = Carbon::now()->endOfWeek()->toDateString();
        $dateView = $start;
        while(strtotime($end) >=  strtotime($start))
        {
            if(strtotime($end) != strtotime($dateView))
            {
                $dates[$i]['visit'] = FavoritesField::where('field_id',$field->id)
                    ->whereDate('created_at',$dateView)
                    ->count();
                $dates[$i]['date'] = $dateView;
                $dateView = date("Y-m-d", strtotime($dateView . " + 1 day"));
            }else{
                $dates[$i]['visit'] = FavoritesField::where('field_id',$field->id)
                    ->whereDate('created_at',$dateView)
                    ->count();
                $dates[$i]['date'] = $dateView;
                break;
            }
            $i++;
        }
        return response()
            ->json([
                'field' => $field,
                'calendars' => $calendars,
                'dates' => $dates
            ]);
    }

    public function edit(Request $request)
    {
        $user = JWTAuth::parseToken()->toUser();
        $field = Field::with('user')->where('admin_id', $user->id)->first();
        return response()
            ->json([
                'field' => $field
            ]);
    }

}
