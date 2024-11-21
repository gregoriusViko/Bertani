
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
        
        Schema::dropIfExists('products');
        Schema::create('products', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->foreignId('farmer_id')->constrained(
                table:'farmers',
                indexName: 'products_farmer_id'
            );
            $table->foreignId('type_of_product_id')->constrained(
                table:'type_of_products',
                indexName: 'products_type_id'
            );
            $table->foreignId('history_price_id')->constrained(
                table:'history_price',
                indexName: 'history_price_id'
            );
            $table->text('description')->nullable();
            $table->decimal('stock_kg');
            $table->decimal('price')->nullable();
            $table->string('slug')->unique();
            $table->dateTimes();
            $table->string('img_link', length: 150)->default('noimage.png');
        });
 
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
