<div class="col-lg-4 text-center">
    <div class="singel-service style1">
        <div class="single-feature-icon2" style="overflow: hidden">
            <img src="{{ $topic->url }}" alt="{{ $topic->name }}">
        </div>
        <h3 class="service-header"><a href="{{route('test')}}">{{ $index + 1 }}. {{ $topic->name }}</a></h3>
        <div class="service-details">{{ $topic->description }}</div>
    </div>
</div><!-- .col -->
