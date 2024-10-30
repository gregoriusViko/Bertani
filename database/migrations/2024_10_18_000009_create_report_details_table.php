
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
            $table->foreignId('report_id')->constrained(
                table:'reports',
                indexName: 'reportDetails_report_id'
            );
            $table->dateTime('report_time');
            $table->dateTime('respose_time');
            $table->text('content_of_report');
            $table->foreignId('admin_id')->constrained(
                table:'admins',
                indexName: 'reportDetails_admin_id'
            );
            $table->text('content_of_response');
            $table->mediumText('img')->charset('binary');
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
