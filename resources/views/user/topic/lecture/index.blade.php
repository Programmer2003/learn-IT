<div class="col-lg-6" style="max-width: 100% ">
    <div class="accordian-wrapper">
        @include('user.topic.slide', [
            'caption' => 'Лекция',
            'text' => $topic->lecture_text,
        ])
        @include('user.topic.slide', [
            'caption' => 'Презентация к лекции (ссылка)',
            'text' => $topic->lecture_link,
            'link' => true,
        ])
        @include('user.topic.slide', [
            'caption' => 'Подключение к конференции (ссылка)',
            'text' => $topic->lecture_meet_link,
            'link' => true,
        ])
    </div>
</div>