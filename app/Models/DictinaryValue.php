<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class DictinaryValue extends Model
{
    use HasFactory;

    protected $table='dictionary_value';

    public $timestamps = false;
    protected $primaryKey = ['dict_id', 'dict_value_id'];
    protected $fillable = ['value'];

    protected $hidden = ['dict_id', 'dict_value_id'];

    public function dictinary(): BelongsTo
    {
        return $this->belongsTo(Dictionaries::class,'dict_id','dict_id');
    }
}
