@component('mail::message')
    # Hello {{ $details['name'] }},
    Full Name : {{$details['full_name']}}
    Address : {{$details['address']}}
    Contact Number : {{$details['contact_number']}}
    Message : {{$details['message']}}
    Thanks
@endcomponent
