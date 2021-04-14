<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class QueryFilter{
    /**
     * @var Builder $builder
     */
    protected $builder;

    public function apply(Builder $builder, array $filterableFields){
        $this->builder = $builder;
        foreach ($filterableFields as $field) {
            $words = array_filter(explode(' ', strtolower(request()->get('search-word'))));
            $this->builder->orWhere(function (Builder $query) use ($words, $field) {
                foreach ($words as $word) {
                    $query->orWhere($field, 'like', "%$word%");
                }
            });
        }
    }
}
