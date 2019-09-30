<?php

use Illuminate\Database\Migrations\Migration;

class CreateOrdersTriggers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        DB::unprepared('drop trigger if exists elevator_for_new_order on orders;');
        DB::unprepared('drop trigger if exists elevator_iteration on orders;');
        DB::unprepared('drop function if exists select_elevator_for_new_order();');
        DB::unprepared('drop function if exists set_elevator_iteration();');

        $sql = 'create function select_elevator_for_new_order() returns trigger language plpgsql as ';
        $sql .= '$BODY$ ';
        $sql .= 'declare elevatorId int; ';
        $sql .= 'begin ';
        $sql .= 'if new.elevator_id is not null then return new; end if; ';
        $sql .= 'select id into elevatorId from elevators where floor > new.floor and move_to <= new.floor order by abs(floor - new.floor) limit 1; ';
        $sql .= 'if elevatorId is null then ';
        $sql .= 'select id into elevatorId from elevators where move_to is null order by abs(floor - new.floor) limit 1; ';
        $sql .= 'end if; ';
        $sql .= 'if elevatorId is null then ';
        $sql .= 'select id into elevatorId from elevators order by abs(move_to - new.floor); ';
        $sql .= 'end if; ';
        $sql .= 'update elevators set move_to = new.floor where id = elevatorId and move_to is null; ';
        $sql .= 'new.elevator_id := elevatorId; ';
        $sql .= 'return new; ';
        $sql .= 'end; ';
        $sql .= '$BODY$';

        DB::unprepared($sql);

        $sql = 'create trigger elevator_for_new_order ';
        $sql .= 'before insert on orders for each row ';
        $sql .= 'execute procedure select_elevator_for_new_order();';

        DB::unprepared($sql);

        $sql = 'create or replace function set_elevator_iteration() returns trigger language plpgsql as ';
        $sql .= '$BODY$ ';
        $sql .= 'declare prevFloor int; prevPrevFloor int; prevIteration int; ';
        $sql .= 'begin ';
        $sql .= 'select orders.floor, (';
        $sql .= 'select floor from orders o where o.elevator_id = orders.elevator_id and o.arrived_at < orders.arrived_at order by o.arrived_at desc limit 1';
        $sql .= '), orders.iteration ';
        $sql .= 'into prevFloor, prevPrevFloor, prevIteration from orders ';
        $sql .= 'where elevator_id = new.elevator_id and arrived_at < new.arrived_at order by arrived_at desc limit 1; ';
        $sql .= 'if prevIteration is null then prevIteration := 1; end if; ';
        $sql .= 'new.iteration := prevIteration; ';
        $sql .= 'if (prevPrevFloor < prevFloor and prevFloor > new.floor) or (prevPrevFloor > prevFloor and prevFloor < new.floor) then ';
        $sql .= 'new.iteration := prevIteration + 1; ';
        $sql .= 'end if; ';
        $sql .= 'return new; ';
        $sql .= 'end; ';
        $sql .= '$BODY$';

        DB::unprepared($sql);

        $sql = 'create trigger elevator_iteration ';
        $sql .= 'before update on orders for each row ';
        $sql .= 'execute procedure set_elevator_iteration();';

        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        DB::unprepared('drop trigger if exists elevator_for_new_order on orders;');
        DB::unprepared('drop trigger if exists elevator_iteration on orders;');
        DB::unprepared('drop function if exists select_elevator_for_new_order();');
        DB::unprepared('drop function if exists set_elevator_iteration();');
    }
}
