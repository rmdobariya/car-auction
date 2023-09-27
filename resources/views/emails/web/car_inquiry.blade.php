@component('mail::message')
    # Hello {{ $details['full_name'] }},
    {{$details['message']}}
    First Name : {{$details['first_name']}}
    Last Name : {{$details['last_name']}}
    Email : {{$details['email']}}
    Thanks
    Zodha
@endcomponent
