<div class="single-service-details">

    <div class="service-details-wrap">
        <h2 class="service-entry-title">Домашнее Задание</h2>
        <div class="service-entry-content">
            <p>
                {{ $topic->homework }}
            </p>
        </div>
    </div>
    @if ($topic->homework_img)
        <div class="single-service-thumbnail">
            <img src="{{ $topic->homework_img }}" alt="{{ $topic->homework_img }}">
        </div>
    @endif
</div>
@include('user.topic.homework.task', [
    'uploaded' => auth()->user()->fileUploaded($topic->id),
])