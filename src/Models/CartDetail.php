<?php

namespace Dell\XuongOop\Models;

use Dell\XuongOop\Commons\Model;

class CartDetail extends Model
{
    protected string $tableName = 'cart_details';

    public function findByCartIDANDProductID($cartID, $productID)
    {
        return $this->queryBuilder
            ->select('*')
            ->from($this->tableName)
            ->where('product_id	 = ?')->setParameter(0, $productID)
            ->where('cart_id	 = ?')->setParameter(1, $cartID)
            ->fetchAssociative();
    }

    public function deleteByCartID($cartID)
    {
        return $this->queryBuilder
            ->delete($this->tableName)
            ->where('cart_id = ?')
            ->setParameter(0, $cartID)
            ->executeQuery();
    }

    public function deleteByCartIDANDProductID($cartID, $productID)
    {
        return $this->queryBuilder
            ->delete($this->tableName)

            ->where('cart_id = ?')->setParameter(0, $cartID)
            ->andWhere('product_id = ?')->setParameter(1, $productID)

            ->executeQuery();
    }
    public function updateByCartIDANDProductID($cartID, $productID, $quantity)
    {
        $query = $this->queryBuilder->update($this->tableName);

        $query
            ->set('quantity', '?')->setParameter(0, $quantity)
            ->where('cart_id = ?')->setParameter(1, $cartID)
            ->andWhere('product_id = ?')->setParameter(2, $productID)
            ->executeQuery();

    }

}