<form action="{{route('test.help.check', $topic)}}" method="post" class="mb-3" onsubmit="">
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
        <input class="form-control" type="text" placeholder="" name="answer" required>
    </div>

    <button class="t-btn" id="check_button">Проверить</button>
</form>
