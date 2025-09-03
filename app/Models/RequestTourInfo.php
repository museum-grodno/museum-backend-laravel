<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dictionaries;

class RequestTourInfo extends Model
{
    use HasFactory;

     /**
     * Таблица БД, ассоциированная с моделью.
     *
     * @var string
     */

     protected $table='requests_tour_info';

     public $timestamps = false;

     /**
      * Первичный ключ таблицы БД.
      *
      * @var string
      */
     protected $primaryKey = 'rq_id';

     protected $fillable = [
        'rq_id',
        'rq_object_id',
        'rq_date_info',
        'rq_time_start',
        'rq_count_customers',
         'rq_object_id',
        'rq_is_excursions',
        'rq_organisation_name',
        'rq_organisation_address',
        'rq_organisation_unp',
        'rq_organisation_rs',
        'rq_organisation_contacts',
        'rq_organisation_email',
        'rq_count_customers_old',
        'rq_count_customers_pensioner',
        'rq_count_customers_student',
         'rq_count_customers_pupil',
        'rq_count_customers_toddler',
        'rq_count_customers_lgotniki',
     ];

     protected $hidden = [

     ];

     protected $dateFormat = [
       'rq_date_info'
     ];

     public function getObjectInfo($objectId){
         $objectInfo = Dictionaries::where('name','object')->get();
         $objectValue =  $objectInfo->dictionaryValue::where('dict_value_id',$objectId)->get();

         return $objectValue;
     }
}
