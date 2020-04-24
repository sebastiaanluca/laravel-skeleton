<?php

declare(strict_types=1);

namespace Modules\Eloquent\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Modules\DateTime\Models\StandardizesDates;
use Propaganistas\LaravelFakeId\RoutesWithFakeIds;
use SebastiaanLuca\BooleanDates\HasBooleanDates;

abstract class Model extends EloquentModel
{
    use PreventsLazyLoading;
    use StandardizesDates;
    use HasBooleanDates;
    use RoutesWithFakeIds;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    /**
     * Fill the model with an array of attributes. Does not set data if the
     * model already has data for it.
     *
     * @param array $attributes
     *
     * @return \SebastiaanLuca\Flow\Models\Model
     */
    public function fillIfMissing(array $attributes) : self
    {
        $attributes = collect($attributes)
            ->reject(function ($attribute, $field) {
                return in_array($field, $this->attributes, true);
            })
            ->all();

        return $this->fill($attributes);
    }

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
