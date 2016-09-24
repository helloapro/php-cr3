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
            $GLOBALS['DB']->exec("UPDATE stylists SET name = '{$this->name}' WHERE id = {$this->id};");
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

        function getStylistById($id)
        {
            $get_stylist_by_id = null;
            $stylists = Stylist::getAll();
            foreach($stylists as $stylist) {
                $stylist_id = $stylist->getId();
                if ($stylist_id == $id) {
                    $get_stylist_by_id = $stylist;
                }
            }
            return $get_stylist_by_id;
        }

        function deleteStylist()
        {
            $GLOBALS['DB']->exec("DELETE FROM stylists WHERE id = $this->id;");
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
    }
?>
