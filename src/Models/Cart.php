<?php

namespace Dell\XuongOop\Models;

use Dell\XuongOop\Commons\Model;

class Cart extends Model
{
    protected string $tableName = 'carts';

    public function findByUserID($userid)
    {
        return $this->queryBuilder
            ->select('*')
            ->from($this->tableName)
            ->where('user_id = ?')
            ->setParameter(0, $userid)
            ->fetchAssociative();
    }

    

}