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

    function __construct($header_info) {
        if (isset($header_info) && !empty($header_info)) {
        // var_dump($header_info);
        if (array_key_exists('name', $header_info)) {
            $this->name = $header_info['name'];
        }
        if (array_key_exists('email', $header_info)) {
            $this->email = $header_info['email'];
        }
        }
        return $this->getHeaderInformation();
    }

    /**
     *  Gets the "Header information" for the Resume
     *
     */
    public function getHeaderInformation() {
        return array(
            'name' => $this->name,
            'email' => $this->email
        );
    }

    /**
     *  Gets the users name
     *  @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     *  Gets the users email
     *  @return string
     */
    public function getEmail() {
        return $this->email;
    }
}