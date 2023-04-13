@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('lib/toastr/dist/css/toastr.min.css') }}">
@endpush

@section('content')
    <!-- Start Hero Section -->
    <section class="other-hero bg-img"  data-src="https://hslda.org/images/librariesprovider2/images/lp/testing-and-evaluation-istock-495639272-compressor.jpg?sfvrsn=d82ef5d1_2">
        <div class="container other-hero-text">
            <h1>Вводное тестирование</h1>
            <ul class="breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Тест</li>
            </ul>
        </div>
    </section>
    <!-- End Hero Section -->

    <!-- Start Test Section -->
    <div class="site-content section">
        <form action="{{ route('test.score') }}" method="POST" id="test-form"
            class="container d-flex align-items-center justify-content-center flex-column">
            @csrf
            <div class="form-group d-flex align-items-center justify-content-center flex-column">
                <h4>Укажите ваш возраст</h4>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="age" id="ageRadio" value="0">
                    <label class="form-check-label" for="ageRadio">
                        5-7 класс(10-14 лет)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="age" id="ageRadio2" value="1" required>
                    <label class="form-check-label" for="ageRadio2">
                        8-9 класс (14-16 лет)
                    </label>
                </div>
            </div>
            <div class="form-group d-flex align-items-center justify-content-center flex-column">
                <h4 style="text-align: center">Занимались ли вы ранее программированием?</h4>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="exp" id="expRadio" value="1">
                    <label class="form-check-label" for="expRadio">
                        Да
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="exp" id="expRadio2" value="0" required>
                    <label class="form-check-label" for="expRadio2">
                        Нет
                    </label>
                </div>
            </div>

            <!-- Button trigger modal -->
            <button type="submit" class="t-btn hero-btn" data-bs-toggle="modal" data-bs-target="#codePopup">
                Отправить
            </button>

            <!-- Modal -->
            <div class="modal fade" id="codePopup" tabindex="-1" aria-labelledby="codePopupLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="codePopupLabel">Результаты теста</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body d-flex align-items-center justify-content-center flex-column">
                            Запомните или скопируйте код
                            <h4 id="code" style="cursor: pointer"></h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="t-btn hero-btn" data-bs-dismiss="modal">Закрыть</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- End Test Section -->
@endsection

@push('scripts')
    <script src="{{ asset('lib/toastr/dist/js/toastr.min.js') }}"></script>

    <script>
        $(function() {
            $('#test-form').on('submit', function(e) {
                e.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ route('test.score') }}',
                    data: $(this).serialize(),
                    dataType: "html",
                    success: function(res) {
                        $('#code').text(res);
                    },
                    error: function(data) {
                        toastr.error('Ошибка во время обработки запроса');
                    }
                });
            })
        })
    </script>

    <script>
        $('#code').on('click', function() {
            navigator.clipboard.writeText($(this).text());
            toastr.success('Текст скопирован');
        })
    </script>
@endpush
