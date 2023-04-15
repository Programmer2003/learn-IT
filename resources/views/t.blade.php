@extends('layouts.app')

@push('styles')
@endpush

@section('content')
    <!-- Start Hero Section -->
    <section class="other-hero bg-img" data-src="img/other-hero-bg.jpg">
        <div class="container other-hero-text">
            <h1>Итоговый тест</h1>
            <ul class="breadcrumb">
                <li><a href="index.html">*Topic name*</a></li>
                <li>Тест</li>
            </ul>
        </div>
    </section>
    <!-- End Hero Section -->
    <form action="{{ route('t2') }}" method="GET">
        <div class="container">
            <div class="row">
                @foreach ($test->tasks as $index => $task)
                    @include('user.test-question',compact('task','index'))
                @endforeach
                <div class="d-flex justify-content-center pb-3">
                    <button class="t-btn">Отправить</button>
                </div>
            </div>
            
        </div>
    </form>
@endsection

@push('scripts')
@endpush
