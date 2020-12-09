<?php
class Collection {
public $Items = array();
public function add($PK, $Item)
    {
        $this->Items[$PK] = $Item;
    }
    public function remove($PK)
    {
        if(isset($this->Items[$PK]))
        {
            unset($this->Items[$PK]);
        }
    }
    public function get($PK)
    {
        if(isset($this->Items[$PK]))
        {
            return $this->Items[$PK];
        }
    }
    public function count()
    {
        return count($this->Items);
    }   
}
