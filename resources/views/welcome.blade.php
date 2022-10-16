@auth()
    <x-app-layout></x-app-layout>
@else
    <x-guest-layout></x-guest-layout>
@endauth
