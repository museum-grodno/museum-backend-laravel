<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DictionaryValue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Таблица значений справочников

        Schema::create('dictionary_value', function (Blueprint $table) {
            $table->unsignedBigInteger('dict_id')->primary();
            $table->foreign('dict_id')
                    ->references('dict_id')
                    ->on('dictionaries')
                    ->restrictOnDelete();
            $table->integer('dict_value_id')->primary();
            $table->text('value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Удаление таблицы
        Schema::drop('dictionary_value');
    }
}
