<?php

namespace App\Console\Commands;

use App\Http\Resources\TaskResource;
use App\Models\Developer;
use App\Models\Task;
use App\Traits\WithErrorHandling;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;


class GetTasksCommand extends Command
{
    use WithErrorHandling;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-tasks-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $url_1 = Http::get('http://www.mocky.io/v2/5d47f24c330000623fa3ebfa'); // get task from url
        $task_1 = $url_1->json();

        $url_2 = Http::get('http://www.mocky.io/v2/5d47f235330000623fa3ebf7'); // get task from url
        $task_2 = $url_2->json();

        //create a task model
        foreach ($task_1 as $task) {
            Task::create([
                'name' => $task['id'],
                'duration' => $task['sure'],
                'difficulty' => $task['zorluk']
            ]);
        }

        foreach ($task_2 as $task) {
            foreach ($task as $name => $data) {
                Task::create([
                    'name' => $name,
                    'duration' => $data['estimated_duration'],
                    'difficulty' => $data['level']
                ]);
            }
        }

    }

}
