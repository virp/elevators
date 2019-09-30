<?php

use Illuminate\Database\Migrations\Migration;

class CreateStatsView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        DB::unprepared('drop view if exists stats;');

        $sql = 'create view stats as ';
        $sql .= 'select elevator_id, floor, count(*) as visits from orders group by elevator_id, floor order by elevator_id, floor';

        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        DB::unprepared('drop view if exists stats;');
    }
}
