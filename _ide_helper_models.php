<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Elevator
 *
 * @property int $id
 * @property int $floor
 * @property int|null $move_to
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Elevator inMotion()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Elevator newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Elevator newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Elevator onFloor($floor)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Elevator query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Elevator whereFloor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Elevator whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Elevator whereMoveTo($value)
 */
	class Elevator extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Order
 *
 * @property int $id
 * @property int $floor
 * @property \Illuminate\Support\Carbon $ordered_at
 * @property int|null $elevator_id
 * @property \Illuminate\Support\Carbon|null $arrived_at
 * @property int|null $iteration
 * @property-read \App\Models\Elevator|null $elevator
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order completed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order pending()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereArrivedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereElevatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereFloor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereIteration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOrderedAt($value)
 */
	class Order extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Stat
 *
 * @property int|null $elevator_id
 * @property int|null $floor
 * @property int|null $visits
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Stat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Stat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Stat query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Stat whereElevatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Stat whereFloor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Stat whereVisits($value)
 */
	class Stat extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Iteration
 *
 * @property int|null $elevator_id
 * @property int|null $iteration
 * @property string|null $floors
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Iteration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Iteration newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Iteration query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Iteration whereElevatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Iteration whereFloors($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Iteration whereIteration($value)
 */
	class Iteration extends \Eloquent {}
}

