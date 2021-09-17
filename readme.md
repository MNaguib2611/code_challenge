# Trufla Code Challenge – PHP Developer 
## About the task
* a schedule movie seeder API Service from https://www.themoviedb.org .
* The schedule runs every {configrable_interval_timer} to include the top {num_of_records}  movies
* Only one end point [http://localhost:8000/api/movies] was developed
* filters were created ```?category_id=5``` & ```?popular=desc```& ```rated=asc```
* This task was developed through ```Laravel 5.8```
* 
### bonuses
- [x] Run the Api and Client app using docker containers.
- [x] Using laravel Queue to handle the seeder task.
- [x] The program should come with acceptance test cases.
- [x] Create a Public Github repository and submit your code and just sharing the URL of the repository.


## How to run the task
* After cloning this repo,open code_challenge directory.
* Simply run ```./bin/setup.sh``` .this file contains a bash script that will setup the project .
* The ```./bin/setup.sh``` file contains explaination about what ach command does. 
* The script in ```./bin/setup.sh``` will build the docker containers,install composer dependencies,seed movie genres and will run a command to queue the top rated movies every  {configrable_interval_timer}.
* If the script stopped excuting ,simple use ```./bin/runQueue.sh``` to start the queue again
* Run the test cases through the ```./bin/runTests.sh```


###  How Queue works
* the script ```./bin/runQueue.sh``` will call a ``php artisan`` command ```php artisan seed:movies```.This commands has an infinite loop that dispatches a task to a queue then sleeps for {configrable_interval_timer} seconds then dispatches the task to the queue again.
* The  Queue calls the end points https://www.themoviedb.org to get the top rated {num_of_records} movies and every  {configrable_interval_timer} it will update this list

### Notes:
* A postman collection ```code_challenge.postman_collection.json``` containing the ```/api/movies``` request was attached to this task for convenience.
* The https://www.themoviedb.org . endpoints always retuns movies in pages ,each page containing 20 records.
* Another approach was to use Laravel task schedulers ,but this would have required running a cron job through the operating system ex:crontab -e  in linux
* In case Laravel task schedulers was used ,the cron jib would be called through docker container ex:```* * * * * docker exec backend bash -c "php artisan schedule:run"```
