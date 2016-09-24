<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once 'src/Client.php';

    $server = 'mysql:host=localhost;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ClientTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Client::deleteAll();
        }

        function test_getName()
        {
            //arrange
            $name = "Liza Dogooder";
            $test_client = new Client($name, 3);
            //act
            $result = $test_client->getName();
            //assert
            $this->assertEquals($name, $result);
        }

        function test_getId()
        {
            //arrange
            $name = "Liza Dogooder";
            $id = 1;
            $test_client = new Client($name, 3, $id);
            //act
            $result = $test_client->getId();
            //assert
            $this->assertEquals($id, $result);
        }

        function test_save()
        {
            //arrange
            $name = "Liza Dogooder";
            $test_client = new Client($name, 3);
            $test_client->save();
            $name2 = "April Peng";
            $test_client2 = new Client($name2, 1);
            $test_client2->save();
            //act
            $result = Client::getAll();
            //assert
            $this->assertEquals([$test_client, $test_client2], $result);

        }

        function test_getAll()
        {
            //arrange
            $name = "Liza Dogooder";
            $name2 = "April Peng";
            $test_client = new Client($name, 3);
            $test_client->save();
            $test_client2 = new Client($name2, 1);
            $test_client2->save();
            //act
            $result = Client::getAll();
            //assert
            $this->assertEquals([$test_client,$test_client2],$result);
        }

        function test_edited_client()
        {
            //arrange
            $name = "Liza Dogooder";
            $test_client = new Client($name, 3);
            //act
            $updated_name = "Liza Danger";
            $test_client = new Client($updated_name, 3);
            //assert
            $this->assertEquals($updated_name,$test_client->getName());
        }

        function test_deleteClient()
        {
            //arrange
            $name = "Liza Danger";
            $name2 = "April Peng";
            $test_client = new Client($name, 3);
            $test_client->save();
            $test_client2 = new Client($name, 1);
            $test_client2->save();
            //act
            $test_client->deleteClient();
            $result_clients = Client::getAll();
            //assert
            $this->assertEquals([$test_client2], $result_clients);
        }
    }
?>
