<?php

namespace App\Http\Controllers;

use App\Movie;
use App\Genre;
use Illuminate\Http\Request;
use App\Http\Resources\MovieResource;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::query();
        if (request("category_id")) {
            $genre  = Genre::FindOrFail(request()->category_id);
            $movies = $genre->movies();
        }

        if (request("rated")) {
            switch(request("rated")){
                case 'asc':
                    $movies = $movies->orderBy("vote_average","asc");
                    break;
                default:
                    $movies = $movies->orderBy("vote_average","desc");
                    break;
            }
        }

        if (request("popular")) {
            switch(request("popular")){
                case 'asc':
                    $movies = $movies->orderBy("popularity","asc");
                    break;
                default:
                    $movies = $movies->orderBy("popularity","desc");
                    break;
            }
        }



        $movies = $movies->get();

        return response()->json(MovieResource::collection($movies),200);
    }

}
