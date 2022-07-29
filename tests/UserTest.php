<?php
// Noah Gestiehr
// NKU - CSC299 - Summer 2022
// Class test file for the user object unit tests

use PHPUnit\Framework\TestCase;

final class UserTest extends TestCase
{
    public function testClassConstructor()
    {
        $user = new User('John Smith', 'john@roanoke.va', '123 Main Street', 'Roanoke', 'VA', '24012');

        $this->assertSame('John Smith', $user->name);
        $this->assertSame('john@roanoke.va', $user->email);
        $this->assertSame('123 Main Street', $user->street);
        $this->assertSame('Roanoke', $user->city);
        $this->assertSame('VA', $user->state);
        $this->assertSame('24012', $user->zip);
        $this->assertSame('John Smith', $user->getName());
        $this->assertSame('john@roanoke.va', $user->getEmail());
        $this->assertSame('123 Main Street', $user->getStreet());
        $this->assertSame('Roanoke', $user->getCity());
        $this->assertSame('VA', $user->getState());
        $this->assertSame('24012', $user->getZip());
        $this->assertFalse($user->admin);
        $this->assertFalse($user->isAdmin());
        $this->assertNull($user->getOrders());
    }

}