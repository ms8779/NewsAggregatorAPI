<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class NewsController extends Controller
{
    public function index(Request $request){
        $query = DB::table('news');
        if($request->keywords){
            $query->whereLike('title', '%'.$request->keywords.'%');
        }
        if($request->category_id){
            $query->where('category_id', $request->category_id);
        }

        if($request->author_id){
            $query->where('author_id', $request->author_id);
        }

        if($request->source_id){
            $query->where('source_id', $request->source_id);
        }

        $size = intval($request->per_page) ? intval($request->per_page) : 10;

        $news  = $query->orderBy('published_at', 'desc')->paginate($size);

        return response()->json(['news' => $news], Response::HTTP_OK);
    }
}
