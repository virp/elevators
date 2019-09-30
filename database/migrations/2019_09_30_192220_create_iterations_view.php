<?php

use Illuminate\Database\Migrations\Migration;

class CreateIterationsView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        DB::unprepared('drop view if exists iterations');

        $sql = 'create view iterations as ';
        $sql .= "select elevator_id, iteration, string_agg(floor::character varying, ' > ' order by arrived_at) as floors ";
        $sql .= 'from orders group by elevator_id, iteration order by iteration desc;';

        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        DB::unprepared('drop view if exists iterations');
    }
}
