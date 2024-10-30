
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
        
        Schema::dropIfExists('buyer_chats');
        Schema::create('buyer_chats', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->foreignId('buyer_id')->constrained(
                table:'buyers',
                indexName: 'buyer_chats_buyer_id'
            );
            $table->foreignId('farmer_id')->constrained(
                table:'farmers',
                indexName: 'buyer_chats_farmer_id'
            );
            $table->string('role_of_buyer', 16);
            $table->tinyInteger('is_read')->default(0);
            $table->dateTime('send_time');
            $table->text('content');
        });
 
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('buyer_chats');
    }
};
