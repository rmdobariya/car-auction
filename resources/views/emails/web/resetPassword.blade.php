@component('mail::message')
    # Hello {{ $details['name'] }},
    Password Reset
    @component('mail::button', ['url' => $details['actionUrl']])
        Reset Button
    @endcomponent
    Thanks
@endcomponent
