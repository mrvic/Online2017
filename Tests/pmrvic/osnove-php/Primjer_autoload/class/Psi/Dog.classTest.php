<?php

namespace Psi;
include 'Dog.class.php';
/**
 * Generated by PHPUnit_SkeletonGenerator on 2017-12-20 at 20:45:05.
 */
class DogTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Dog
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        echo "<br>obrisi sve prijasnje verzije pasa.";
        $this->object = new Dog;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        echo "<br>testirali smo ".__CLASS__;
    }

    /**
     * @covers Psi\Dog::says
     * @todo   Implement testSays().
     */
    public function testSays() {
        // Remove the following lines when you implement this test.
        $this->assertTrue(TRUE);
        $this->assertEquals(\Psi\Dog::says(),NULL);
    }

}
