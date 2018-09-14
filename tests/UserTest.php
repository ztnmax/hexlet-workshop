<?php

namespace ZtnMax\HexletWorkshop\Tests;

use \PHPUnit\Framework\TestCase;
use \ZtnMax\HexletWorkshop\User;

class UserTest extends TestCase
{
    public function testGetName()
    {
        $name = 'john';
        $user = new User($name, [new User('Mark')]);

        $this->assertEquals($name, $user->getName());
    }
}
