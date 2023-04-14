<!DOCTYPE html>
<html>
<head>
    <title>Task Table</title>
</head>
<body>
<ul>
    @foreach ($tasks as $task)
        <li>{{ $task->name }} - Duration: {{ $task->duration }} hours - Difficulty: {{ $task->difficulty }}</li>
    @endforeach
</ul>
</body>
</html>
