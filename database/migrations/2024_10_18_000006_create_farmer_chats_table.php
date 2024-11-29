
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
        
        Schema::dropIfExists('farmer_chats');
        Schema::create('farmer_chats', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->foreignId('farmer_id')->constrained(
                table:'farmers',
                indexName: 'farmerChats_farmer_id'
            );
            $table->foreignId('buyer_id')->constrained(
                table:'buyers',
                indexName: 'farmerChats_buyer_id'
            );
            $table->string('role', 16);
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
        Schema::dropIfExists('farmer_chats');
    }
};
