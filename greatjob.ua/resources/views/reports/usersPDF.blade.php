<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Звіт про користувачей</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body
        {
            height: 100%;
            background: #fff;
            background-size: cover;
            margin: 0;
            padding: 0;
            font-size: 14px;
            font-family: DejaVu Sans, sans-serif;
        }
        section
        {
            width: 100%;
            min-height: 100%;
        }

        span
        {
            padding: 5px;
            display: block;
        }

        table
        {
            width: 100%;
            
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
        <table style = "text-align: center" cellpadding="9">
            <tr>
                <th>id</th>
                <th>Ім'я</th>
                <th>Зареєстрован</th>
                <th>Завдань створено</th>
                <th>Завдань виконано</th>
                <th>Відгуків</th>
                <th>Відгуків залишено</th>
            </tr>

            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td style = "text-align: left">{{ $user->name }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->tasks->count() }}</td>
                    <td>{{ $user->works->count() }}</td>
                    <td>{{ $user->reviews->count() }}</td>
                    <td>{{ $user->sendReviews->count() }}</td>
            @endforeach
        </table>
        
    </section>
</body>
</html>