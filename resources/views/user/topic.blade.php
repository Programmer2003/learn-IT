@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('lib/toastr/dist/css/toastr.min.css') }}">
@endpush

@section('content')
    <!-- Start Hero Section -->
    <section class="other-hero bg-img" data-src="img/other-hero-bg.jpg">
        <div class="container other-hero-text">
            <h1>{{ $topic->name }}</h1>
            <ul class="breadcrumb">
                <li><a href="{{ route('course') }}">Курс</a></li>
                <li>{{ $topic->name }}</li>
            </ul>
        </div>
    </section>
    <!-- End Hero Section -->

    <!-- Start Single Service -->
    <section class="single-service section">
        <div class="container">
            <ul class="nav nav-tabs" id="nav-tabs">
                <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#lecture">Лекция</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#task">Задания</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#homework">ДЗ</a></li>
                <li class="nav-item"><a id="test-tab" data-toggle="tab" href="#test"
                        class="nav-link {{ $progress->task_number ?? 0 > 3 ? '' : 'disabled' }}">Тест</a>
                </li>
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#check-list">Чеклист</a></li>
            </ul>
            <div class="tab-content">
                <div id="lecture" class="tab-pane fade "><br>
                    <div class="col-lg-6" style="max-width: 100% ">
                        <div class="accordian-wrapper">
                            @include('user.lecture-slide', [
                                'caption' => 'Лекция',
                                'text' => $topic->lecture_text,
                            ])
                            @include('user.lecture-slide', [
                                'caption' => 'Презентация к лекции (ссылка)',
                                'text' => $topic->lecture_link,
                                'link' => true,
                            ])
                            @include('user.lecture-slide', [
                                'caption' => 'Подключение к конференции (ссылка)',
                                'text' => $topic->lecture_meet_link,
                                'link' => true,
                            ])
                        </div>
                    </div><!-- .col -->
                </div>
                <div id="task" class="tab-pane fade"><br>
                    <div class="single-service-details">

                        <div class="service-details-wrap">
                            <div class="d-flex justify-content-between">
                                <h2 class="service-entry-title">Самостоятельное Задание</h2>
                                <div id="timer" style="font-size:30px"></div>
                            </div>
                            <div class="service-entry-content" id="task_text">
                                @include('user.task', [
                                    'started' => $progress->task_end_at ? true : false,
                                    'task_number' => $progress->task_number,
                                    'task' => $progress->topic->getTask($progress->task_number),
                                    'timer' => $progress->getTimer() ?? -1,
                                ])
                            </div>
                        </div>

                    </div><!-- .single-service-details -->

                </div>
                <div id="homework" class="tab-pane fade "><br>
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
                    </div><!-- .single-service-details -->
                    @include('user.homework', [
                        'uploaded' => auth()->user()->fileUploaded($topic->id),
                    ])
                </div>
                <div id="test" class="tab-pane fade "><br>
                    <div class="single-service-details">
                        <div class="single-service-thumbnail"><img src="img/service/single-service/04.jpg" alt="Image">
                        </div>
                        <div class="service-details-wrap">
                            <h2 class="service-entry-title">Title Of Painting Service</h2>
                            <div class="service-entry-content">
                                <p>As am hastily invited settled at limited civilly fortune me. Really spring in extent an
                                    by. Judge but built gay party world. Of so am he remember although required.</p>
                                <p>Do am he horrible distance marriage so although. Afraid assure square so happen mr an
                                    before. His many same been well can high that. Forfeited did law eagerness allowance
                                    improving assurance bed.</p>
                                <p>Had saw put seven joy short first. Pronounce so enjoyment my resembled in forfeited
                                    sportsman. Which vexed did began son abode short may. Interested astonished he at
                                    cultivated or me. Nor brought one invited she produce her. </p>
                            </div>
                        </div>
                    </div><!-- .single-service-details -->
                </div>
                <div id="check-list" class="tab-pane fade  show active"><br>
                    @include('user.checklist')
                </div>



            </div><!-- .tab-content -->
        </div>
    </section>
    <!-- End Single Service -->
@endsection

