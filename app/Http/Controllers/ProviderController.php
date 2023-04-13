<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Traits\WithErrorHandling;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    use WithErrorHandling;
    public function getTasks()
    {
        return $this->withErrorHandling(function (){
            return TaskResource::collection(Task::all());
        });

    }
}
