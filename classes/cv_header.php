<?php

class CV_Header
{
    /**
     *   Name of user
     *
     *   @var string
     */
     private $name = 'default';
     
     /**
      *   Email of user
      *
      *   @var string
      */
     private $email;
 
     /**
      *   Phone number of user
      *
      *   @var integer
      */
     private $phone_number;
 
     /**
      *   Address of user
      *
      *   @var string
      */
     private $address; 
 
     /**
      *   Date of birth of user
      *
      *   @var date
      */
     private $date_of_birth;
 
     /**
      *   Personal website of user
      *
      *   @var string
      */
     private $personal_website;

     function __construct() {
         return array(
             $this->name
         );
     }
}