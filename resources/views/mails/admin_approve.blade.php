<x-mail::message>
    # New Company Registration Request

    <x-mail::button url="https://laravel.com">
        Approve This User
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
