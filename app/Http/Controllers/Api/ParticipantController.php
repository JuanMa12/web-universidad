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

  public function store(Request $request)
  {
      Participant::create([
          'uuid' => Uuid::generate(4),
          'name'   => $request->name,
          'gender'   => $request->gender,
          'years'   => $request->years,
          'document'   => $request->document
      ]);

      return response()->json(['saved' => true]);
  }
}
