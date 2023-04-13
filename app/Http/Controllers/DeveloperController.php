<?php

namespace App\Http\Controllers;

use App\Http\Resources\ScheduleResource;
use App\Models\Developer;
use App\Models\Schedule;
use App\Models\Task;
use App\Traits\WithErrorHandling;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    use WithErrorHandling;
    public function makePlan()
    {
        return $this->withErrorHandling(function (){
             $developers = [
                'DEV1' => ['time' => 1, 'difficulty' => 1],
                'DEV2' => ['time' => 1, 'difficulty' => 2],
                'DEV3' => ['time' => 1, 'difficulty' => 3],
                'DEV4' => ['time' => 1, 'difficulty' => 4],
                'DEV5' => ['time' => 1, 'difficulty' => 5]
            ];

            $speeds = [];

            foreach ($developers as $developer => $values) {
                $time = $values['time'];
                $difficulty = $values['difficulty'];
                $speed = $time * $difficulty;
                $speeds[$developer] = $speed;
            }
            foreach ($speeds as $developer => $speed) {
                echo "Developer: $developer, Hızı: $speed \n";
            }

            $tasks = Task::all();
            $weeklyHours = 45;
            $totalDuration = 0;
            $totalDifficulty = 0;

            // sum of difficulty and duration of tasks
            foreach ($tasks as $task) {
                $totalDuration += $task['duration'];
                $totalDifficulty += $task['duration'] * $task['difficulty'];
            }

            dd($totalDuration);

            $minimumWeeks = ceil($totalDifficulty / ($weeklyHours * $totalDuration));

            dd($minimumWeeks);

            foreach($developers as $developer => $values){
                echo "Developer: " . $developer . "\n";
                echo "Toplam Çalışma Saati: " . $minimumWeeks * $weeklyHours * $values['time'] . " saat\n";
            }
            echo "Minimum Toplam Hafta Sayısı: " . $minimumWeeks . " hafta\n";
        });

    }

    public function schedule()
    {
        return $this->withErrorHandling(function (){
            return ScheduleResource::collection(Schedule::all());
        });
    }

    public function yedek()
    {
        return $this->withErrorHandling(function (){
            $developers = [
                'DEV1' => ['time' => 1, 'difficulty' => 1],
                'DEV2' => ['time' => 1, 'difficulty' => 2],
                'DEV3' => ['time' => 1, 'difficulty' => 3],
                'DEV4' => ['time' => 1, 'difficulty' => 4],
                'DEV5' => ['time' => 1, 'difficulty' => 5]
            ];

            $speeds = [];
            $tasks = Task::all();
            $totalTaskSize= 0;
            $weeklyWorkingHours = 45;

            foreach ($developers as $developer => $values) {
                $time = $values['time'];
                $difficulty = $values['difficulty'];
                $speed = $time * $difficulty;
                $speeds[$developer] = $speed;
            }

            foreach($tasks as $task){
                $totalTaskSize += $task['duration'] * $task['difficulty'];
            }

            $minimumWeeks = ceil($totalTaskSize / $weeklyWorkingHours);

            $developerPlans = [];
            foreach($speeds as $developer => $speed){
                $developerPlan = [
                    'developer' => $developer,
                    'tasks' => [],
                    'totalHours' => 0
                ];
                foreach($tasks as $task){
                    $hours = ceil(($task['duration'] * $task['difficulty']) / $speed);
                    $developerPlan['tasks'][] = [
                        'task' => $task['task'],
                        'hours' => $hours
                    ];
                    $developerPlan['totalHours'] += $hours;
                }
                $developerPlans[] = $developerPlan;
            }

            echo "Developer Bazında İş Yapma Programı:\n";
            foreach($developerPlans as $developerPlan){
                echo "Developer: " . $developerPlan['developer'] . "\n";
                echo "Toplam Çalışma Saati: " . $developerPlan['totalHours'] . " saat\n";
                echo "Yapılacak İşler:\n";
                foreach($developerPlan['tasks'] as $task){
                    echo "- " . $task['task'] . " - " . $task['hours'] . " saat\n";
                }
                echo "\n";
            }

            echo "Minimum Toplam Hafta Sayısı: " . $minimumWeeks . " hafta\n";

        });

    }

}
