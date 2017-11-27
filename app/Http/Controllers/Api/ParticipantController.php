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
          'name_one'   => $request->name_one,
          'name_two'   => $request->name_two,
          'lastname_one'   => $request->lastname_one,
          'lastname_two'   => $request->lastname_two,
          'type'   => $request->type,
          'born'   => $request->born,
          'gender'   => $request->gender,
          'deparment'   => $request->deparment,
          'city'   => $request->city,
          'type_document'   => $request->type_document,
          'school'   => $request->school,
          'document'   => $request->document
      ]);

      return response()->json(['saved' => true]);
  }

  public function remove(Request $request,$uuid)
  {
      $participant = Participant::where('uuid',$uuid)->first();
      $participant->delete();

      return response()->json(['remove' => true]);
  }
}
