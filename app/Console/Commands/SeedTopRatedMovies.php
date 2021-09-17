<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SeedTopRatedMoviesJob;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
class SeedTopRatedMovies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:movies';
    protected $topRatedMoviesSeederService;
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A Command to seed the {num_of_records} movies ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // interval is a configurable value stored in .env (no od seconds);
        $interval = (int)config("moviedb.intervalTimer");
        // the  job will be dispatched continously but it will wait CONFIGURABLE_INTERVAL_TIMER seconds
        while (true) {
                SeedTopRatedMoviesJob::dispatch();
                Log::info("Queue Called".(Carbon::now()));
                var_dump("Queue Called".(Carbon::now()));
                sleep($interval); //to allow the interval seconds between each time the job is dispatched
            }

    }
}
