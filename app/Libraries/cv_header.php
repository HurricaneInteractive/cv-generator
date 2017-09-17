<?php

/**
*   CV 'Header' class:
*   This class contains information regarding the users personal information for the resume.
*   @todo Integrate with User system to auto-fill values
**/

namespace App\Libraries;

class CV_Header
{
/**
    *   Name of user
    *   @var string
    */
    private $name;
     
    /**
    *   Email of user
    *   @var string
    */
    private $email;
 
    /**
    *   Phone number of user
    *   @var string
    */
    private $phone_number;
 
    /**
    *   Address of user
    *   @var string
    */
    private $address; 
 
    /**
    *   Date of birth of user
    *   @todo implement DOB in form
    *   @var date
    */
    private $date_of_birth;
 
    /**
    *   Personal website of user
    *   @var string
    */
    private $personal_website;

    /**
    *   Initializes the class
    *   Uses information passed to it by the CV_PDF class
    *   @see CV_PDF
    *   @return the information as an array
    */
    function __construct($header_info) {
        if (isset($header_info) && !empty($header_info)) {
            if (array_key_exists('name', $header_info)) {
                $this->setName($header_info['name']);
            }
            if (array_key_exists('email', $header_info)) {
                $this->setEmail($header_info['email']);
            }
            if (array_key_exists('phone_number', $header_info)) {
                $this->setPhoneNumber($header_info['phone_number']);
            }
            if (array_key_exists('address', $header_info)) {
                $this->setAddress($header_info['address']);
            }
            if (array_key_exists('personal_website', $header_info)) {
                $this->setPersonalWebsite($header_info['personal_website']);
            }
        }
        return $this->getHeaderInformation();
    }

    /**
     *  Gets the "Header information" for the Resume
     *  @return array
     */
    public function getHeaderInformation() {
        return array(
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'personal_website' => $this->personal_website
        );
    }

    /**
    *   Sets the $name variable based on user input
    *   @param string $name
    *   @return string
    */
    public function setName($name) {
        if ($name != '' && $name != NULL) {
            $this->name = $name;
        }
        return $this;   
    }

    /**
    *   Sets the $email variable based on user input
    *  @param string $email
    *  @return string
    */
    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    /**
    *   Sets the $phone_number variable based on user input
    *  @param string $phone_number
    *  @return string
    */
    public function setPhoneNumber($phone_number) {
        $this->phone_number = $phone_number;
        return $this;
    }

    /**
    *   Sets the $address variable based on user input
    *  @param string $address
    *  @return string
    */
    public function setAddress($address) {
        $this->address = $address;
        return $this;
    }

    /**
    *   Sets the $personal_website variable based on user input
    *  @param string $website
    *  @return string
    */
    public function setPersonalWebsite($website) {
        $this->personal_website = $website;
        return $this;
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

    /**
    *  Gets the users phone number
    *  @return string
    */
    public function getPhoneNumber() {
        return $this->phone_number;
    }

    /**
    *  Gets the users address
    *  @return string
    */
    public function getAddress() {
        return $this->address;
    }

    /**
    *  Gets the users personal website
    *  @return string
    */
    public function getPersonalWebsite() {
        return $this->personal_website;
    }
}