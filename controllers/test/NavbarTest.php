<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH.'modules/menu/libraries/Navbar.php';
require_once(APPPATH.'controllers/test/MyToast.php');
require_once('builder/NavbarDB.php');

class NavbarTest extends MyToast {

    function __construct(){
        parent::__construct('navbar');
        $builder = new NavbarDB();
        $builder->reset();
        $builder->build();
    }

    function test_carrega_menu_publico(){
        $nav = new Navbar();
        $v = $nav->getMenuList();
        $k = sizeof($v);
        $this->_assert_equals(5, $k, "Esperado: 5, Recebido: $k");
        $this->_assert_equals('sobre', $v[0]['name'], "Esperado: sobre, Recebido: {$v[0]['name']}");
        $this->_assert_equals('contato', $v[4]['name'], "Esperado: contato, Recebido: {$v[4]['name']}");
    }

}