<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Traits\WithErrorHandling;

class PlanController extends Controller
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
                        'task' => $task['name'],
                        'hours' => $hours
                    ];
                    $developerPlan['totalHours'] += $hours;
                }
                $developerPlans[] = $developerPlan;
            }

            return view('schedule', compact('developerPlans', 'minimumWeeks'));

        });


    }


}
