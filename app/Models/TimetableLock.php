<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimetableLock extends Model
{
    use HasFactory;
    protected $table='timetable_locks';
    public $timestamps = false;
    protected $primaryKey = 'tt_lock_id';
    protected $fillable = [
      'tt_lock_id',
      'tt_lock_date',
      'tt_lock_time_begin',
      'tt_lock_allday',
      'tt_lock_object_id',
      'tt_lock_comments'
    ];
    protected $hidden = [
    ];
    protected $dateFormat = [
        'tt_lock_date'
    ];


}
