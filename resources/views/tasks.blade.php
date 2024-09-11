<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List by Week</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 20px;
        }

        h1, h2 {
            text-align: center;
            margin-top: 20px;
        }

        table {
            margin-top: 20px;
        }

        .week-section {
            margin-top: 40px;
        }

        .week-total {
            font-size: 1.2em;
            font-weight: bold;
            margin-top: 10px;
            text-align: right;
            color: #0d6efd;
        }

    </style>
</head>
<body>

<div class="container">
    <h1 class="display-4">Task List by Week</h1>

    {{-- Veriyi haftalara göre döngüye alalım --}}
    @foreach($tasks as $week => $taskList)
        <div class="week-section">
            <h2 class="text-primary">Week {{ $week }}</h2>

                <?php $weekTotalHours = 0; ?>

            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                <tr>
                    <th>Developer Name</th>
                    <th>Task ID</th>
                    <th>Week Number</th>
                    <th>Hours Worked</th>
                </tr>
                </thead>
                <tbody>
                @foreach($taskList as $task)
                    <tr>
                        <td>{{ $task['name'] ?? 'N/A' }}</td>
                        <td>{{ $task['task_id'] ?? 'N/A' }}</td>
                        <td>{{ $task['week_number'] ?? 'N/A' }}</td>
                        <td>{{ $task['hour'] ?? 'N/A' }}</td>
                            <?php $weekTotalHours += $task['hour'] ?? 0; ?>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{-- Haftalık toplam saatler --}}
            <div class="week-total">
                Total Hours for Week {{ $week }}: {{ $weekTotalHours }} hours
            </div>
        </div>
    @endforeach

</div>

{{-- Bootstrap JS (Opsiyonel) --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
