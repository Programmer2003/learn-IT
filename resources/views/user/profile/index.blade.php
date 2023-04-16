@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/toastr/dist/css/toastr.min.css') }}">
@endpush

@section('content')
    <div class="container emp-profile">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog"
                        alt="" />
                    {{-- <div class="file btn btn-lg btn-primary" style="z-index: 1;">
                        {{ __('Change Photo') }}
                        <input type="file" name="file" style="cursor: pointer;" />
                    </div> --}}
                </div>
            </div>
            <div class="col-md-6">
                <div class="profile-head">
                    <h5>
                        {{ Auth::user()->name }}
                    </h5>
                    <h6>
                        Web Developer and Designer
                    </h6>
                    <p class="proile-rating">{{ __('Progress') }} : <span> {{ Auth::user()->progress() }} /100%</span>
                    </p>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                aria-controls="home" aria-selected="true">{{ __('About') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                aria-controls="profile" aria-selected="false">{{ __('Timeline') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
            {{-- <div class="col-md-2">
                    <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit Profile" />
                </div> --}}
        </div>
        <div class="row media-reverse">
            <div class="col-md-4">
                <div class="profile-work">
                    <p>Закрепленные темы</p>
                    @include('user.profile.finished')
                </div>
            </div>
            <div class="col-md-8">
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        @include('user.profile.info')
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        @include('user.profile.timeline')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('lib/toastr/dist/js/toastr.min.js') }}"></script>
    @if (Session::has('mode_change'))
        <script>
            toastr.success("{!! Session::get('mode_change') !!}");
        </script>
    @endif
@endpush
