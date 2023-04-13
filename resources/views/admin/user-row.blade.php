<tr>
    <th scope="row">{{ $user->email }}</th>
    <td>{{ $user->name }}</td>
    <td>{{ $user->topic }}</td>
    <td>
        <form action="{{ route('table.user') }}" class="form-row" method="POST">
            @csrf
            <input type="hidden" name="user" value="{{ $user->id }}">
            <input type="hidden" name="topic" value="{{ $topic->id }}" class="topic-id">
        </form>
        <select class="form-select select-topic" onchange="ChooseTopic(event)">
            @for ($i = 1; $i <= $user->topic; $i++)
                <option value="{{ $i }}" {{ $topic->id == $i ? 'selected' : '' }}>
                    Тема {{ $i }}
                </option>
            @endfor
        </select>
    </td>
    <td>
        <form action="{{ route('homework.download') }}" method="POST" class="download-form" onsubmit="uploadFile(event)">
            @csrf
            <input type="hidden" name="user" value="{{ $user->email }}">
            <input type="hidden" name="topic" value="{{ $topic->id }}">
            <button class="t-btn hero-btn">
                Тема {{ $topic->id }}
            </button>
        </form>
    </td>
    <td>
        <form action="{{ route('homework.update') }}" method="POST" onsubmit="rate(event)">
            @csrf
            <input type="hidden" name="user" value="{{ $user->id }}">
            <input type="hidden" name="topic" value="{{ $topic->id }}">
            <div class="input-group input-group-sm mb-3">
                <button class="btn btn-outline-secondary">✔</button>
                <input type="text" class="form-control homework-mark" placeholder="" name="mark"
                    value="{{ $user->homeworkMark($topic->id) }}">
            </div>
        </form>
    </td>
</tr>
