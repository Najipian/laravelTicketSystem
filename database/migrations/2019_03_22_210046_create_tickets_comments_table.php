<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets_comments', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('ticket_id');
            $table->foreign('ticket_id')
                ->references('id')
                ->on('tickets')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->tinyInteger('direction')
                ->default(0)
                ->comment('0 : comment from tenant to landlord , 1 : from assigned landlord user to tenant');

            $table->unsignedBigInteger('landlord_user_id_response')
                ->nullable();
            $table->foreign('landlord_user_id_response')
                ->references('id')
                ->on('landlords')
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->comment('represents which landlord user write the comment ');

            $table->string('comment' , 500);

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
        Schema::dropIfExists('comment');
    }
}
