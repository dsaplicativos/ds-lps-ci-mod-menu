<?php
include_once APPPATH.'modules/menu/libraries/Navbar.php';

class NavbarModel extends CI_Model{

    public function getHTML($type){
        $navbar = new Navbar();
        $navbar->id('my_navbar');
        $navbar->load($type);
        $navbar->setBackgroundColor('bg-primary');
        $navbar->setTextColor('light');
        $navbar->setToggleSide('left');
        return $navbar->getHTML();
    }

}