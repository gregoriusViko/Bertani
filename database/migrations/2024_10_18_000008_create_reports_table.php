
<?php
        /**
     *namespace Database\Migrations;
     */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class  extends Migration
{
        /**
     * Run the migrations.
     */
    public function up()
    {
        
        Schema::dropIfExists('reports');
        Schema::create('reports', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->foreignId('buyer_id')->nullable()->constrained(
                table:'buyers',
                indexName: 'reports_buyer_id'
            );
            $table->foreignId('farmer_id')->nullable()->constrained(
                table:'farmers',
                indexName: 'reports_farmer_id'
            );
            $table->foreignId('order_id')->nullable()->constrained(
                table:'orders',
                indexName: 'reports_order_id'
            );
            $table->string('reporter', 8);
        });

 
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
};
