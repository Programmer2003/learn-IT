@extends('layouts.app')

@push('styles')
@endpush

@section('content')
    <!-- Start Hero Section -->
    <div id="home">
        <section class="owl-carousel hero-slider hero-slider-v2" id="hero-slider-v2">
            @foreach ($carousel as $slider)
                @include('partials.single-slide', compact('slider'))
            @endforeach
        </section>
    </div>
    <!-- End Hero Section -->

    <!-- Start Course Section -->
    <section class="service section gray-bg service-v1" id="services">
        <div class="container">
            <div class="section-header type1">
                <h2>Программа курса</h2>
                <div class="section-divider"><span></span></div>
                <div class="sub-heading">*Описание программы круса здесь*</div>
            </div>
            <div class="row flex">
                @foreach ($topics as $index => $topic)
                    @include('partials.topic-card', compact('index', 'topic'))
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Course Section -->

    <!-- Start CTA section -->
    <section class="cta">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-lg-8">
                    <h2 class="cta-quote">Хей! Интересно? Присоединяйтесь!</h2>
                </div><!-- .col -->
                <div class="col-md-5 col-lg-4 text-right">
                    <a href="{{route('test')}}" class="t-btn cta-btn">Пройти тест</a>
                </div><!-- .col -->
            </div>
        </div>
    </section>
    <!-- End CTA section -->
@endsection

@push('scripts')
@endpush
