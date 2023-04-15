<div class="col-lg-6" style="max-width: 100% ">
    <div class="accordian-wrapper">
        @include('user.topic.slide', [
            'caption' => 'Теоретический материал',
            'text' => $topic->test_help,
        ])
    </div>
</div>