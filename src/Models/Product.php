<?php

namespace Dell\XuongOop\Models;

use Dell\XuongOop\Commons\Model;

class Product extends Model
{
    protected string $tableName = 'products';

    public function allCategories()
    {
        return $this->queryBuilder
            ->select('*')
            ->from('categories')
            ->fetchAllAssociative();
    }

}