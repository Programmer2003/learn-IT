@if ($started)
    @if ($task_number < 4)
        <input type="hidden" id="timerDate" value="{{ $timer }}">
        @include('user.topic.task.question-form',compact('task'))
        @include('user.topic.task.additional-question')
        <form id="nextTask" action="{{ route('task.next') }}" style="display: none" method="post" class="mb-3"
            onsubmit="nextTask(event)">
            @csrf
            <button class="t-btn">Дальше</button>
        </form>
    @else
        <div class="service-entry-content">
            <p>
                Отлично, переходите к тесту!
            </p>
        </div>
    @endif
@else
    <form id="startTask" action="{{ route('task.start') }}" method="post" class="mb-3">
        @csrf
        <button class="t-btn">Приступить</button>
    </form>
@endif
