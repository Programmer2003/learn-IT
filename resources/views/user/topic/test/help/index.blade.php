@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('lib/toastr/dist/css/toastr.min.css') }}">
@endpush

@section('content')
    <!-- Start Hero Section -->
    <section class="other-hero bg-img" data-src="img/other-hero-bg.jpg">
        <div class="container other-hero-text">
            <h1>{{ $topic->name }}</h1>
            <ul class="breadcrumb">
                <li><a href="{{ route('topic', $topic) }}">{{ $topic->name }}</a></li>
                <li>Подготовка</li>
            </ul>
        </div>
    </section>
    <!-- End Hero Section -->

    <!-- Start Single Service -->
    <section class="single-service section">
        <div class="container">
            <ul class="nav nav-tabs" id="nav-tabs">
                <li class="nav-item"><a class="nav-link  {{ Session::has('success') ? '' : 'active' }}" data-toggle="tab"
                        href="#lecture">Лекция</a></li>
                <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#task">Задания</a></li>
                @if (Session::has('success'))
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#test">Тест</a></li>
                @endif
            </ul>
            <div class="tab-content">
                <div id="lecture" class="tab-pane fade {{ Session::has('success') ? '' : 'show active' }}"><br>
                    @include('user.topic.test.help.lecture.index',compact('topic'))
                </div>
                <div id="task" class="tab-pane fade "><br>
                    @include('user.topic.test.help.task.index',compact('topic'))
                </div>
                @if (Session::has('success'))
                    <div id="test" class="tab-pane fade show active"><br>
                        @include('user.topic.test.help.test.index',compact('topic'))
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!-- End Single Service -->
@endsection

@push('scripts')
@endpush

@push('scripts')
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('lib/toastr/dist/js/toastr.min.js') }}"></script>
    @if (Session::has('success'))
        <script>
            toastr.success("{!! Session::get('success') !!}");
        </script>
    @endif
    @if (Session::has('error'))
        <script>
            toastr.error("{!! Session::get('error') !!}");
        </script>
    @endif
@endpush
