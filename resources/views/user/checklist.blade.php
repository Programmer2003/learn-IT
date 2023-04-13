<div class="container">
    <div class="row">
        <div class="col-12">
            <table class="table table-bordered" style="font-size: 20px;">
                <thead>
                    @include('user.checklist.header', ['caption' => 'Вводная часть курса'])
                </thead>
                <tbody>
                    @include('user.checklist.row', [
                        'caption' => 'Заготовка для будущего сайта',
                        'topic' => 1,
                    ])
                    @include('user.checklist.header ', ['caption' => 'Верхняя часть сайта'])
                    @include('user.checklist.row', [
                        'caption' => 'Логотип',
                        'topic' => 2,
                    ])
                    @include('user.checklist.row', [
                        'caption' => 'Меню',
                        'topic' => 2,
                    ])
                    @include('user.checklist.header ', ['caption' => 'Основная часть сайта'])
                    @include('user.checklist.subtitle ', ['caption' => 'Раздел "Вступление"'])
                    @include('user.checklist.row', [
                        'caption' => 'Блок с картинкой	
                    ',
                        'topic' => 3,
                    ])
                    @include('user.checklist.row', [
                        'caption' => 'Блок с текстом',
                        'topic' => 3,
                    ])
                    @include('user.checklist.row', [
                        'caption' => 'Кнопка',
                        'topic' => 8,
                    ])
                    @include('user.checklist.subtitle ', ['caption' => 'Раздел "Обо мне"'])
                    @include('user.checklist.row', [
                        'caption' => 'Заголовок',
                        'topic' => 3,
                    ])
                    @include('user.checklist.row', [
                        'caption' => 'Текст',
                        'topic' => 3,
                    ])
                    @include('user.checklist.subtitle ', ['caption' => 'Раздел "Мои навыки"'])
                    @include('user.checklist.row', [
                        'caption' => 'Блок с псевдоэлементами',
                        'topic' => 4,
                    ])
                    @include('user.checklist.row', [
                        'caption' => 'Блок с фотографиейs',
                        'topic' => 4,
                    ])
                    @include('user.checklist.subtitle ', ['caption' => 'Раздел "Как я работаю"'])
                    @include('user.checklist.row', [
                        'caption' => 'Заголовок',
                        'topic' => 5,
                    ])
                    @include('user.checklist.row', [
                        'caption' => 'Текст',
                        'topic' => 5,
                    ])
                    @include('user.checklist.row', [
                        'caption' => 'Блок с видео',
                        'topic' => 5,
                    ])
                    @include('user.checklist.subtitle ', ['caption' => 'Раздел "Галерея"'])
                    @include('user.checklist.row', [
                        'caption' => 'Галерея',
                        'topic' => 7,
                    ])
                    @include('user.checklist.row', [
                        'caption' => 'Использование jQuery',
                        'topic' => 7,
                    ])
                    @include('user.checklist.row', [
                        'caption' => 'Использование плагина',
                        'topic' => 7,
                    ])
                    @include('user.checklist.subtitle ', ['caption' => ' Раздел "Форма"'])

                    @include('user.checklist.row', [
                        'caption' => 'Поле для ввода имени',
                        'topic' => 6,
                    ])
                    @include('user.checklist.row', [
                        'caption' => 'Поле для ввода электронной почты',
                        'topic' => 6,
                    ])
                    @include('user.checklist.row', [
                        'caption' => 'Поле для ввода сообщения',
                        'topic' => 6,
                    ])
                    @include('user.checklist.row', [
                        'caption' => 'Кнопка отправки',
                        'topic' => 6,
                    ])
                    @include('user.checklist.row', [
                        'caption' => 'Всплывающая форма',
                        'topic' => 9,
                    ])
                    @include('user.checklist.row', [
                        'caption' => 'Анимация всплывающей формы',
                        'topic' => 10,
                    ])
                    @include('user.checklist.header ', ['caption' => 'Нижняя часть сайта'])
                    @include('user.checklist.row', [
                        'caption' => 'Блок с именем и фамилией',
                        'topic' => 11,
                    ])
                    @include('user.checklist.row', [
                        'caption' => 'Блок с иконками социальных сетей',
                        'topic' => 11,
                    ])
                </tbody>
            </table>
        </div>
    </div>
</div>
