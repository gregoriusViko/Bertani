
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
        
        Schema::dropIfExists('orders');
        Schema::create('orders', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->foreignId('buyer_id')->constrained(
                table:'buyers',
                indexName: 'orders_buyer_id'
            );
            $table->foreignId('product_id')->constrained(
                table:'products',
                indexName: 'order_product_id'
            );
            $table->decimal('price');
            $table->decimal('quantity_kg');
            $table->dateTime('order_time');
            $table->string('payment_proof', 150)->nullable();
            $table->string('receipt_number', 15)->unique();
            $table->string('order_status', 30)->nullable();
        });
 
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};