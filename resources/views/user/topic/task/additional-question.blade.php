<form id="additionalTask" action="{{ route('task.additional') }}" style="display: none" method="post" class="mb-3"
    onsubmit="checkAdditionalTask(event)">
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
