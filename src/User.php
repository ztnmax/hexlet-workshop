<?php

namespace Php\Package;

use Illuminate\Support\Collection;

class User
{
    private $name;

    public function __construct($name, $children = [])
    {
        $this->name = $name;
        $this->children = collect($children);
    }

    public function getName()
    {
        return $this->name;
    }

    public function getChildren()
    {
        return $this->name;
    }
}
