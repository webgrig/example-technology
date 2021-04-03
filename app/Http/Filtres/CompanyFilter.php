<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class CompanyFilter extends QueryFilter
{

//    /**
//     * @param string $phone
//     */
//    public function phone(string $phone)
//    {
//        $this->builder->where('phone', strtolower($phone));
//    }

    /**
     * @param string $title
     */
    public function title(string $title)
    {
        $words = array_filter(explode(' ', $title));

        $this->builder->orWhere(function (Builder $query) use ($words) {
            foreach ($words as $word) {
                $query->orWhere('title', 'like', "%$word%");
            }
        });
    }

    /**
     * @param string $phone
     */
    public function phone(string $phone)
    {
        $words = array_filter(explode(' ', $phone));
        $this->builder->orWhere(function (Builder $query) use ($words) {
            foreach ($words as $word) {
                $query->orWhere('phone', 'like', "%$word%");
            }
        });
    }
    public function email(string $email)
    {
        $words = array_filter(explode(' ', $email));
        $this->builder->orWhere(function (Builder $query) use ($words) {
            foreach ($words as $word) {
                $query->orWhere('email', 'like', "%$word%");
            }
        });
    }
}
