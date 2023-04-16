<?php

namespace App\Models;

use DateTime;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'admin',
        'code',
        'mode',
        'hard',
        'topic',
        'points',
        'end_at',
        'mode_changed_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function registrationDate()
    {
        return $this->created_at->format('d-m-Y');
    }

    /** Счетчик обратного отсчета
     *
     * @param mixed $date
     * @return
     */
    function downcounter($date)
    {
        $check_time = strtotime($date) - time();
        if ($check_time <= 0) {
            return false;
        }

        $days = floor($check_time / 86400);
        $hours = floor(($check_time % 86400) / 3600);
        $minutes = floor(($check_time % 3600) / 60);
        $seconds = $check_time % 60;

        $str = '';
        if ($days > 0) $str .= $this->declension($days, array('день', 'дня', 'дней')) . ' ';
        if ($hours > 0) $str .= $this->declension($hours, array('час', 'часа', 'часов')) . ' ';
        //if ($minutes > 0) $str .= $this->declension($minutes, array('минута', 'минуты', 'минут')) . ' ';
        //if ($seconds > 0) $str .= $this->declension($seconds, array('секунда', 'секунды', 'секунд'));

        return $str;
    }

    /**
     * Функция склонения слов
     *
     * @param mixed $digit
     * @param mixed $expr
     * @param bool $onlyword
     * @return
     */
    function declension($digit, $expr, $onlyword = false)
    {
        if (!is_array($expr)) $expr = array_filter(explode(' ', $expr));
        if (empty($expr[2])) $expr[2] = $expr[1];
        $i = preg_replace('/[^0-9]+/s', '', $digit) % 100;
        if ($onlyword) $digit = '';
        if ($i >= 5 && $i <= 20) $res = $digit . ' ' . $expr[2];
        else {
            $i %= 10;
            if ($i == 1) $res = $digit . ' ' . $expr[0];
            elseif ($i >= 2 && $i <= 4) $res = $digit . ' ' . $expr[1];
            else $res = $digit . ' ' . $expr[2];
        }
        return trim($res);
    }

    public function timeLeft()
    {
        return $this->downcounter($this->end_at);
    }

    public function mode()
    {
        return $this->mode == 0 ? 'Обычный' : 'Ускоренный';
    }

    public function fileUploaded($topicId)
    {
        $files = Storage::files($this->email . '/' . $topicId);
        return count($files) != 0;
    }

    public function homeworkMark($topicId)
    {
        $mark = Progress::where('user_id', $this->id)->where('topic_id', $topicId)->first();
        $mark = $mark->homework_mark ?? '';
        return $mark;
    }

    public function progress()
    {
        return round(($this->topic - 1) / Topic::all()->count() * 100);
    }

    public function getTopic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function finishedTopics(){
        $topics = Topic::where('id', '<', $this->topic)->get();
        return $topics;
    }
}
