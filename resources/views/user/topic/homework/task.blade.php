@if ($uploaded)
    <div class="mb-3 d-flex align-items-center flex-column ">
        <label class="form-label">Вы отправили файл</label>
        <h4 class="form-label">1.sql</h4>
        @if (auth()->user()->homeworkMark($topic->id))
            {
            <h2>Оценка: {{ auth()->user()->homeworkMark($topic->id) }}</h2>
            }
        @else
            <h2>Работа не проверена</h2>
        @endif
    </div>
@else
    <form enctype="multipart/form-data" id="sendHomework" action="{{ route('homework') }}" method="post" class="mb-3">
        @csrf
        <label for="formFile" class="form-label">Прикрепите файл сюда</label>
        <input type="hidden" name="MAX_FILE_SIZE" value="4194304" />
        <input type="hidden" name="topic" value="{{ $topic->id }}" />
        <input class="form-control" type="file" id="formFile" name="file" required>
        <button class="t-btn">Отправить</button>
    </form>
@endif
