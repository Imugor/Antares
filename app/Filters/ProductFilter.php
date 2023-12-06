<?php

namespace App\Filters;

class ProductFilter extends QueryFilter{
    public function low_price($price=0) {
        return $this->builder->where("price", '>=', $price);
    }
    public function hight_price($price=1000000000000) {
        return $this->builder->where("price", '<=', $price);
    }
}