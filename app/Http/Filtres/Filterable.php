<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
trait Filterable
{
    /**
     * @param Builder $builder
     * @param QueryFilter $filter
     */
    public function scopeFilter(Builder $builder, QueryFilter $filter){
        $filter->apply($builder, $this->filterableFields);
    }

    public function getFilterStrings(){
        $filterStrings = [];
        $words = array_filter(explode(' ', request()->get('search-word')));
        foreach ($this->filterableFields as $field){
            $filterStrings[$field] = $this->$field;
            $pattern = '';
            $replacement = '';
            foreach ($words as $key => $word){
                if (stristr($this->$field, $word)) {
                    $pattern = '/(' . str_ireplace(' ',') (', $word) . ')/i';
                    $replacement = '<span class="orange-bg">${1}</span>';
                    $filterStrings[$field] = preg_replace($pattern, $replacement, $filterStrings[$field]);
                }
            }
            if ($filterStrings[$field] == $this->$field){
                unset($filterStrings[$field]);
            }
        }
        if (!isset($filterStrings['title'])){
            $filterStrings = array_merge(['title' => $this->title], $filterStrings);
        }
        return $filterStrings;
    }
}
