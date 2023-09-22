<?php

namespace App\Models;
use CodeIgniter\Model;




class ProductModel extends Model
{
    protected $table = 'table_products';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'Name',
        'Description',
        'Category',
        'Price',
        'Quantity'
    ];
}

?>