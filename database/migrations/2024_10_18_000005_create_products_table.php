
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
            $table->string('name', 50);
            $table->text('description')->nullable();
            $table->decimal('stock_kg');
            $table->decimal('selling_unit_kg');
            $table->string('product_type', 50)->nullable();
            $table->decimal('price')->nullable();
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
