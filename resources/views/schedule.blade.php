<!DOCTYPE html>
<html>
<head>
    <title>Developer Plan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- I used basic bootstrap style -->
</head>
<body>
<div class="container mt-4">
    <h1>Developer Bazında İş Yapma Programı:</h1>
    @foreach($developerPlans as $developerPlan)
        <div class="card mt-4">
            <div class="card-header">
                <h2 class="card-title">Developer: {{ $developerPlan['developer'] }}</h2>
            </div>
            <div class="card-body">
                <p>Toplam Çalışma Saati: {{ $developerPlan['totalHours'] }} saat</p>
                <p>Yapılacak İşler:</p>
                <ul>
                    @foreach($developerPlan['tasks'] as $task)
                        <li>{{ $task['task'] }} - {{ $task['hours'] }} saat</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endforeach
    <p>Minimum Toplam Hafta Sayısı: {{ $minimumWeeks }} hafta</p>
</div>
</body>
</html>
