<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElevatorsTriggers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        DB::unprepared('drop trigger if exists arrived_elevator on elevators;');
        DB::unprepared('drop trigger if exists new_destination on elevators;');
        DB::unprepared('drop function if exists mark_arrived_elevator();');
        DB::unprepared('drop function if exists select_new_destination();');

        $sql = 'create function mark_arrived_elevator() returns trigger language plpgsql as ';
        $sql .= '$BODY$ ';
        $sql .= 'declare orderId int; ';
        $sql .= 'begin ';
        $sql .= 'select id into orderId from orders where elevator_id = new.id and floor = new.floor and arrived_at is null limit 1; ';
        $sql .= 'if orderId is not null then ';
        $sql .= 'update orders set arrived_at = current_timestamp(0) where id = orderId; ';
        $sql .= 'end if; ';
        $sql .= 'return new; ';
        $sql .= 'end; ';
        $sql .= '$BODY$';

        DB::unprepared($sql);

        $sql = 'create trigger arrived_elevator ';
        $sql .= 'after update on elevators for each row ';
        $sql .= 'execute procedure mark_arrived_elevator();';

        DB::unprepared($sql);

        $sql = 'create function select_new_destination() returns trigger language plpgsql as ';
        $sql .= '$BODY$ ';
        $sql .= 'declare moveTo int; ';
        $sql .= 'begin ';
        $sql .= 'if new.move_to is not null then return new; end if; ';
        $sql .= 'select floor into moveTo from orders where elevator_id = new.id and arrived_at is null limit 1; ';
        $sql .= 'if moveTo is not null and new.floor <> moveTo then new.move_to := moveTo; end if; ';
        $sql .= 'return new; ';
        $sql .= 'end; ';
        $sql .= '$BODY$';

        DB::unprepared($sql);

        $sql = 'create trigger new_destination ';
        $sql .= 'before update on elevators for each row ';
        $sql .= 'execute procedure select_new_destination();';

        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        DB::unprepared('drop trigger if exists arrived_elevator on elevators;');
        DB::unprepared('drop trigger if exists new_destination on elevators;');
        DB::unprepared('drop function if exists mark_arrived_elevator();');
        DB::unprepared('drop function if exists select_new_destination();');
    }
}
