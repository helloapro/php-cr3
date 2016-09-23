# Salon #

#### Code review application to practice BDD in PHP, September 2016

#### By April Peng

## Description ##

This application allows users to add stylists as well as add clients under each stylist.

## User Setup/Installation Instructions ##

* Clone git repository
* Using the command line, navigate to the project's root directory
* Install dependencies by running $ composer install
* Navigate to the /web directory and start a local server with $ php -S localhost:8000
* Open a browser and go to the address http://localhost:8000 to view the application

## Specifications ##
* Add, save, and get a Stylist.
    * input1: "Mary Hannah"
    * output: "Mary Hannah"

* Delete all Stylists.
    * input: clear all stylists
    * output: ""

* Edit a Stylist.
    * input: patch "Mary Hannah" to "Mary Hannah Little Lamb"
    * output: "Mary Hannah Little Lamb"

* Delete a Stylist.
    * input: delete "Mary Hannah Little Lamb"
    * output: ""

* Add, save, and get a Client.
    * input: "Liza Dogooder"
    * output: "Liza Dogooder"

* Delete all Clients.
    * input: clear all clients
    * output: ""

* Edit a Client.
    * input: patch "Liza Dogooder" to "Liza Danger"
    * output: "Liza Danger"

* Delete a Client.
    * input: delete "Liza Danger"
    * output: ""

* Return clients for a specific stylist.
    * input: "Mary Hannah"
    * output: ["April Peng", "Craig Campbell", "Brienne Butte"]

## Known Bugs ##

There are no known bugs at this time.

## Languages/Technologies Used ##

* PHP
* Silex
* Twig

### License ###

*This application is licensed under the MIT license.*

Copyright (c) 2016 April Peng
