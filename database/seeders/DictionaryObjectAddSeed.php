<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DictionaryObjectAddSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert("INSERT INTO dictionaries (NAME,title,DESCRIPTION)VALUES('object','Филилы','');");
        DB::insert("
            INSERT INTO
	            dictionary_value
                    (dict_id,dict_value_id,VALUE)
                    SELECT
	                    dict_id,
                        1,'Новый замок'
                     FROM
                        dictionaries
                ");
                DB::insert("
                INSERT INTO
                    dictionary_value
                        (dict_id,dict_value_id,VALUE)
                        SELECT
                            dict_id,
                            2,'Старый замок'
                         FROM
                            dictionaries
                    ");

    }
}
