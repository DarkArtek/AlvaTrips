<?php

use App\Contracts\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateAlvaTripTemplatesTable
 */
class CreateAlvaTripTemplatesTable extends Migration
{
    /**
     * Run migrations.
     *
     * @return void
     */
    public function up()
    {
        // Trip Templates
        if (!Schema::hasTable('alva_trip_templates')) {
            Schema::create('alva_trip_templates', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->boolean('visible')->default(true); // is visible to anyone?
                $table->longText('description')->nullable();
                $table->integer('type')->nullable();
                $table->json('data'); // List of all the flights to be generated for this trip.
                $table->date('starting_at')->nullable();
                $table->date('ending_at')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }
        // Allow trip to be duplicated by another user, so they can fly a similar trip.
        if (Schema::hasTable('alva_trip_templates') && !Schema::hasColumn('alva_trip_templates', 'can_duplicate')) {
            Schema::table('alva_trip_reports', function (Blueprint $table) {
                $table->boolean('can_duplicate');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alva_trip_templates');
    }
}
