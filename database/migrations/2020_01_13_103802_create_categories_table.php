<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 50)->comment('Заголовок скидки');
            $table->string('description', 1000)->comment('Описание');
            $table->unsignedBigInteger('parent_id')->nullable()->comment('Идентификатор родительской категории');
            $table->smallInteger('discount')->comment('Скидка от 0 до 100');
            $table->string('image_url', 300)->comment('Путь к картинке');
            $table->integer('edit_user_id')->comment('Идентификатор пользователя, изменившего запись');
            $table->json('tags')->comment('Теги для быстрого поиска');
            $table->timestamps();

            $table->index('parent_id');

            // $table->foreign('parent_id')->references('id')->on('categories')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
