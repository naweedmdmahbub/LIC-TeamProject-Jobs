<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Company Registration Request</title>
</head>
<body>
    <h1>New Company Registration Request</h1>
    <p>
        <a href="{{ route('approve-company-from-email', ['user_id' => $user->id, 'token' => $user->remember_token]) }}"
             class="inline-block bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600"
        >
            Approve This User
        </a>
    </p>

    <p>Thanks,<br>{{ config('app.name') }}</p>
</body>
</html>
