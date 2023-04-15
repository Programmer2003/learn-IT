<div class="single-service-details">
    <div class="service-details-wrap">
        <div class="d-flex justify-content-between">
            <h2 class="service-entry-title">Задание</h2>
            <div id="timer" style="font-size:30px"></div>
        </div>
        <div class="service-entry-content" id="task_text">
            @include('user.topic.test.help.task.question',[
                'task' => $topic->getHelpTask(),
                'topic' => $topic,
            ])
        </div>
    </div>
</div>