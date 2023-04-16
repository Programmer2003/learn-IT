<div class="row">
    <div class="col-md-6">
        <label>{{ __('Registration Date') }}</label>
    </div>
    <div class="col-md-6">
        <p>{{ Auth::user()->registrationDate() }}</p>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <label>{{ __('Time Left') }}</label>
    </div>
    <div class="col-md-6">
        <p>{{ Auth::user()->timeLeft() }}</p>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <label>{{ __('Mode') }}</label>
    </div>
    <div class="col-md-6">
        <div class="d-flex">
            <p>{{ Auth::user()->mode() }}</p>
            @mode_change
                <form action="{{ route('mode') }}" method="POST">
                    @csrf
                    <button class="btn btn-link" style="padding: 0; margin-top: -5px; padding-left: 5px"><i class="fa fa-rotate-left"></i></button>
                </form>
            @endmode_change
        </div>
    </div>
</div>