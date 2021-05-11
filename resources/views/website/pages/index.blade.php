@extends('staticpage.layouts.app')
@section('title')
    {{$page->translate($lang)->title}}
@endsection
@section('content')
    <section id="section-1-1" class="hero hero-bg-1 layout-2">
        <div class="container">
            <div class="outer clearfix z-1 relative">
                <h2 class="b20-1 text-center">
                    <span class="strong">
                        {{$page->translate($lang)->title}}
                    </span>

                </h2>
                <br>
                <main>
                    {!! $page->translate($lang)->content !!}
                </main>
            </div>
        </div>
        <div class="overlay-light"></div>
    </section>
@endsection
