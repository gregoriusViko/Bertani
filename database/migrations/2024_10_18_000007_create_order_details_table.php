
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
        
        Schema::dropIfExists('order_details');
        Schema::create('order_details', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->foreignId('order_id')->constrained(
                table:'orders',
                indexName: 'orderDetails_order_id'
            );
            $table->foreignId('product_id')->constrained(
                table:'products',
                indexName: 'orderDetails_product_id'
            );
            $table->decimal('price');
            $table->decimal('order_quantity');
        });
 
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
};
