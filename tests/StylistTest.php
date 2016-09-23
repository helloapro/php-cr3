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

        function test_save()
        {
            //arrange
            $name = "Mary Hannah";
            $test_stylist = new Stylist($name);
            $test_stylist->save();
            //act
            $result = Stylist::getAll();
            //assert
            $this->assertEquals($test_stylist, $result[0]);
        }

        function test_getAll()
        {
            //arrange
            $name = "Mary Hannah";
            $name2 = "Leah Electric";
            $test_stylist = new Stylist($name);
            $test_stylist->save();
            $test_stylist2 = new Stylist($name);
            $test_stylist2->save();
            //act
            $result = Stylist::getAll();
            //assert
            $this->assertEquals([$test_stylist,$test_stylist2],$result);
        }

        function test_edited_stylist()
        {
            //arrange
            $name = "Mary Hannah";
            $updated_name = "Mary Hannah Little Lamb";
            $test_stylist = new Stylist($name);
            $test 
            //act
            $result = Stylist::getAll();
            //assert
            $this->assertEquals([$test_stylist,$test_stylist2],$result);
        }
    }
?>
