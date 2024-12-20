
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
        
        Schema::dropIfExists('report_details');
        Schema::create('report_details', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->foreignId('report_id')->constrained(
                table:'reports',
                indexName: 'reportDetails_report_id'
            )->onDelete('cascade');
            $table->dateTime('report_time');
            $table->dateTime('response_time')->nullable();
            $table->text('content_of_report');
            $table->foreignId('admin_id')->nullable()->constrained(
                table:'admins',
                indexName: 'reportDetails_admin_id'
            );
            $table->text('content_of_response')->nullable();
            $table->string('img', 150)->nullable();
        });
 
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('report_details');
    }
};
