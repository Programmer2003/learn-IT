@extends('layouts.app')

@push('styles')
@endpush

@section('content')
<section class="other-hero bg-img" data-src="https://toggl.com/blog/wp-content/uploads/2022/06/google-docs-checklist.jpg">
    <div class="container other-hero-text">
      <h1>{{__('Checklist')}}</h1>
      <ul class="breadcrumb">
        <li><a href="{{ route('course') }}">Курс</a></li>
        <li>{{__('Checklist')}}</li>
      </ul>
    </div>
  </section>
  <!-- End Hero Section -->

  <!-- Start site-content -->
  <div class="site-content section">
    <div class="container">
      <div class="row">
        <main class="col-lg-8 offset-lg-2 site-main">
            @include('user.checklist-table')
        </main><!-- .col -->
      </div>
    </div>
  </div>
  <!-- Start site-content -->
@endsection

@push('scripts')
@endpush
