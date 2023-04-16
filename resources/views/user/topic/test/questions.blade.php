@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('lib/toastr/dist/css/toastr.min.css') }}">
@endpush

@section('content')
    <!-- Start Hero Section -->
    <section class="other-hero bg-img" data-src="https://www.testim.io/wp-content/uploads/2019/11/Testim-What-is-a-Test-Environment_-A-Guide-to-Managing-Your-Testing-A.png">
        <div class="container other-hero-text">
            <h1>Итоговый тест</h1>
            <ul class="breadcrumb">
                <li><a href="{{ route('topic', $topic) }}">{{ $topic->name }}</a></li>
                <li>Тест</li>
            </ul>
            <input type="hidden" id="timerDate" value="{{ $timer }}">
        </div>
    </section>
    <!-- End Hero Section -->
    @if ($status < -1)
        @include('user.topic.test.next-topic')
    @else
        <form action="{{ route('test.check', $topic) }}" method="POST" class="p-3">
            @csrf
            <div class="container">
                <div class="d-flex justify-content-around align-items-center p-3 ">
                    @if ($status == -1)
                        @include('user.topic.test.next-topic')
                    @endif
                    <div id="timer" style="font-size:30px"></div>
                </div>
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
    <script src="{{ asset('js/timer.js') }}"></script>
    <script>
        let countdownfunction;
        timer();
    </script>
@endpush
