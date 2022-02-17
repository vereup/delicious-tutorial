<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('category_id');
            $table->unsignedbigInteger('address_id');
            $table->unsignedbigInteger('local_code_id');
            $table->string('name');
            $table->text('introduction');
            $table->string('telephone_number');
            $table->float('rating_average', 3, 2)->default(5.0);
            $table->unsignedInteger('review_count')->default(0);
            $table->string('address_detail');

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('address_id')->references('id')->on('addresses');
            $table->foreign('local_code_id')->references('id')->on('local_codes');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
}
