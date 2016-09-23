<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once 'src/Stylist.php';

    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StylistTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Stylist::deleteAll();
        }

        function test_getName()
        {
            //arrange
            $name = "Mary Hannah";
            $test_stylist = new Stylist($name);
            //act
            $result = $test_stylist->getName();
            //assert
            $this->assertEquals($name, $result);
        }

        function test_getId()
        {
            //arrange
            $name = "Mary Hannah";
            $id = 1;
            $test_stylist = new Stylist($name, $id);
            //act
            $result = $test_stylist->getId();
            //assert
            $this->assertEquals($id, $result);
        }

        
    }
?>
