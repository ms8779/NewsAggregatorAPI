<?php

namespace App\Http\Controllers;

use App\Models\Preferences;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PreferencesController extends Controller
{
    //
    public function index(Request $request){
        $preferences = Preferences::query()->where('user_id', auth()->user()->id)->first();

        if(!$preferences)return response()->json(null, Response::HTTP_NO_CONTENT);

        return response()->json($preferences, Response::HTTP_OK);
    }

    public function create(Request $request){
        $result = Preferences::updateOrCreate([
            'user_id' => auth()->user()->id,
        ],[
            'categories' => json_encode($request->categories),
            'authors' => json_encode($request->authors),
            'sources' =>json_encode($request->sources)
        ]);

        if (!$result){

        }

        return response()->json(['success' => true], Response::HTTP_OK);
    }
}
