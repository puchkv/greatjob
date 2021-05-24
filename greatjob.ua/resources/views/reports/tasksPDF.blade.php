<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Звіт про користувачей</title>
    <style>
        body
        {
            width: 100%;
            height: 100%;
            background: #fff;
            font-size: 14px;
            font-family: DejaVu Sans, sans-serif;
        }
        section
        {
            display: block;
            padding: 5px;
        }

        span
        {
            display: block;
        }

        table
        {
            width: 100%;
            margin: 0 auto;
        }

        table, tr, td, th
        {
            border: 1px solid #c0c0c0;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <section>
        <span>Час створення: {{ Carbon\Carbon::now() }}</span>
        @if($date != null)
            <span>За період: {{ $date }} - {{ Carbon\Carbon::now() }}</span>
        @else
            <span>За весь час</span>
        @endif
        <table style = "text-align: center">
            <tr>
                <th>id</th>
                <th>Назва</th>
                <th>Замовник</th>
                <th>Виконавець</th>
                <th>Ціна</th>
                <th>Місто</th>
                <th>Статус</th>
                <th>Створено</th>
                <th>Затверджено</th>
                <th>Виконано</th>
            </tr>

            @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td style = "text-align: left">{{ $task->title }}</td>
                    <td>{{ $task->user->name }}</td>
                    @if($task->performer)
                        <td>{{ $task->performer->name }}</td>
                    @else
                        <td>Ні</td>
                    @endif
                    <td>{{ $task->cost }}</td>
                    <td>{{ $task->user->city }}</td>
                    <td>{{ $task->getStatusName($task->status) }}</td>
                    <td>{{ $task->created_at }}</td>
                    <td>{{ $task->accepted_at }}</td>
                    <td>{{ $task->done_at}}</td>
            @endforeach
        </table>
        
    </section>
</body>
</html>