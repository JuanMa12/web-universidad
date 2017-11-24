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

      $participants_1_10 = Participant::where('years','>','0')->where('years','<','11')->count();
      $participants_11_20 = Participant::where('years','>','10')->where('years','<','21')->count();
      $participants_21_30 = Participant::where('years','>','20')->where('years','<','31')->count();
      $participants_31_40 = Participant::where('years','>','30')->where('years','<','41')->count();
      $participants_41_50 = Participant::where('years','>','40')->where('years','<','51')->count();
      $participants_51_100 = Participant::where('years','>','50')->where('years','<','100')->count();

      $list_reports = [
        'users' => $total_uses,
        'participants' => $total_participants,
        'woman' => $participants_woman,
        'men' => $participants_men,
        'participants_1_10' => $participants_1_10,
        'participants_11_20' => $participants_11_20,
        'participants_21_30' => $participants_21_30,
        'participants_31_40' => $participants_31_40,
        'participants_41_50' => $participants_41_50,
        'participants_51_100' => $participants_51_100,
      ];
      
      return response() ->json([ 'list' => $list_reports ]);
  }
}
