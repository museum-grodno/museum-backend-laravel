<?php

namespace App\Models;

use DictionaryValue;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Dictionaries extends Model
{
    use HasFactory;

    /**
     * Таблица БД, ассоциированная с моделью.
     *
     * @var string
     */

    protected $table='dictionaries';

    public $timestamps = false;

    /**
     * Первичный ключ таблицы БД.
     *
     * @var string
     */
    protected $primaryKey = 'dict_id';

    protected $fillable = [
        'name',
        'title',
        'description'
    ];

    public function  dictionaryValue(): HasMany
    {
        return $this->hasMany(DictionaryValue::class, 'dict_id', 'dict_id');
    }

}
