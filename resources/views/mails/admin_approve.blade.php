<x-mail::message>
# Nwe User

{{ $user->name }}!

<x-mail::button url="https://laravel.com">
Approve This User
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
