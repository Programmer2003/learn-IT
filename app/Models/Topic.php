<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getTask($task_number)
    {
        if ($task_number < 1 || $task_number > 3) {
            return false;
        }
        $task = json_decode($this->tasks)[$task_number - 1];
        $answer = json_decode($this->answers)[$task_number - 1];
        $hard = auth()->user()->hard;
        $result = (object) array(
            'url' => $task[$hard]->url,
            'text' => $task[$hard]->text,
            'type' => $task[$hard]->type,
            'choises' => $answer[$hard]->choises,
            'answer' => $answer[$hard]->data,
        );

        return $result;
    }

    public function getAnswer($task_number)
    {
        if ($task_number < 1 || $task_number > 3) {
            return false;
        }

        $hard = auth()->user()->hard;
        return json_decode($this->answers)[$task_number - 1][$hard]->data;
    }

    public function getHelp($task_number)
    {
        if ($task_number < 1 || $task_number > 3) {
            return false;
        }

        $hard = auth()->user()->hard;
        return json_decode($this->answers)[$task_number - 1][$hard]->help;
    }

    public function getMore($task_number)
    {
        $hard = auth()->user()->hard;
        return json_decode($this->tasks_more)[$task_number - 1][$hard];
    }

    public function getAnswerMore($task_number)
    {
        $hard = auth()->user()->hard;
        return json_decode($this->answers_more)[$task_number - 1][$hard]->data;
    }

    public function getTestTasks(){
        return json_decode($this->test_questions);
    }

    public function getTestAnswers(){
        $hard = auth()->user()->hard;
        return json_decode($this->test_answers)[$hard];
    }

    public function getTest()
    {
        $tasks = $this->getTestTasks();
        $hard = auth()->user()->hard;
        $test = (object) array(
            'tasks' => $tasks[$hard],
        );
        return $test;
    }

    public function getHelpTask(){
        return json_decode($this->test_help_question);
    }

    public function getHelpAnswer()
    {
        return json_decode($this->test_help_answer)->data;
    }

    public function getHelpTestTask(){
        return json_decode($this->test_help_t_questions);
    }
    public function getHelpTestTaskAnswers(){
        return json_decode($this->test_help_t_answers);
    }
}
