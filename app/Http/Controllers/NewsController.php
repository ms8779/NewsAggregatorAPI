<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Category;
use App\Models\News;
use App\Models\Preferences;
use App\Models\Source;
use App\Models\User;
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

        if(!$news->total()){
            return response()->json([], Response::HTTP_NO_CONTENT);
        }

        return response()->json($news, Response::HTTP_OK);
    }

    public function show(Request $request, $id){

        $news = DB::table('news')->where('id', $id)->first();

        if(!$news){
            return response()->json(null, Response::HTTP_NO_CONTENT);
        }

        return response()->json($news, Response::HTTP_OK);
    }

    public function preferred(Request $request){
        $pref = Preferences::query()->where('user_id', auth()->user()->id)->first();

        $sources = json_decode($pref->sources);
        $authors = json_decode($pref->authors);
        $categories = json_decode($pref->categories);

        $news = News::query()
            ->when($categories, function ($query) use ($categories) {
                $query->WhereIn('category_id', $categories);
            })
            ->when($sources, function ($query) use ($sources) {
                $query->orWhereIn('source_id', $sources);
            })
            ->when($authors, function ($query) use ($authors) {
                $query->orWhereIn('author_id', $authors);
            })
            ->get();

        if(empty($news)){
            return response()->json(['success' => false], Response::HTTP_NO_CONTENT);
        }

        return response()->json($news, Response::HTTP_OK);
    }

    public function categories(Request $request){
        $categories= Category::query()->get();

        if(empty($categories)){
            return response()->json([], Response::HTTP_NO_CONTENT);
        }

        return response()->json($categories, Response::HTTP_OK);
    }

    public function authors(Request $request){
        $authors= Author::query()->get();

        if(empty($authors)){
            return response()->json([], Response::HTTP_NO_CONTENT);
        }

        return response()->json($authors, Response::HTTP_OK);
    }

    public function sources(Request $request){
        $source= Source::query()->get();

        if(empty($source)){
            return response()->json([], Response::HTTP_NO_CONTENT);
        }

        return response()->json($source, Response::HTTP_OK);
    }
}
