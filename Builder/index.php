<?php

class Tree
{
    private $_value;
    private $_left;
    private $_right;

    /**
     * @param integer
     */
    public function __construct($value)
    {
        $this->_value = $value;
    }

    public function getValue()
    {
        return $this->_value;
    }

    /**
     * @return Tree
     */
    public function getLeft()
    {
        return $this->_left;
    }

    public function setLeft(Tree $t)
    {
        $this->_left = $t;
    }

    /**
     * @return Tree
     */
    public function getRight()
    {
        return $this->_right;
    }

    public function setRight(Tree $t)
    {
        $this->_right = $t;
    }


    public function dump()
    {
        $string = '';
        if ($this->_left) {
            $string .= $this->_left->dump();
        }
        $string .= " $this->_value ";
        if ($this->_right) {
            $string .= $this->_right->dump();
        }
        return $string;
    }
}

class DumbUnbalancedTreeBuilder
{
    private $_tree;

    public function reset()
    {
        $this->_tree = null;
    }

    public function addNumber($number)
    {
        $this->_tree = $this->_addTo($this->_tree, $number);
    }

    private function _addTo(Tree $tree = null, $number)
    {
        if ($tree === null) {
            $tree = new Tree($number);
            return $tree;
        }

        if ($number < $tree->getValue()) {
            $tree->setLeft($this->_addTo($tree->getLeft(), $number));
        } else {
            $tree->setRight($this->_addTo($tree->getRight(), $number));
        }
        return $tree;
    }

    public function getTree()
    {
        return $this->_tree;
    }
}


$builder = new DumbUnbalancedTreeBuilder();
$builder->addNumber(7);
$builder->addNumber(1);
$builder->addNumber(3);
$builder->addNumber(5);
$builder->addNumber(8);
$builder->addNumber(6);
$builder->addNumber(9);
$builder->addNumber(5);
$builder->addNumber(4);
$builder->addNumber(2);
echo $builder->getTree()->dump(), "\n";