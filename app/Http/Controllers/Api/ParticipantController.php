<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;

class ParticipantController extends Controller
{
  public function index()
  {
      return response()
          ->json([
              'list' => Participant::all()
          ]);
  }
}
