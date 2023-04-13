@if ($started)
    @if ($task_number < 4)
        <div class="d-none" id="timerDate">{{ $timer }}</div>
        <form id="checkTask" action="{{ route('task.check') }}" method="post" class="mb-3" onsubmit="checkTask(event)">
            @csrf
            <div class="service-entry-content">
                <p>
                    {{ $task->text }}
                </p>
                @if ($task->url)
                    <div class="single-service-thumbnail">
                        <img src="{{ $task->url }}" alt="img">
                    </div>
                @endif
            </div>
            <div class="service-entry-content">
                @switch($task->type)
                    @case(0)
                        @foreach ($task->choises as $key => $choice)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="check{{ $key }}"
                                    value="{{ $key }}" name="answer" required>
                                <label class="form-check-label" for="check{{ $key }}">
                                    {{ $choice }}
                                </label>
                            </div>
                        @endforeach
                    @break

                    @case(1)
                        <input class="form-control" type="text" placeholder="" name="answer" required>
                    @break

                    @default
                @endswitch
            </div>
            <div>
                <p id="answer"></p>
            </div>
            <div id="helpText"></div>
            <div>
                <img src="" id="helpImage" alt="">
            </div>


            <button class="t-btn" id="check_button">Проверить</button>

        </form>
        <form id="additionalTask" action="{{ route('task.additional') }}" style="display: none" method="post"
            class="mb-3" onsubmit="checkAdditionalTask(event)">
            @csrf
            <div class="service-entry-content">
                <p id="moreText"></p>
                <div class="single-service-thumbnail">
                    <img src="" id="moreImage" alt="img">
                </div>
            </div>
            <input class="form-control" type="text" placeholder="" name="answerMore" required>

            <button class="t-btn">Проверить</button>
        </form>
        <form id="nextTask" action="{{ route('task.next') }}" style="display: none" method="post" class="mb-3"
            onsubmit="nextTask(event)">
            @csrf
            <button class="t-btn">Дальше</button>
        </form>
    @else
        @if ($task_number > 3)
            <div class="service-entry-content">
                <p>
                    Отлично, переходите к тесту!
                </p>
            </div>
        @endif
    @endif
@else
    <form id="startTask" action="{{ route('task.start') }}" method="post" class="mb-3">
        @csrf
        <button class="t-btn">Приступить</button>
    </form>
@endif
