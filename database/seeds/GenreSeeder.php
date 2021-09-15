<?php

use App\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client = new \GuzzleHttp\Client(['base_uri' => "https://api.themoviedb.org/"]); //HTTP Client was introduced in laravel 7 so we have to use GuzzleHttp
        $response = $client->request("GET", "/3/genre/movie/list?api_key=".config("moviedb.key"));
        $genres =(json_decode($response->getBody()->getContents()));
        foreach ( $genres->genres as $genre) {
            Genre::updateOrCreate(
                ["id"=>$genre['id']]
                ,
                ["id"=>$genre['id'],"genre"=>$genre['name']]);
        }

    }
}
