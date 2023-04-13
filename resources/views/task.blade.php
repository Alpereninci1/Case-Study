<!DOCTYPE html>
<html>
<head>
    <title>Share Tasks</title>
</head>
<body>
<h1>Weekly Tasks to Share with Development Team</h1>
<ul>
    @foreach ($tasks as $task)
        <li>{{ $task->name }} - Duration: {{ $task->duration }} hours - Difficulty: {{ $task->difficulty }}</li>
    @endforeach
</ul>
</body>
</html>
