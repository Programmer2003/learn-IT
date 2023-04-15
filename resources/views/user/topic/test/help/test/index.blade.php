<div class="single-service-details">
    <div class="service-details-wrap">

        <div class="service-entry-content" id="task_text">
            <form action="{{ route('test.help.checkTest', $topic) }}" method="get" class="p-3">
                @csrf
                <div class="container">
                    <div class="row">
                        @foreach ($topic->getHelpTestTask() as $index => $task)
                            @include('user.topic.test.question', compact('task', 'index'))
                        @endforeach
                        <div class="d-flex justify-content-center pb-3">
                            <button class="t-btn">Отправить</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
