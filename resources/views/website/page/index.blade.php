@extends('website.layouts.master')
@section('content')
    <section id="contact_us">

        <div class="container">
            <h2>{{$page->name}}</h2>

            {!! $page->description !!}
        </div>
    </section>
@endsection
