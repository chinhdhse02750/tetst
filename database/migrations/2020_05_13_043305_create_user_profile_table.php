<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');;
            $table->unsignedBigInteger('admin_id');
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');;
            $table->string('name', 255)->comment('admin name');
            $table->integer('age')->comment('age');
            $table->string('tel', 255)->nullable()->comment('tel number');
            $table->string('line_id', 255)->nullable()->comment('Line ID');
            $table->string('figure', 255)->nullable()->comment('figure');
            $table->integer('height')->nullable()->default(0)->comment('height');
            $table->integer('weight')->default(0)->comment('weight');
            $table->string('underwear_type', 20)->nullable()->comment('Underwear type');
            $table->integer('rating_star')->comment('rating star');
            $table->string('dating_type', 20)->default('A')->comment('dating type');
            $table->string('sign', 255)->nullable()->comment('sign');
            $table->integer('blood_type')->comment('blood type');
            $table->string('occupation',255)->nullable()->comment('occupation');
            $table->integer('income')->default(0)->comment('income');
            $table->integer('smoking')->default(0)->comment('smoking');
            $table->string('alcohol',255)->nullable()->comment('alcohol');
            $table->string('address',255)->nullable()->comment('address');
            $table->string('conversation_lang',255)->nullable()->comment('conversation lang');
            $table->string('hobby',255)->nullable()->comment('hobby');
            $table->string('offer',255)->nullable()->comment('offer');
            $table->string('tag',255)->nullable()->comment('tags');
            $table->text('comment')->nullable()->comment('comment');
            $table->text('club_comment')->nullable()->comment('club comment');
            $table->boolean('is_pickup')->default(false)->comment('is pick up');
            $table->boolean('is_searchable')->default(false)->comment('is search');
            $table->boolean('is_publish')->default(false)->comment('publish');
            $table->timestamp('expired_at')->nullable()->comment('expired at');
            $table->timestamps();
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
        Schema::dropIfExists('user_profiles');
    }
}
