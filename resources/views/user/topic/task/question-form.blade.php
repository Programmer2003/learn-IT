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
                        <input class="form-check-input" type="radio" id="check{{ $key }}" value="{{ $key }}"
                            name="answer" required>
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
