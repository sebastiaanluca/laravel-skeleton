<?php

declare(strict_types=1);

namespace Modules\Eloquent\Models;

use Modules\DateTime\Models\StandardizesDates;
use Propaganistas\LaravelFakeId\RoutesWithFakeIds;
use SebastiaanLuca\BooleanDates\HasBooleanDates;
use SebastiaanLuca\Flow\Models\Model as EloquentModel;

abstract class Model extends EloquentModel
{
    use PreventsLazyLoading;
    use StandardizesDates;
    use HasBooleanDates;
    use RoutesWithFakeIds;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    /**
     * @return int
     */
    public function getPublicIdAttribute() : int
    {
        return $this->getRouteKey();
    }

    /**
     * Save the model to the database if it doesn't exist yet.
     *
     * @return void
     */
    protected function ensureModelExists() : void
    {
        if ($this->exists) {
            return;
        }

        $this->save();
    }
}
