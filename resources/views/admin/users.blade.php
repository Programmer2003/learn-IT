@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('lib/toastr/dist/css/toastr.min.css') }}">
@endpush

@section('content')
    <div class="container p-3">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Почта</th>
                    <th scope="col">Username</th>
                    <th scope="col">Тема</th>
                    <th scope="col">Выбор Темы</th>
                    <th scope="col">Домашнее Задание</th>
                    <th scope="col" style="width: 10%">Оценка</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    @include('admin.user-row', compact('user', 'topic'))
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('lib/toastr/dist/js/toastr.min.js') }}"></script>
    @if (Session::has('error'))
        <script>
            toastr.error("{!! Session::get('error') !!}");
        </script>
    @endif
    <script>
        function ChooseTopic(e) {
            var select = e.target;
            var tr = $(select).closest('tr')[0];
            var topic = $(tr).find('.topic-id')[0];
            var form = $(tr).find('.form-row')[0];
            topic.value = select.selectedOptions[0].value;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: '{{ route('table.user') }}',
                data: $(form).serialize(),
                dataType: "html",
                success: function(res) {
                    tr.outerHTML = res;
                },
                error: function(data) {
                    console.log('error during execution');
                }
            });

        }

        function uploadFile(e) {
            var form = e.target;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: '{{ route('homework.uploaded') }}',
                data: $(form).serialize(),
                dataType: "html",
                async: false,
                success: function(res) {

                    if (!res) {
                        e.preventDefault();
                        toastr.info('Задание не сдано');
                    }
                },
                error: function(data) {
                    console.log('error during execution');
                }
            });
        }

        function rate(e) {
            e.preventDefault();
            var form = e.target;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: '{{ route('homework.update') }}',
                data: $(form).serialize(),
                dataType: "html",
                success: function(res) {
                    console.log(res);
                    toastr.success('Отметка поставлена');
                },
                error: function(data) {
                    console.log('error during execution');
                }
            });
        }
    </script>


@endpush
