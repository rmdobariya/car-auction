@extends('website.layouts.master')
@section('title')
    {{$page->name}}
@endsection
@section('content')
    <section id="contact_us">

        <div class="container">
            <h2>{{$page->name}}</h2>

            {!! $page->description !!}
        </div>
    </section>
@endsection
