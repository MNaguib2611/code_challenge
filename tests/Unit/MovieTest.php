<?php

namespace Tests\Unit;

use App\Movie;
use Tests\TestCase;

class MovieTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testApiResponse() {
        $response = $this->get('/api/movies');
        $response->assertStatus(200);
    }

    public function testCategoryIdFilter() {
        $response = $this->get('/api/movies?category_id=35');   //35 is Comedy id
        $response->assertStatus(200);


        $response = $this->get('/api/movies?category_id=34');  // 34 doesn't  exists
        $response->assertStatus(404);
    }




    public function testPopularFilter() {
        $response = $this->get('/api/movies?popular=asc');
        $response->assertStatus(200);
    }

    public function testRatedFilter() {
        $response = $this->get('/api/movies?rated=desc');
        $response->assertStatus(200);
    }


    public function testMovieCount() {
        $this->assertEquals(config('moviedb.numberOfRecords'), Movie::count());
    }




}
