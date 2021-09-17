<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Movie;


class SeedTopRatedMoviesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $numberOfMovies;
    protected $numberOfPages;
    protected $remainingMovies;




    public function __construct()
    {
        $this->numberOfMovies = (int)(config("moviedb.numberOfRecords"));
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // first seed the no. of pages
        $count = 0;
        $client = new \GuzzleHttp\Client(['base_uri' => "https://api.themoviedb.org/"]); //HTTP Client was introduced in laravel 7 so we have to use GuzzleHttp
        for ($i=1;  $count < $this->numberOfMovies ; $i++) { //
            $response = $client->request("GET", "/3/movie/top_rated?api_key=".config("moviedb.key").'&page='.$i);
            $movies =(json_decode($response->getBody()->getContents()));
            foreach ( $movies->results as $movie) {
                if ($count < $this->numberOfMovies) {
                    $this->updateOrCreateMovie($movie);
                    $count++;
                }
            }
        }

    }

    private function updateOrCreateMovie($movie){
        $movieRecord = Movie::updateOrCreate(
            [
                "id"   =>$movie->id
            ]
            ,
            [
                "original_language" => $movie->original_language,
                "original_title"    => $movie->original_title,
                "title"             => $movie->title,
                "overview"          => $movie->overview,
                "adult"             => $movie->adult,
                "release_date"      => $movie->release_date,
                "popularity"        => $movie->popularity,
                "vote_average"      => $movie->vote_average,
                "vote_count"        => $movie->vote_count,
            ]
        );
        $movieRecord->genres()->sync($movie->genre_ids);
    }

}
