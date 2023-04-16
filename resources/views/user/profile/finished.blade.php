<?php 
use App\Models\User;
$user = User::find(Auth::id());
?>

@if ($user->finishedTopics()->count())
    @foreach ($user->finishedTopics() as $topic)
        <a href="{{ route('topic', $topic) }}"> {{ $topic->name }}</a><br />
    @endforeach
@else
    <a class="" href="{{ route('course') }}">Начните учить!</a>
@endif
