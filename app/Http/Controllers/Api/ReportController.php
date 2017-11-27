<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Participant;
use Illuminate\Http\Request;

class ReportController extends Controller
{
  public function index()
  {
      $total_uses = User::all()->count();
      $total_participants = Participant::all()->count();
      $participants_woman = Participant::where('gender','femenino')->count();
      $participants_men = Participant::where('gender','masculino')->count();

      $particpants = Participant::all();

      $part_1_10 = [];
      $part_11_20 = [];
      $part_21_30 = [];
      $part_31_40 = [];
      $part_41_50 = [];
      $part_51_100 = [];

      foreach ($particpants as $key => $value) {
        if($value->years > 0 && $value->years < 11){
          $part_1_10[] = $value->years;
        }
        if($value->years > 10 && $value->years < 21){
          $part_11_20[] = $value->years;
        }
        if($value->years > 20 && $value->years < 31){
          $part_21_30[] = $value->years;
        }
        if($value->years > 30 && $value->years < 41){
          $part_31_40[] = $value->years;
        }
        if($value->years > 40 && $value->years < 51){
          $part_41_50[] = $value->years;
        }
        if($value->years > 50 && $value->years < 100){
          $part_51_100[] = $value->years;
        }
      }


      $participants_1_10 = count($part_1_10);
      $participants_11_20 =  count($part_11_20);
      $participants_21_30 =  count($part_21_30);
      $participants_31_40 =  count($part_31_40);
      $participants_41_50 =  count($part_41_50);
      $participants_51_100 =  count($part_51_100);

      $row = [
        'users' => $total_uses,
        'participants' => $total_participants,
        'woman' => $participants_woman,
        'men' => $participants_men,
        'participants_1_10' => $participants_1_10,
        'participants_11_20' => $participants_11_20,
        'participants_21_30' => $participants_21_30,
        'participants_31_40' => $participants_31_40,
        'participants_41_50' => $participants_41_50,
        'participants_51_100' => $participants_51_100
      ];

      $list_reports[] = $row;

      return response() ->json([ 'list' => $list_reports ]);
  }
}
