<?php
include_once APPPATH.'modules/menu/libraries/Navbar.php';

class NavbarModel extends CI_Model{

    public function getHTML($type){
        $navbar = new Navbar();
        $navbar->id('my_navbar');
        $navbar->load($type);
        return $navbar->getHTML();
    }

}