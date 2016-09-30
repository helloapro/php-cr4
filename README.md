# Local Store - Shoe Directory #

#### An application to practice BDD in PHP, September 15th, 2016

#### By April Peng

## Description ##

This application let's users search local shoe stores for specific brands and brands stocked in local stores.

## Setup/Installation Instructions ##

* Clone the repository
* Using the command line, navigate to the project's root directory
* Install dependencies by running $ composer install
* Navigate to the /web directory and start a local server with $ php -S localhost:8000
* Open a browser and go to the address http://localhost:8000 to view the application

## Specifications ##

* Get and set a name of a store.
    * input: "Solestruck"
    * output: "Solestruck"

* Confirm that the store id is set as a numeric parameter when assigned an integer.
    * input: "1"
    * output: value equals and integer

* Add, save, and get a store within the database.
    * input: "Solestruck", "1"
    * output: "Solestruck", "1"

* Completely delete stores within the database.
    * input: delete all
    * output: ""

* Get a name of a shoe brand and confirm its id is set as a numeric parameter when assigned an integer.
    * input: "Keen", "1"
    * output: "Keen", value equals an integer

* Add, save, and get a brand within the database.
    * input: "Keen", "1"
    * output: "Keen", "1"

* Completely delete brands within the database.
    * input: delete all
    * output: ""



## Known Bugs ##

There are no known bugs at this time.

## Support and Contact Details ##

Please report any bugs or issues helloaprilpeng@gmail.com.

## Languages/Technologies Used ##

* PHP
* Silex
* Twig

### License ###

*This application is licensed under the MIT license.*

Copyright (c) 2016 April Peng
