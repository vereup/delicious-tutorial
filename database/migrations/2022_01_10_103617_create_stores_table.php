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
            $table->bigInteger('cartegory_id');
            $table->foreign('cartegory_id')->references('id')->on{'categories'};
            $table->bigInteger('address_id');
            $table->foreign('address_id')->references('id')->on{'addresses'};
            $table->bigInteger('local_code_id');
            $table->foreign('local_code_id')->references('id')->on{'local_codes'};
            $table->string('name');
            $table->text('introduction');
            $table->unsignedInteger('telephone_number');
            $table->unsignedDecimal('rating_average', 1, 1);
            $table->unsignedInteger('review_count');
            $table->string('adress');

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
