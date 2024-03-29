<?php

namespace Database\Seeders;

use App\Models\Carousel;
use App\Models\Progress;
use App\Models\Topic;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $carousel =
            [
                [
                    'caption' => 'Научим программировать и поможем стать ITшником',
                    'url' => 'https://adukar.com/images/photo/kak-vybrat-horoshie-it-kursy-s-nulya-3.jpg',
                    'text' => 'LearnIT - это школа программирования, где мы научим тебя востребованным сегодня знаниям. Все наши программы составлены Senior и Lead разработчиками ведущих IT компаний специально для новичков в IT.',
                ],
                [
                    'caption' => 'Learn IT',
                    'url' => 'https://www.computersciencedegreehub.com/wp-content/uploads/2023/01/shutterstock_1062915392-scaled.jpg',
                    'text' => 'Ваш входной билет в IT-индустрию',
                ],
                [
                    'caption' => 'Начни изучать программирование',
                    'url' => 'https://gogotraining.com/blog/wp-content/uploads/2016/11/Online-IT-Course.jpg',
                    'text' => 'Стань профессионалом в IT',
                ],
            ];
        foreach ($carousel as $slider) {
            Carousel::create($slider);
        }

        $task = [
            '0' => [
                'url' => 'https://assets.entrepreneur.com/content/3x2/2000/20150312184504-cool-awesome.jpeg',
                'text' => 'Задание 1, легкий уровень',
                'type' => '0', //Выбор из предложенных
            ],
            '1' => [
                'url' => 'https://img.freepik.com/free-photo/cool-geometric-triangular-figure-neon-laser-light-great-backgrounds-wallpapers_181624-9331.jpg?w=2000',
                'text' => 'Задание 1, сложный уровень',
                'type' => '1', //Ввод строки
            ]
        ];

        $tasks[] = $task;
        $task = [
            '0' => [
                'url' => 'https://s.wsj.net/public/resources/images/OG-BS302_201809_M_20180904103731.gif',
                'text' => 'easy2',
                'type' => '0',
            ],
            '1' => [
                'url' => 'https://img.freepik.com/free-photo/cool-geometric-triangular-figure-neon-laser-light-great-backgrounds-wallpapers_181624-9331.jpg?w=2000',
                'text' => 'hard',
                'type' => '1',
            ]
        ];
        $tasks[] = $task;
        $task = [
            '0' => [
                'url' => 'https://wallpapers.com/images/hd/cool-cat-with-sunglasses-b9c8pwh004vdkozm.jpg',
                'text' => 'easy3',
                'type' => '0',
            ],
            '1' => [
                'url' => 'https://img.freepik.com/free-photo/cool-geometric-triangular-figure-neon-laser-light-great-backgrounds-wallpapers_181624-9331.jpg?w=2000',
                'text' => 'hard',
                'type' => '1',
            ]
        ];
        $tasks[] = $task;


        $answer = [
            '0' => [
                'choises' => [ //Так как у первого задания на легком уровне 0 тип, то здесь массив из вариантов.
                    '<head>,<header>,</main>,<html>',
                    '<tail>,<header>,</main>,<html>',
                    '<head>,</header>,<main>,<end>',
                    '<head>,<main>,</header>,<end>',
                ],
                'help' => [
                    'text' => 'Текстовая подсказка легкого уровня',
                    'url' => '*Ссылка на изображение подсказки*',
                    'answer' => 'Ответ 2',
                ],
                'data' => '1' // индекс ответа массива (Ответ => choises[1] = '<tail>,<header>,</main>,<html>' )
            ],
            '1' => [
                //Так как у первого задания на сложном уровне 1 тип, то варианты ответа не нужны.
                'help' => [
                    'text' => 'Текстовая подсказка сложного уровня',
                    'url' => 'img/1.png',
                    'answer' => 'Ответ 2',
                ],
                'data' => 'head', //Ответ 'head'
            ]
        ];

        $answers[] = $answer;
        $answer = [
            '0' => [
                'choises' => [
                    '<head>,<header>,</main>,<html>',
                    '<tail>,<header>,</main>,<html>',
                    '<head>,</header>,<main>,<end>',
                    '<head>,<main>,</header>,<end>',
                ],
                'help' => [
                    'text' => 'Это будет 2 или 3',
                    'url' => 'img/1.png',
                    'answer' => 'Ответ 2',
                ],
                'data' => '1'
            ],
            '1' => [
                'help' => [
                    'text' => 'Это будет 2 или 3',
                    'url' => 'img/1.png',
                    'answer' => 'Ответ 2',
                ],
                'data' => '2',
            ]
        ];
        $answers[] = $answer;
        $answer = [
            '0' => [
                'choises' => [
                    '<head>,<header>,</main>,<html>',
                    '<tail>,<header>,</main>,<html>',
                    '<head>,</header>,<main>,<end>',
                    '<head>,<main>,</header>,<end>',
                ],
                'help' => [
                    'text' => 'Это будет 2 или 3',
                    'url' => 'img/1.png',
                ],
                'data' => '1'
            ],
            '1' => [
                'help' => [
                    'text' => 'Это будет 2 или 3',
                    'url' => 'img/1.png',
                ],
                'data' => '2',
            ]
        ];
        $answers[] = $answer;


        $taskMore = [
            '0' => [
                'url' => 'https://img.freepik.com/free-photo/cool-geometric-triangular-figure-neon-laser-light-great-backgrounds-wallpapers_181624-9331.jpg?w=2000',
                'text' => 'Дополнительное задания для задания 1 легкого уровня',
            ],
            '1' => [
                'url' => 'https://assets.entrepreneur.com/content/3x2/2000/20150312184504-cool-awesome.jpeg',
                'text' => 'Дополнительное задания для задания 1 сложного уровня',
            ]
        ];
        $tasksMore[] = $taskMore;
        $answerMore = [
            '0' => [
                'data' => '0' // Ответ на доп задание легкого уровня первого задания
            ],
            '1' => [
                'data' => '6', // Ответ на доп задание сложного уровня первого задания
            ]
        ];
        $answersMore[] = $answerMore;

        $taskMore = [
            '0' => [
                'url' => 'https://img.freepik.com/free-photo/cool-geometric-triangular-figure-neon-laser-light-great-backgrounds-wallpapers_181624-9331.jpg?w=2000',
                'text' => 'easy_more1',
            ],
            '1' => [
                'url' => 'https://assets.entrepreneur.com/content/3x2/2000/20150312184504-cool-awesome.jpeg',
                'text' => 'hard_more',
            ]
        ];
        $tasksMore[] = $taskMore;
        $answerMore = [
            '0' => [
                'data' => '0'
            ],
            '1' => [
                'data' => '6',
            ]
        ];
        $answersMore[] = $answerMore;

        $taskMore = [
            '0' => [
                'url' => 'https://img.freepik.com/free-photo/cool-geometric-triangular-figure-neon-laser-light-great-backgrounds-wallpapers_181624-9331.jpg?w=2000',
                'text' => 'easy_more1',
            ],
            '1' => [
                'url' => 'https://assets.entrepreneur.com/content/3x2/2000/20150312184504-cool-awesome.jpeg',
                'text' => 'hard_more',
            ]
        ];
        $tasksMore[] = $taskMore;
        $answerMore = [
            '0' => [
                'data' => '0'
            ],
            '1' => [
                'data' => '6',
            ]
        ];
        $answersMore[] = $answerMore;

        $tasks = json_encode($tasks);
        $answers = json_encode($answers);
        $tasksMore = json_encode($tasksMore);
        $answersMore = json_encode($answersMore);

        $test = [
            '0' => [
                [
                    'url' => 'https://s.wsj.net/public/resources/images/OG-BS302_201809_M_20180904103731.gif',
                    'text' => 'Текст вопроса 1 легкого уровня',
                    'choises' => [ //Варианты ответов
                        '1',
                        '2',
                        '3',
                        '4',
                    ],
                ], //Ещё 9 вопросов для легкого уровня
                [
                    'url' => 'https://s.wsj.net/public/resources/images/OG-BS302_201809_M_20180904103731.gif',
                    'text' => 'Текст вопроса 2 легкого уровня',
                    'choises' => [
                        '7',
                        '2',
                        '3',
                        '4',
                    ],
                ],
                [
                    'url' => 'https://s.wsj.net/public/resources/images/OG-BS302_201809_M_20180904103731.gif',
                    'text' => 'test 3',
                    'choises' => [
                        '6',
                        '2',
                        '3',
                        '4',
                    ],
                ],
                [
                    'url' => 'https://s.wsj.net/public/resources/images/OG-BS302_201809_M_20180904103731.gif',
                    'text' => 'test 4',
                    'choises' => [
                        '5',
                        '2',
                        '3',
                        '4',
                    ],
                ],
            ],
            '1' => [
                [
                    'url' => 'https://s.wsj.net/public/resources/images/OG-BS302_201809_M_20180904103731.gif',
                    'text' => 'Текст вопроса 1 сложного уровня',
                    'choises' => [ //Варианты ответов
                        '5',
                        '2',
                        '3',
                        '4',
                    ],
                ], //Ещё 9 вопросов для сложного уровня
                [
                    'url' => 'https://s.wsj.net/public/resources/images/OG-BS302_201809_M_20180904103731.gif',
                    'text' => 'hard test 2',
                    'choises' => [
                        '5',
                        '2',
                        '3',
                        '4',
                    ],
                ],
                [
                    'url' => 'https://s.wsj.net/public/resources/images/OG-BS302_201809_M_20180904103731.gif',
                    'text' => 'hard test 3',
                    'choises' => [
                        '5',
                        '2',
                        '3',
                        '4',
                    ],
                ],
                [
                    'url' => 'https://s.wsj.net/public/resources/images/OG-BS302_201809_M_20180904103731.gif',
                    'text' => 'hard test 4',
                    'choises' => [
                        '5',
                        '2',
                        '3',
                        '4',
                    ],
                ],
            ]
        ];

        $test_ans = [
            '0' => [
                [
                    'data' => '1' //Индекса правильного ответа в массиве вопросов для первого вопроса легкого уровня (Ответ: choises[1] => '2') *из вопросов для теста*
                ],
                [
                    'data' => '2' //Индекса правильного ответа в массиве вопросов для второго вопроса легкого уровня
                ],
                [
                    'data' => '3'
                ],
                [
                    'data' => '1'
                ],
            ],
            '1' => [
                [
                    'data' => '1' //Индекса правильного ответа в массиве вопросов для первого вопроса сложного уровня
                ],
                [
                    'data' => '1'
                ],
                [
                    'data' => '1'
                ],
                [
                    'data' => '1'
                ],
            ]
        ];


        $test = json_encode($test);
        $test_ans = json_encode($test_ans);

        $test_help_question = [
            'url' => 'https://s.wsj.net/public/resources/images/OG-BS302_201809_M_20180904103731.gif',
            'text' => 'Вопрос для задания по доп. подготовке',
        ];

        $test_help_answer = [
            'data' => '<head>', // Ответ на вопрос задания для доп. подготовке.
        ];

        $test_help_question = json_encode($test_help_question);
        $test_help_answer = json_encode($test_help_answer);

        $test_help_t_questions = [
            [
                'url' => 'https://s.wsj.net/public/resources/images/OG-BS302_201809_M_20180904103731.gif',
                'text' => 'Доп. подготовка. Тест, вопрос №1',
                'choises' => [ //Варианты ответов.
                    'one',
                    'two',
                    'forest',
                    'gump',
                ],
            ], //Еще несколько таких вопросов
            [
                'url' => 'https://s.wsj.net/public/resources/images/OG-BS302_201809_M_20180904103731.gif',
                'text' => 'Тест help 2',
                'choises' => [
                    '7',
                    '2',
                    '3',
                    '4',
                ],
            ],
            [
                'url' => 'https://s.wsj.net/public/resources/images/OG-BS302_201809_M_20180904103731.gif',
                'text' => 'Тест help 3',
                'choises' => [
                    '6',
                    '2',
                    '3',
                    '4',
                ],
            ],
            [
                'url' => 'https://s.wsj.net/public/resources/images/OG-BS302_201809_M_20180904103731.gif',
                'text' => 'test 4',
                'choises' => [
                    '5',
                    '2',
                    '3',
                    '4',
                ],
            ],
        ];

        $test_help_t_answers = [
            [
                'data' => '3' //Индекса правильного ответа в массиве вопросов для первого вопроса теста (Ответ: choises[1] => 'gump') *из вопросов для теста*
            ],
            // Еще ответы на остальные вопросы тест
            [
                'data' => '2'
            ],
            [
                'data' => '3'
            ],
            [
                'data' => '1'
            ],
        ];

        $test_help_t_questions = json_encode($test_help_t_questions);
        $test_help_t_answers = json_encode($test_help_t_answers);

        $topics =
            [
                [
                    'name' => 'Знакомство с HTML и CSS',
                    'slug' => 'html_and_css',
                    'url' => 'https://thumb.tildacdn.com/tild3963-6661-4533-b135-363265626237/-/resize/740x/-/format/webp/HTML.png',
                    'full_description' => '<p>"Знакомство с HTML и CSS" - это тема, которая знакомит начинающих программистов с основными принципами создания веб-страниц. HTML (HyperText Markup Language) является стандартным языком разметки веб-страниц, который используется для создания структуры и содержания страницы, в то время как CSS (Cascading Style Sheets) используется для оформления и стилизации этих страниц. </p>
                    <p>В рамках этой темы вы узнаете, как создавать элементы HTML, такие как заголовки, параграфы, списки и таблицы, а также как использовать CSS для изменения цвета, размера, шрифта и многих других свойств элементов HTML. Вы также познакомитесь с основными концепциями дизайна веб-страниц, такими как компоновка, цветовая гамма и типографика.</p>
                    <p>В результате знакомства с HTML и CSS вы сможете создавать простые веб-страницы и осуществлять базовую настройку их внешнего вида. Это будет отличным началом для дальнейшего изучения более сложных технологий веб-разработки.</p>',
                    'description' => 'Кратенькое описание темы',
                    'homework' => 'Основываясь на материале темы курса создайте заголовок и описание сайта игровой студии FATUMBA, используя CSS настройте вид страницы следующим образом:',
                    'homework_img' => '',
                    'lecture_text' => 'Текст к лекции темы 1',
                    'lecture_link' => 'http://127.0.0.1:8000/home (ссылка на презентацию)',
                    'lecture_meet_link' => 'http://127.0.0.1:8000/home (ссылка на видеоконференцию)',
                    'tasks' => $tasks,
                    'answers' => $answers,
                    'tasks_more' => $tasksMore,
                    'answers_more' => $answersMore,
                    'test_questions' => $test,
                    'test_answers' => $test_ans,
                    'test_help' => 'Текст для теории по доп. подготовки',
                    'test_help_question' => $test_help_question,
                    'test_help_answer' => $test_help_answer,
                    'test_help_t_questions' => $test_help_t_questions,
                    'test_help_t_answers' => $test_help_t_answers,
                ],
                [
                    'name' => 'Div-элементы, header сайта',
                    'slug' => 'div_and_header',
                    'url' => 'https://cdn.pixabay.com/photo/2016/11/11/14/49/minecraft-1816996_960_720.png',
                    'description' => '',
                    'full_description' => '<p>Div-элементы и header сайта - это важные компоненты веб-дизайна, которые помогают создавать эффективные и привлекательные сайты.</p>
                                            <p>Div-элементы используются для разделения контента на отдельные блоки, что позволяет улучшить организацию информации на странице и упростить ее восприятие. </p>
                                            <p>Header сайта, в свою очередь, является верхней частью страницы, которая содержит логотип, название сайта, основное меню навигации и другие важные элементы. Хороший header должен быть простым и легко читаемым, а также отображаться на всех устройствах, включая мобильные телефоны и планшеты. Кроме того, header может содержать информацию о компании или бренде, а также предоставлять пользователю быстрый доступ к различным разделам сайта. </p>
                                            <p>В целом, правильное использование div-элементов и header сайта помогает создавать удобные и функциональные сайты, которые будут привлекать большое количество посетителей.</p>',
                    'homework' => 'Основываясь на материале темы курса создайте заголовок и описание сайта игровой студии FATUMBA, используя CSS настройте вид страницы следующим образом:',
                    'homework_img' => '',
                    'lecture_text' => 'Текст к лекции темы 1',
                    'lecture_link' => 'http://127.0.0.1:8000/home (ссылка на презентацию)',
                    'lecture_meet_link' => 'http://127.0.0.1:8000/home (ссылка на видеоконференцию)',
                    'tasks' => $tasks,
                    'answers' => $answers,
                    'tasks_more' => $tasksMore,
                    'answers_more' => $answersMore,
                    'test_questions' => $test,
                    'test_answers' => $test_ans,
                    'test_help' => 'Текст для теории по доп. подготовки',
                    'test_help_question' => $test_help_question,
                    'test_help_answer' => $test_help_answer,
                    'test_help_t_questions' => $test_help_t_questions,
                    'test_help_t_answers' => $test_help_t_answers,
                ],
                [
                    'name' => 'Секции, обёртка секций',
                    'slug' => 'sections',
                    'url' => 'https://image.spreadshirtmedia.net/image-server/v1/designs/186505609,width=178,height=178.png',
                    'description' => '',
                    'full_description' => '<p>Секции - это отдельные блоки на веб-странице, которые содержат определенный контент. Они могут быть использованы для разделения страницы на логические части или для улучшения внешнего вида и удобства использования. </p>
                                            <p>Обертка секций - это элемент верстки, который используется для обрамления секций. Он позволяет задавать общие стили для всех секций, а также добавлять дополнительные элементы, такие как фоновое изображение или рамку. Обертка секций может быть создана с помощью CSS или HTML тега &lt;div&gt;. </p>
                                            <p>Использование секций и обертки секций является хорошей практикой в веб-разработке, так как это позволяет улучшить структуру страницы и упростить ее дальнейшее редактирование. Кроме того, использование секций и оберток позволяет создавать более качественный и профессиональный дизайн веб-страницы.</p>',
                    'homework' => 'Основываясь на материале темы курса создайте заголовок и описание сайта игровой студии FATUMBA, используя CSS настройте вид страницы следующим образом:',
                    'homework_img' => '',
                    'lecture_text' => 'Текст к лекции темы 1',
                    'lecture_link' => 'http://127.0.0.1:8000/home (ссылка на презентацию)',
                    'lecture_meet_link' => 'http://127.0.0.1:8000/home (ссылка на видеоконференцию)',
                    'tasks' => $tasks,
                    'answers' => $answers,
                    'tasks_more' => $tasksMore,
                    'answers_more' => $answersMore,
                    'test_questions' => $test,
                    'test_answers' => $test_ans,
                    'test_help' => 'Текст для теории по доп. подготовки',
                    'test_help_question' => $test_help_question,
                    'test_help_answer' => $test_help_answer,
                    'test_help_t_questions' => $test_help_t_questions,
                    'test_help_t_answers' => $test_help_t_answers,
                ],
                [
                    'name' => 'Секция навыков, псевдоэлементы',
                    'slug' => 'pseudo-elements',
                    'url' => 'https://media.tproger.ru/uploads/2020/03/layers-icon-new-cover-icon-original.png',
                    'description' => '',
                    'full_description' => '<p>Секция навыков и псевдоэлементы - это важные компоненты веб-дизайна, которые помогают создавать привлекательные и информативные сайты. Секция навыков используется для представления навыков и компетенций, которыми обладает автор или компания. Она может содержать графики, диаграммы и другие элементы, которые показывают уровень владения определенными навыками. </p>
                                            <p>Псевдоэлементы, в свою очередь, используются для создания дополнительных стилей для элементов на странице. Они могут быть использованы для добавления декоративных элементов, изменения цвета фона, изменения шрифта и других эффектов. Хорошо использованные псевдоэлементы могут значительно улучшить внешний вид сайта и повысить его привлекательность для пользователей. </p>
                                            <p>В целом, правильное использование секции навыков и псевдоэлементов помогает создавать красивые и функциональные сайты, которые будут привлекать большое количество посетителей.</p>',
                    'homework' => 'Основываясь на материале темы курса создайте заголовок и описание сайта игровой студии FATUMBA, используя CSS настройте вид страницы следующим образом:',
                    'homework_img' => '',
                    'lecture_text' => 'Текст к лекции темы 1',
                    'lecture_link' => 'http://127.0.0.1:8000/home (ссылка на презентацию)',
                    'lecture_meet_link' => 'http://127.0.0.1:8000/home (ссылка на видеоконференцию)',
                    'tasks' => $tasks,
                    'answers' => $answers,
                    'tasks_more' => $tasksMore,
                    'answers_more' => $answersMore,
                    'test_questions' => $test,
                    'test_answers' => $test_ans,
                    'test_help' => 'Текст для теории по доп. подготовки',
                    'test_help_question' => $test_help_question,
                    'test_help_answer' => $test_help_answer,
                    'test_help_t_questions' => $test_help_t_questions,
                    'test_help_t_answers' => $test_help_t_answers,
                ],
                [
                    'name' => 'Секция процессов, видео',
                    'slug' => 'process_and_video',
                    'url' => 'https://cdn-icons-png.flaticon.com/512/4404/4404094.png',
                    'description' => '',
                    'full_description' => '<p>Секция процессов и видео - это важные элементы веб-дизайна, которые помогают создавать информативные и привлекательные сайты. </p>
                                            <p>Секция процессов используется для представления процессов, которые выполняет автор или компания, чтобы достичь определенных результатов. Она может содержать графики, диаграммы и другие элементы, которые показывают этапы выполнения процесса. </p>
                                            <p>Секция видео, в свою очередь, используется для представления видеоматериалов, которые могут быть связаны с темой сайта. Она может содержать видеоролики, презентации и другие элементы, которые помогают пользователям лучше понять тему сайта. </p>
                                            <p>Хорошо использованные секции процессов и видео могут значительно улучшить внешний вид сайта и повысить его привлекательность для пользователей. В целом, правильное использование секций процессов и видео помогает создавать красивые и функциональные сайты, которые будут привлекать большое количество посетителей.</p>',
                    'homework' => 'Основываясь на материале темы курса создайте заголовок и описание сайта игровой студии FATUMBA, используя CSS настройте вид страницы следующим образом:',
                    'homework_img' => '',
                    'lecture_text' => 'Текст к лекции темы 1',
                    'lecture_link' => 'http://127.0.0.1:8000/home (ссылка на презентацию)',
                    'lecture_meet_link' => 'http://127.0.0.1:8000/home (ссылка на видеоконференцию)',
                    'tasks' => $tasks,
                    'answers' => $answers,
                    'tasks_more' => $tasksMore,
                    'answers_more' => $answersMore,
                    'test_questions' => $test,
                    'test_answers' => $test_ans,
                    'test_help' => 'Текст для теории по доп. подготовки',
                    'test_help_question' => $test_help_question,
                    'test_help_answer' => $test_help_answer,
                    'test_help_t_questions' => $test_help_t_questions,
                    'test_help_t_answers' => $test_help_t_answers,
                ],
                [
                    'name' => 'Секция формы, поля ввода, кнопки',
                    'slug' => 'forms',
                    'url' => 'https://docs.sweetsystems.se/en/4.8.5/_images/form8.png',
                    'description' => '',
                    'full_description' => '<p>Секция формы, поля ввода и кнопки - это важные компоненты веб-дизайна, которые используются для создания интерактивных элементов на сайте. Секция формы представляет собой блок, в котором размещаются поля для ввода информации, а также кнопка отправки данных. Поля ввода могут быть различных типов, например, текстовые поля, поля для выбора даты или времени, чекбоксы и радиокнопки. Кнопка отправки данных позволяет пользователю отправить заполненную форму на сервер. </p>
                                            <p>Правильное оформление секции формы, полей ввода и кнопки помогает сделать сайт более удобным и функциональным для пользователей. Она должна быть легко различима и привлекательной визуально. Важно также учитывать эргономику элементов: расположение полей ввода должно быть логичным и удобным для заполнения. </p>
                                            <p>Кроме того, секция формы может содержать дополнительные элементы, такие как подсказки для заполнения полей, сообщения об ошибках при заполнении формы или ссылки на дополнительную информацию. В целом, правильное использование секции формы, полей ввода и кнопки позволяет создавать удобные и функциональные сайты, которые будут привлекать большое количество посетителей и повышать уровень взаимодействия с ними.</p>',
                    'homework' => 'Основываясь на материале темы курса создайте заголовок и описание сайта игровой студии FATUMBA, используя CSS настройте вид страницы следующим образом:',
                    'homework_img' => '',
                    'lecture_text' => 'Текст к лекции темы 1',
                    'lecture_link' => 'http://127.0.0.1:8000/home (ссылка на презентацию)',
                    'lecture_meet_link' => 'http://127.0.0.1:8000/home (ссылка на видеоконференцию)',
                    'tasks' => $tasks,
                    'answers' => $answers,
                    'tasks_more' => $tasksMore,
                    'answers_more' => $answersMore,
                    'test_questions' => $test,
                    'test_answers' => $test_ans,
                    'test_help' => 'Текст для теории по доп. подготовки',
                    'test_help_question' => $test_help_question,
                    'test_help_answer' => $test_help_answer,
                    'test_help_t_questions' => $test_help_t_questions,
                    'test_help_t_answers' => $test_help_t_answers,
                ],
                [
                    'name' => 'Секция галереи, JQuery',
                    'slug' => 'gallery_and_jquery',
                    'url' => 'https://i.stack.imgur.com/ggwZD.png',
                    'description' => '',
                    'full_description' => '<p>Секция галереи и JQuery - это важные элементы веб-дизайна, которые помогают создавать красивые и интерактивные сайты. Секция галереи используется для представления изображений и фотографий, которые могут быть связаны с темой сайта. Она может содержать слайдеры, карусели и другие элементы, которые помогают пользователям лучше ознакомиться с контентом сайта. </p>
                                            <p>JQuery, в свою очередь, является библиотекой JavaScript, которая позволяет создавать интерактивные и анимированные элементы на сайте. Она может использоваться для создания эффектов переходов, анимации и других интерактивных элементов. </p>
                                            <p>Хорошо использованные секции галереи и JQuery могут значительно улучшить внешний вид сайта и повысить его привлекательность для пользователей. В целом, правильное использование секций галереи и JQuery помогает создавать красивые и функциональные сайты, которые будут привлекать большое количество посетителей.</p>',
                    'homework' => 'Основываясь на материале темы курса создайте заголовок и описание сайта игровой студии FATUMBA, используя CSS настройте вид страницы следующим образом:',
                    'homework_img' => '',
                    'lecture_text' => 'Текст к лекции темы 1',
                    'lecture_link' => 'http://127.0.0.1:8000/home (ссылка на презентацию)',
                    'lecture_meet_link' => 'http://127.0.0.1:8000/home (ссылка на видеоконференцию)',
                    'tasks' => $tasks,
                    'answers' => $answers,
                    'tasks_more' => $tasksMore,
                    'answers_more' => $answersMore,
                    'test_questions' => $test,
                    'test_answers' => $test_ans,
                    'test_help' => 'Текст для теории по доп. подготовки',
                    'test_help_question' => $test_help_question,
                    'test_help_answer' => $test_help_answer,
                    'test_help_t_questions' => $test_help_t_questions,
                    'test_help_t_answers' => $test_help_t_answers,
                ],
                [
                    'name' => 'Основы JavaScript',
                    'slug' => 'java-script',
                    'url' => 'https://cdn.coursehunter.net/category/javascript.png',
                    'description' => '',
                    'full_description' => '<p>Основы JavaScript - это тема, которая знакомит начинающих программистов с основами языка программирования JavaScript. JavaScript является одним из самых популярных языков программирования, который используется для создания интерактивных и динамических веб-сайтов. </p>
                                            <p>В рамках этой темы обычно рассматриваются основные концепции и принципы языка, такие как переменные, операторы, условные выражения, циклы, функции и объекты. Также рассматриваются различные методы и свойства, которые используются для работы с элементами HTML и CSS на странице. </p>
                                            <p>Основы JavaScript также включают в себя изучение событий и обработчиков событий, которые позволяют создавать интерактивные элементы на странице.  В целом, изучение основ JavaScript является необходимым для всех, кто хочет создавать современные и функциональные веб-сайты.</p>',
                    'homework' => 'Основываясь на материале темы курса создайте заголовок и описание сайта игровой студии FATUMBA, используя CSS настройте вид страницы следующим образом:',
                    'homework_img' => '',
                    'lecture_text' => 'Текст к лекции темы 1',
                    'lecture_link' => 'http://127.0.0.1:8000/home (ссылка на презентацию)',
                    'lecture_meet_link' => 'http://127.0.0.1:8000/home (ссылка на видеоконференцию)',
                    'tasks' => $tasks,
                    'answers' => $answers,
                    'tasks_more' => $tasksMore,
                    'answers_more' => $answersMore,
                    'test_questions' => $test,
                    'test_answers' => $test_ans,
                    'test_help' => 'Текст для теории по доп. подготовки',
                    'test_help_question' => $test_help_question,
                    'test_help_answer' => $test_help_answer,
                    'test_help_t_questions' => $test_help_t_questions,
                    'test_help_t_answers' => $test_help_t_answers,
                ],
                [
                    'name' => 'Всплывающая форма',
                    'slug' => 'popups',
                    'url' => 'https://raw.githubusercontent.com/johnhenry/node-popup/HEAD/docs/alert.png',
                    'description' => '',
                    'full_description' => '<p>Всплывающая форма - это элемент веб-дизайна, который используется для сбора информации от пользователей. Она может появляться на странице сайта после нажатия на определенную кнопку или ссылку, либо автоматически через определенный промежуток времени. </p>
                                            <p>Всплывающая форма может содержать различные поля для заполнения, такие как имя, электронная почта, номер телефона и т.д., а также кнопки отправки и отмены. Она может использоваться для сбора контактной информации, подписки на рассылку, регистрации на сайте и других целей. </p>
                                            <p>Всплывающая форма может быть статичной или анимированной, с использованием различных эффектов переходов и анимации. Правильно использованная всплывающая форма помогает улучшить взаимодействие с пользователями и повысить конверсию на сайте. Однако, ее использование должно быть осторожным, чтобы не вызывать раздражения у пользователей и не нарушать их комфорт при использовании сайта.</p>',
                    'homework' => 'Основываясь на материале темы курса создайте заголовок и описание сайта игровой студии FATUMBA, используя CSS настройте вид страницы следующим образом:',
                    'homework_img' => '',
                    'lecture_text' => 'Текст к лекции темы 1',
                    'lecture_link' => 'http://127.0.0.1:8000/home (ссылка на презентацию)',
                    'lecture_meet_link' => 'http://127.0.0.1:8000/home (ссылка на видеоконференцию)',
                    'tasks' => $tasks,
                    'answers' => $answers,
                    'tasks_more' => $tasksMore,
                    'answers_more' => $answersMore,
                    'test_questions' => $test,
                    'test_answers' => $test_ans,
                    'test_help' => 'Текст для теории по доп. подготовки',
                    'test_help_question' => $test_help_question,
                    'test_help_answer' => $test_help_answer,
                    'test_help_t_questions' => $test_help_t_questions,
                    'test_help_t_answers' => $test_help_t_answers,
                ],
                [
                    'name' => 'Анимация',
                    'slug' => 'animation',
                    'url' => 'https://res.cloudinary.com/practicaldev/image/fetch/s--R3JbGlUM--/c_limit%2Cf_auto%2Cfl_progressive%2Cq_auto%2Cw_880/https://cdn-images-1.medium.com/max/800/0%2A5Ky7VV0gTNcl0koU.png',
                    'description' => '',
                    'full_description' => '<p>Анимация - это процесс создания движущихся элементов на веб-страницах. Анимация может быть использована для улучшения пользовательского опыта, привлечения внимания к ключевым элементам, подчеркивания важности информации и многого другого. </p>
                                            <p>В рамках этой темы обычно рассматриваются различные методы создания анимации, такие как CSS анимация, JavaScript анимация и SVG анимация. Также изучаются основные принципы анимации, такие как скорость, траектория, зацикливание и т.д. </p>
                                            <p>Важным аспектом анимации в веб-дизайне является ее соответствие современным требованиям к производительности и доступности, что подразумевает оптимизацию кода и использование альтернативных решений для устройств с ограниченными возможностями. </p>
                                            <p>В целом, изучение анимации в веб-дизайне позволяет создавать более интерактивные и привлекательные веб-сайты, которые лучше соответствуют потребностям пользователей.</p>',
                    'homework' => 'Основываясь на материале темы курса создайте заголовок и описание сайта игровой студии FATUMBA, используя CSS настройте вид страницы следующим образом:',
                    'homework_img' => '',
                    'lecture_text' => 'Текст к лекции темы 1',
                    'lecture_link' => 'http://127.0.0.1:8000/home (ссылка на презентацию)',
                    'lecture_meet_link' => 'http://127.0.0.1:8000/home (ссылка на видеоконференцию)',
                    'tasks' => $tasks,
                    'answers' => $answers,
                    'tasks_more' => $tasksMore,
                    'answers_more' => $answersMore,
                    'test_questions' => $test,
                    'test_answers' => $test_ans,
                    'test_help' => 'Текст для теории по доп. подготовки',
                    'test_help_question' => $test_help_question,
                    'test_help_answer' => $test_help_answer,
                    'test_help_t_questions' => $test_help_t_questions,
                    'test_help_t_answers' => $test_help_t_answers,
                ],
                [
                    'name' => 'Доработка сайта, кликабельное меню и footer',
                    'slug' => 'final_preparations',
                    'url' => 'https://res.cloudinary.com/practicaldev/image/fetch/s--HqnM3chU--/c_imagga_scale,f_auto,fl_progressive,h_500,q_auto,w_1000/https://dev-to-uploads.s3.amazonaws.com/uploads/articles/g167l47m45sq1za89905.png',
                    'description' => '',
                    'full_description' => '<p>Эта тема ознакомит с основными принципами дизайна и разработки веб-сайтов. В рамках этой темы рассматриваются способы улучшения пользовательского опыта на сайте, добавления новых функций и улучшения внешнего вида. </p>
                                            <p>Одним из ключевых элементов доработки сайта является создание кликабельного меню, которое позволяет пользователям легко найти нужную информацию на сайте. Для этого используются различные технологии, такие как HTML, CSS и JavaScript. </p>
                                            <p>Кроме того, важным элементом доработки сайта является footer - нижняя часть страницы, которая содержит информацию о компании, контактные данные и ссылки на социальные сети. Для создания эффективного footer используются различные дизайнерские приемы и технологии, такие как HTML, CSS и JavaScript. </p>
                                            <p>В целом, эта тема является важным элементом для создания современных и функциональных веб-сайтов.</p>',
                    'homework' => 'Основываясь на материале темы курса создайте заголовок и описание сайта игровой студии FATUMBA, используя CSS настройте вид страницы следующим образом:',
                    'homework_img' => '',
                    'lecture_text' => 'Текст к лекции темы 1',
                    'lecture_link' => 'http://127.0.0.1:8000/home (ссылка на презентацию)',
                    'lecture_meet_link' => 'http://127.0.0.1:8000/home (ссылка на видеоконференцию)',
                    'tasks' => $tasks,
                    'answers' => $answers,
                    'tasks_more' => $tasksMore,
                    'answers_more' => $answersMore,
                    'test_questions' => $test,
                    'test_answers' => $test_ans,
                    'test_help' => 'Текст для теории по доп. подготовки',
                    'test_help_question' => $test_help_question,
                    'test_help_answer' => $test_help_answer,
                    'test_help_t_questions' => $test_help_t_questions,
                    'test_help_t_answers' => $test_help_t_answers,
                ],
            ];



        foreach ($topics as $topic) {
            Topic::create($topic);
        }

        $faker = Factory::create();
        $admin = [
            'name' => $faker->name(),
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'admin' => true,
            'password' => Hash::make('admin123'), // password
            'remember_token' => Str::random(10),
        ];

        User::create($admin);

        $users = [
            [
                'name' => $faker->name(),
                'email' => 'user@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123'), // password
                'remember_token' => Str::random(10),
            ],
            [
                'name' => $faker->name(),
                'email' => 'user2@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123'), // password
                'remember_token' => Str::random(10),
            ]
        ];

        foreach ($users as $user) {
            $user = User::create($user);
            Progress::create([
                'user_id' => $user->id,
                'topic_id' => 1,
            ]);
            Storage::makeDirectory($user->email);
        }
    }
}
