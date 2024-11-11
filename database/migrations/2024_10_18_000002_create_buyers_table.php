
<?php
        /**
     *namespace Database\Migrations;
     */


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class  extends Migration
{
        /**
     * Run the migrations.
     */
    public function up()
    {
        
        Schema::dropIfExists('buyers');
        Schema::create('buyers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('email_address', 45)->unique();
            $table->string('password');
            $table->string('name', 50)->unique();
            $table->string('phone_number', 45)->nullable();
            $table->string('profile_img_link', 150)->nullable();
            $table->string('home_address', 150)->nullable();
            $table->string('slug')->unique();
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->dateTimes();
            $table->string('status', 10)->default('active');
        });
 
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('buyers');
    }
};
