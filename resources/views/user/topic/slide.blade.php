<div class="single-accordian">
    <h3 class="accordian-head">
        {{ $caption }}
        <span class="accordian-toggle"></span>
    </h3>
    <div class="accordian-body">
        @if ($link ?? false)
            <a href="{{ $text }}">{{ $text }}</a>
        @else
            {{ $text }}
        @endif
    </div>
</div>
