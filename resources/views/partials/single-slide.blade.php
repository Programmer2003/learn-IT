<div class="single-slid">
    <div class="bg-img lazy" data-src="{{$slider->url}}"></div>
    <div class="slider-overlay"></div>
    <div class="container">
        <div class="hero-text text-center">
            <h1>{!!$slider->caption!!}</h1>
            <h4>{!!$slider->text!!}</h4>
            <div class="hero-btn-wrap">
                <a href="{{route('test')}}" class="t-btn hero-btn">Пройти тест</a>
            </div>
        </div>
    </div>
</div>