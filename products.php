<?php

class Product
{

    public $productArray = [
        [
            'id' => '1',
            'name' => 'Apple',
            'price' => 4.95
        ],
        [
            'id' => '2',
            'name' => 'Orange',
            'price' => 3.99
        ]
    ];

    public function getAllProduct()
    {
        return $this->productArray;
    }

    public function checkProductInCart($array = array())
    {
        if($array){
            $fileContents = file_get_contents('json_array.txt');
            $arrayCart = json_decode($fileContents, true);
            foreach ($arrayCart as $cart) {
                if($cart['nameProduct'] == $array['nameProduct']){
                    return 1;
                }
            }
        }
        return 0;
    }
}