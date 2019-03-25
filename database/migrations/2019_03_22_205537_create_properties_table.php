<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');

            $table->unsignedBigInteger('landlord_id');

            $table->foreign('landlord_id')
                ->references('id')->on('landlords')
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->comment('represents the owner of the property');

            $table->unsignedBigInteger('user_id')
                ->nullable();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->comment('represents the tenant user of the property');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property');
    }
}
