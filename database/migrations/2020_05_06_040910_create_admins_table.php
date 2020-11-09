<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email', 255)->unique()->comment('admin email');
            $table->string('name', 255)->comment('admin name');
            $table->string('password', 255)->nullable()->comment('password');
            $table->timestamp('last_login_at')->nullable()->comment('Last login at');
            $table->string('last_login_ip', 100)->nullable()->comment('Last login ip');
            $table->rememberToken()->comment('remember token');
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
        Schema::dropIfExists('admins');
    }
}
