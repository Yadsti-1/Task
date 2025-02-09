<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shared Task</title>
</head>
<body>
    <p>Hello {{ $user->name }},</p>
    <p>You have been shared a task.</p>
    <p>Task: {{ $task->name }}</p>
    <p>Task Description: {{ $task->description }}</p>
    <p>User shared: {{ $user->name }} | {{ $user->email }}</p>
</body>
</html>