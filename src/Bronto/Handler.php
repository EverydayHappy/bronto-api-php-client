<?php

class Bronto_Handler {

    /**
     * @var Bronto_Api
     */
    private $brontoAPI;

    /**
     * @param string $token
     * @throws Bronto_Api_Exception
     */
    public function __construct($token)
    {
        $this->brontoAPI = new Bronto_Api();
        $this->brontoAPI->setToken($token);
        $this->brontoAPI->login();
    }

    /**
     * @param string $email
     * @param string $list
     */
    public function addEmailToList($email, $list)
    {
        $contactObject = $this->brontoAPI->getContactObject();
        $contact = $contactObject->createRow(array());
        $contact->email  = $email;
        $contact->status = \Bronto_Api_Contact::STATUS_ONBOARDING;
        $contact->addToList($list);
        try {
            $contact->save();
        } catch (Exception $e) {
            print_r($e);
        }
    }


}