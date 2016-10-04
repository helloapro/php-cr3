<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once 'src/Stylist.php';
    require_once 'src/Client.php';

    $server = 'mysql:host=localhost;dbname=hair_salon_test';
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

        function test_update()
        {
            //arrange
            $name = "Mary Hannah";
            $test_stylist = new Stylist($name);
            $test_stylist->save();
            //act
            $new_name = "Mary Hannah Little Lamb";
            $test_stylist->update($new_name);
            //assert
            $this->assertEquals($new_name, $test_stylist->getName());
        }

        function test_deleteStylist()
        {
            //arrange
            $stylist_name = "Mary Hannah";
            $stylist_name2 = "Leah Electric";
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            $test_stylist2 = new Stylist($stylist_name2);
            $test_stylist2->save();
            $client_name = "Liza Danger";
            $client_name2 = "April Peng";
            $test_client = new Client($client_name, 3);
            $test_client->save();
            $test_client2 = new Client($client_name2, 1);
            $test_client2->save();
            //act
            $test_stylist->deleteStylist();
            $result_stylists = Stylist::getAll();
            //assert
            $this->assertEquals([$test_stylist2], $result_stylists);
        }

        function test_find()
        {
            //arrange
            $stylist_name = "Mary Hannah";
            $stylist_name2 = "Leah Electric";
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            $test_stylist2 = new Stylist($stylist_name2);
            $test_stylist2->save();
            //act
            $result = Stylist::find($test_stylist->getId());
            //assert
            $this->assertEquals($test_stylist, $result);
        }

        // function test_find()
        // {
        //     //arrange
        //     $stylist_name = "Mary Hannah";
        //     $stylist_name2 = "Leah Electric";
        //     $test_stylist = new Stylist($stylist_name);
        //     $test_stylist->save();
        //     $test_stylist2 = new Stylist($stylist_name2);
        //     $test_stylist2->save();
        //     $test_stylist_id = $test_stylist->getId();
        //     $test_stylist2_id = $test_stylist2->getId();
        //     $client_name = "Liza Danger";
        //     $client_name2 = "April Peng";
        //     $test_client = new Client($client_name, $test_stylist_id);
        //     $test_client->save();
        //     $test_client2 = new Client($client_name2, $test_stylist2_id);
        //     $test_client2->save();
        //
        //     //act
        //     $result = Stylist::find($stylist_name2);
        //     //assert
        //     $this->assertEquals([$test_client2], $result);
        // }
    }
?>
