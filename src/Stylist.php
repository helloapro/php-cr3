<?php
    class Stylist
    {
        private $name;
        private $id;

//constructor
        function __construct($name, $id = null)
        {
            $this->name = $name;
            $this->id = $id;
        }

//getters and setters
        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getName()
        {
            return $this->name;
        }

        function getId()
        {
            return $this->id;
        }

//methods
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO stylists(name) VALUES ('{$this->getName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function deleteStylist()
        {
            $GLOBALS['DB']->exec("DELETE FROM stylists WHERE id = $this->id;");
        }

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE stylists SET name = '{$this->name}' WHERE id = {$this->id};");
            $this->setName($new_name);
        }

//static methods
        static function getAll()
        {
            $returned_stylists = $GLOBALS['DB']->query("SELECT * FROM stylists;");
            $stylists = array();
            foreach($returned_stylists as $stylist) {
                $name = $stylist['name'];
                $id = $stylist['id'];
                $new_stylist = new Stylist($name, $id);
                array_push($stylists, $new_stylist);
            }
            return $stylists;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stylists;");
        }

        static function find($stylist_name)
        {
            $stylists = Stylist::getAll();
            $stylist_id = null;
            foreach($stylists as $stylist) {
                if ($stylist->getName() == $stylist_name) {
                    $stylist_id = $stylist->getId();
                }
            }
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients WHERE stylist_id = {$stylist_id};");
            $clients = array();
            foreach($returned_clients as $client) {
                $name = $client['name'];
                $stylist_id = $client['stylist_id'];
                $id = $client['id'];
                $new_client = new Client($name, $stylist_id, $id);
                array_push($clients, $new_client);
            }
            return $clients;
        }
    }
?>
