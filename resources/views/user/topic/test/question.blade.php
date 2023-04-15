<main class="col-lg-8 offset-lg-2 site-main">
    <article class="post post-details">
        <header class="entry-header">
            @if ($task->url)
                <div class="post-thumbnail">
                    <img src="{{ $task->url }}" alt="img">
                </div>
            @endif
            <div class="post-details-wrap">
                <h2 class="entry-title">{{ $task->text }}</h2>
            </div>
        </header>
        <div class="entry-content">
            @foreach ($task->choises as $key => $choice)
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="check{{ $index }}_{{ $key }}"
                        value="{{ $key }}" name="answer[{{ $index }}]" required>
                    <label class="form-check-label" for="check{{ $index }}_{{ $key }}">
                        {{ $choice }}
                    </label>
                </div>
            @endforeach
    </article>
</main>
