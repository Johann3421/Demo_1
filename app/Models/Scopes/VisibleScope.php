<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class VisibleScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        // Solo aplicar el scope fuera del panel de administración
        if (!request()->is('panel*')) {
            $builder->where('visible', true);
        }
    }
}