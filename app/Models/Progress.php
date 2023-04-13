<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function getTimer()
    {
        $now = Carbon::now();
        if(!$this->task_end_at){
            return -1;
        }
        $diff =  $now->diffInSeconds($this->task_end_at, false);
        if ($diff <= 0) {
            return -1;
        }

        return $diff;
    }
}
