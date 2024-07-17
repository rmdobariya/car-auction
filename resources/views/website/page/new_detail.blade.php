@extends('website.layouts.master')
@section('title')
    {{$new->title}}
@endsection
@section('content')
    <section id="contact_us">

        <div class="container">
            <div class="date">
                <span>{{Carbon\Carbon::parse($new->created_at)->format('M d ,Y')}}</span>
            </div>
            <h2>{{$new->title}}</h2>

            {!! $new->description !!}
        </div>
    </section>
@endsection
