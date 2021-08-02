<?php
namespace App\Models\Traits;

use Illuminate\Support\Str;


trait HasUuid
{
    protected $uuidField = 'uuid';

    public static function boot()
    {
        parent::boot();

        self::creating(function($model) {
            $model->{$model->uuidField} = Str::uuid();
        });
    }
}
