@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('lib/toastr/dist/css/toastr.min.css') }}">
@endpush

@section('content')
    <!-- Start Hero Section -->
    <section class="other-hero bg-img" data-src="img/other-hero-bg.jpg">
        <div class="container other-hero-text">
            <h1>Итоговый тест</h1>
            <ul class="breadcrumb">
                <li><a href="{{ route('topic', $topic) }}">{{ $topic->name }}</a></li>
                <li>Тест</li>
            </ul>
        </div>
    </section>
    <!-- End Hero Section -->
    @if ($status < -1)
        @include('user.topic.test.next-topic')
    @else
        @if ($status == -1)
            @include('user.topic.test.next-topic')
        @endif
        <form action="{{ route('test.check', $topic) }}" method="POST" class="p-3">
            @csrf
            <div class="container">
                <div class="row">
                    @foreach ($test->tasks as $index => $task)
                        @include('user.topic.test.question', compact('task', 'index'))
                    @endforeach
                    <div class="d-flex justify-content-center pb-3">
                        <button class="t-btn">Отправить</button>
                    </div>
                </div>

            </div>
        </form>
    @endif

@endsection

@push('scripts')
    <script src="{{ asset('lib/toastr/dist/js/toastr.min.js') }}"></script>
    @if (Session::has('last'))
        <script>
            toastr.info("{!! Session::get('last') !!}");
        </script>
    @endif
    @if (Session::has('info'))
        <script>
            toastr.info("{!! Session::get('info') !!}");
        </script>
    @endif
    @if (Session::has('fail'))
        <script>
            toastr.error("{!! Session::get('fail') !!}");
        </script>
    @endif
@endpush
