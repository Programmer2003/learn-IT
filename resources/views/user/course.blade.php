@extends('layouts.app')

@push('styles')
    @if (Session::has('info'))
        <link rel="stylesheet" href="{{ asset('lib/toastr/dist/css/toastr.min.css') }}">
    @endif
@endpush

@section('content')
    <section class="other-hero bg-img" data-src="https://en.tums.ac.ir/images/medicine/en/pageBuilder/editor/2021/1631697132-course-after-mba.png">
        <div class="container other-hero-text">
            <h1>Курс</h1>
            <ul class="breadcrumb">
                <li><a href="{{ route('home') }}">Начальная страница</a></li>
                <li>Курс</li>
            </ul>
        </div>
    </section>
    <!-- End Hero Section -->

    <!-- Start Single Service -->
    <section class="single-service single-service-v1 section">
        <div class="container">
            <div class="row">
                <div class="col-md-4 single-service-left">
                    <ul class="nav nav-tabs" id="nav-tabs">
                        @foreach ($topics as $topic)
                            <li class="nav-item">
                                <a class="nav-link @if (Session::has('tab')) {{ Session::get('tab') == $topic->id ? 'active' : '' }} @else {{ $topic->id == Auth::user()->topic ? 'active' : '' }} @endif"
                                    data-toggle="tab" href="#tab{{ $topic->id }}">
                                    {{ $topic->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div><!-- .col -->
                <div class="col-md-8">
                    <div class="tab-content">
                        @foreach ($topics as $topic)
                            <div id="tab{{ $topic->id }}"
                                class="tab-pane fade  @if (Session::has('tab')) {{ Session::get('tab') == $topic->id ? 'active show' : '' }} @else {{ $topic->id == Auth::user()->topic ? 'active show' : '' }} @endif">
                                <div class="single-service-details">
                                    <div class="single-service-thumbnail d-flex justify-content-center">
                                        <img src="{{ $topic->url }}" alt="{{ $topic->name }}">
                                        <a class="t-btn" style="position: absolute; top: 0; right: 0;"
                                            href="{{ route('topic', $topic) }}">Вперед</a>
                                    </div>
                                    <div class="service-details-wrap">
                                        <h2 class="service-entry-title">{{ $topic->name }}</h2>
                                        <div class="service-entry-content">
                                            {!! $topic->full_description !!}
                                        </div>
                                    </div>
                                </div><!-- .single-service-details -->
                            </div><!-- .construction -->
                        @endforeach
                    </div><!-- .tab-content -->
                </div><!-- .col -->
            </div><!-- .row -->
        </div>
    </section>
    <!-- End Single Service -->
@endsection

@push('scripts')
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/vendor/jquery-1.12.4.min.js') }}"></script>
    @if (Session::has('info'))
        <script src="{{ asset('lib/toastr/dist/js/toastr.min.js') }}"></script>
        <script>
            toastr.info("{!! Session::get('info') !!}");
        </script>
    @endif
@endpush
