<?php

class AclModel extends Zend_Acl
{

    function __construct()
    {
        //controllers
        $this->add(new Zend_Acl_Resource('Authentification'));
        $this->add(new Zend_Acl_Resource('Index'));
        $this->add(new Zend_Acl_Resource('Error'));
        $this->add(new Zend_Acl_Resource('Ajax'));
        $this->add(new Zend_Acl_Resource('Test'));
        $this->add(new Zend_Acl_Resource('Lottery'));
        $this->add(new Zend_Acl_Resource('Returns'));
        $this->add(new Zend_Acl_Resource('Administration'));

        //extended roles
        $this->addRole(new Zend_Acl_Role('guest'));
        $this->addRole(new Zend_Acl_Role('user'), 'guest');
        //roles.
        $this->allow('guest', 'Authentification');
        $this->allow('guest', 'Error');
        $this->allow('guest', 'Test');
        $this->allow('guest', 'Administration');
        $this->allow('guest', 'Lottery');
        $this->allow('guest', 'Returns');
        $this->allow('user', 'Index');
        $this->allow('user', 'Ajax');


    }

}
