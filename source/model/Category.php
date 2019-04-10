<?php

class Model_Category extends DB_Model {

    public $nomeTabela = "category";
    public $chavePrimaria = "cid";

    public function hasChildren() {
        $ModelCategory = new Model_Category;
        $ModelCategory->where("parent = " . $this->getId());
        $this->children = $ModelCategory->getRows();

        return $this->children;
    }

    public function findParent($master = 0) {

        
        if (is_object($this->parent)) {
            if (is_object($this->parent) && $this->parent->cid == $master)
                return $this;
            if (is_object($this->parent->parent) && $this->parent->parent->cid == $master)
                return $this->parent;
            
            return $this->parent->findParent($master);
        }


        if ($this->parent == 0)
            return $this;

        $mc = new Model_Category;
        $this->parent = $mc->getById($this->parent);
        
        if($this->parent->parent == $master) return $this->parent;
        
        return $this->parent->findParent($master);
    }

}
