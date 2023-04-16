<div class="row">
    <div class="col-md-6">
        <label>{{ __('Name') }}</label>
    </div>
    <div class="col-md-6">
        <p>{{ Auth::user()->name }}</p>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <label>{{ __('Email Address') }}</label>
    </div>
    <div class="col-md-6">
        <p>{{ Auth::user()->email }}</p>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <label>{{ __('Profession') }}</label>
    </div>
    <div class="col-md-6">
        <p>Web Developer and Designer</p>
    </div>
</div>