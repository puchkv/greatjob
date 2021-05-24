<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel = "stylesheet" href = "{{ URL::asset('css/reports.css') }}" />
    <title>Звітності</title>
</head>
<body>
    <section>
        <span class = "title">Панель звітностей</span>
        <article class = "row">
            <span class = "pretitle">Користувачі</span>
            <form action = "/reports/users" method = "POST" id = "users_form">
                @csrf
                <a id = "users_day" href = "javascript: void(0);">За сьогодні</a>
                <a id = "users_week" href = "javascript: void(0);">За неділю</a>
                <a id = "users_month" href = "javascript: void(0);">За місяць</a>
                <a id = "users_all" href = "javascript: void(0);">Весь час</a>
                <input name = "user_report_type" type = "text" id = "user_report_type">
            </form>
        </article>
        <article class = "row">
                <span class = "pretitle">Завдання</span>
                <form action = "/reports/tasks" method = "POST" id = "tasks_form">
                    @csrf
                    <a id = "tasks_day" href = "javascript: void(0);">За сьогодні</a>
                    <a id = "tasks_week" href = "javascript: void(0);">За неділю</a>
                    <a id = "tasks_month" href = "javascript: void(0);">За місяць</a>
                    <a id = "tasks_all" href = "javascript: void(0);">Весь час</a>
                    <input name = "tasks_report_type" type = "text" id = "tasks_report_type">
                </form>
            </article>
    </section>


<script>
    var user_report_type = document.getElementById("user_report_type");
    var tasks_report_type = document.getElementById("tasks_report_type");
    tasks_report_type.style.display = "none";
    user_report_type.style.display = "none";

    document.getElementById("users_day").addEventListener("click", function() {
        user_report_type.value = "day";
        document.getElementById('users_form').submit();
    });

    document.getElementById("users_week").addEventListener("click", function() {
        user_report_type.value = "week";
        document.getElementById('users_form').submit();
    });

    document.getElementById("users_month").addEventListener("click", function() {
        user_report_type.value = "month";
        document.getElementById('users_form').submit();
    });

    document.getElementById("users_all").addEventListener("click", function() {
        user_report_type.value = "all";
        document.getElementById('users_form').submit();
    });


    document.getElementById("tasks_day").addEventListener("click", function() {
        tasks_report_type.value = "day";
        document.getElementById('tasks_form').submit();
    });
    document.getElementById("tasks_week").addEventListener("click", function() {
        tasks_report_type.value = "week";
        document.getElementById('tasks_form').submit();
    });
    document.getElementById("tasks_month").addEventListener("click", function() {
        tasks_report_type.value = "month";
        document.getElementById('tasks_form').submit();
    });
    document.getElementById("tasks_all").addEventListener("click", function() {
        tasks_report_type.value = "all";
        document.getElementById('tasks_form').submit();
    });
</script>
</body>
</html>