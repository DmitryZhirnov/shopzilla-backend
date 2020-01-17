<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 50)->comment('Заголовок скидки');
            $table->string('description', 1000)->comment('Описание');
            $table->unsignedBigInteger('category_id')->comment('Идентификатор категории');
            $table->smallInteger('discount')->comment('Скидка от 0 до 100');
            $table->date('date_from')->comment('Дата начала акции');
            $table->date('date_to')->comment('Дата окончания акции');
            $table->string('image_url', 300)->comment('Путь к картинке');
            $table->unsignedBigInteger('edit_user_id')->comment('Идентификатор пользователя, изменившего запись');
            $table->json('tags')->comment('Теги для быстрого поиска');
            $table->timestamps();

            // $table->foreign('category_id')
            //     ->references('id')->on('categories')
            //     ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discounts');
    }
}
