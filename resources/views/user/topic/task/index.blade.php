<div class="single-service-details">
    <div class="service-details-wrap">
        <div class="d-flex justify-content-between">
            <h2 class="service-entry-title">Самостоятельное Задание</h2>
            <div id="timer" style="font-size:30px"></div>
        </div>
        <div class="service-entry-content" id="task_text">
            @include('user.topic.task.question', [
                'started' => $progress->task_end_at ? true : false,
                'task_number' => $progress->task_number,
                'task' => $progress->topic->getTask($progress->task_number),
                'timer' => $progress->getTimer() ?? -1,
            ])
        </div>
    </div>
</div>