@push('scripts')
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script>
        function nextTask(e) {
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: '{{ route('task.next') }}',
                data: $(e.target).serialize(),
                dataType: "html",
                success: function(res) {
                    if (res == '-1') {
                        document.getElementById('test-tab').classList.remove("disabled");
                        document.getElementById('task_text').innerHTML = 'Отлично, переходите к тесту!';
                    } else {
                        document.getElementById('task_text').innerHTML = res;
                    }

                },
                error: function(data) {
                    console.log('error');
                }
            });
        }

        function checkTask(e) {
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: '{{ route('task.check') }}',
                data: $(e.target).serialize(),
                dataType: "html",
                success: function(res) {
                    let result = JSON.parse(res);
                    switch (result['case']) {
                        case '-1':
                        case -1:
                            toastr.success('Правильно');
                            $('#check_button').hide();
                            $('#nextTask').show();
                            break;
                        case 0:
                        case '0':
                            console.log('Ничего')
                            toastr.error('Неверно');
                            break;
                        case 1:
                        case '1':
                            console.log('+баллы, открыть доп. задание')
                            toastr.success('Правильно, открыто доп. задание!');
                            $('#moreText').text(result['task']['text']);
                            $('#moreImage').attr("src", result['task']['url']);
                            $('#check_button').hide();
                            $('#nextTask').show();
                            $('#additionalTask').show();
                            break;
                        case 2:
                        case '2':
                            console.log('+баллы, без доп.')
                            toastr.success('Правильно!');
                            $('#check_button').hide();
                            $('#nextTask').show();
                            break;
                        case 3:
                        case '3':
                            console.log('+немного баллов')
                            toastr.success('Правильно!');
                            $('#check_button').hide();
                            $('#nextTask').show();
                            break;
                        case 4:
                        case '4':
                            console.log('0 баллов')
                            $('#check_button').hide();
                            $('#nextTask').show();
                            toastr.success('Правильно');
                            break;
                        case 5:
                        case '5':
                            console.log('открыть помощь, текст')
                            toastr.error('Неправильно');
                            console.log($('#helpText'));
                            $('#helpText').text(result['text']);
                            break;
                        case 6:
                        case '6':
                            console.log('открыть помощь, изображение')
                            console.log($('#helpImage'));
                            toastr.error('Неправильно');
                            $('#helpImage').attr("src", result['url']);
                            break;
                        case 7:
                        case '7':
                            console.log('0 баллов, Показать ответ')
                            console.log($('#answer'));
                            toastr.error('Можно было лучше');
                            $('#answer').text(result['answer']);
                            break;

                        default:
                            console.log('Не по плану')
                            break;
                    }
                },
                error: function(data) {
                    console.log('error');
                }
            });
        }

        function checkAdditionalTask(e) {
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: '{{ route('task.additional') }}',
                data: $(e.target).serialize(),
                dataType: "html",
                success: function(res) {
                    if (res) {
                        toastr.success('Правильно!');
                    } else {
                        toastr.error('Неверно');
                    }
                },
                error: function(data) {
                    console.log('error');
                }
            });
        }

        $(function() {
            $('#startTask').on('submit', function(e) {
                e.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ route('task.start') }}',
                    data: $(this).serialize(),
                    dataType: "html",
                    success: function(res) {
                        document.getElementById('task_text').innerHTML = res;
                    },
                    error: function(data) {
                        console.log('error');
                    }
                });
            })
        })
    </script>
    <script src="{{ asset('lib/toastr/dist/js/toastr.min.js') }}"></script>
    @if (Session::has('success'))
        <script>
            toastr.success("{!! Session::get('success') !!}");
        </script>
    @endif
    <script>
        // Set the date we're counting down to
        var countDownDate = new Date();
        var seconds = parseInt($('#timerDate').text() || -1);
        if (seconds == -1) {
            document.getElementById("timer").style.display = 'none';
        }
        countDownDate = countDownDate.setSeconds(countDownDate.getSeconds() + seconds);

        // Update the count down every 1 second
        var countdownfunction = setInterval(function() {
            var now = new Date().getTime();
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            document.getElementById("timer").innerHTML = minutes + "m " + seconds + "s ";

            // If the count down is over, write some text 
            if (distance < 0) {
                clearInterval(countdownfunction);
                document.getElementById("timer").innerHTML = "0m 0s";
                document.getElementById("timer").style.color = 'red';
            }
        }, 1000);
    </script>
@endpush
