@component('mail::layout')

    @slot('header')
        @component('mail::header', ['url' => 'https://car-auction.projectdemo.click'])
            <img src="{{asset('media/logos/logo.png')}}">
        @endcomponent
    @endslot

    {{ $slot }}

    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset

    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
        @endcomponent
    @endslot
@endcomponent
