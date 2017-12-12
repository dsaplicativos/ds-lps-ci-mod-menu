<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH . 'modules/menu/libraries/Menu.php';
include_once APPPATH . 'controllers/test/builder/TestDataBuilder.php';

class NavbarDB extends TestDataBuilder{

    function __construct($db = null){
        parent::__construct($db);
    }
    
    /**
     * Configura a tabela que será usada como base para os testes.
     */
    public function build(){
        $fields = Menu::getTableFields();
        $tableBuilder = new BDTableBuilder('menu');
        $tableBuilder->setTableData($fields);
        $tableBuilder->createTable();
        $tableBuilder->unique(Menu::unique());

        $this->initData();
    }

    /**
     * Preenche a tabela sob teste com dados iniciais.
     */
    private function initData(){
        $data = array(
            // menu publico
            array('label' => 'Sobre', 'name' => 'sobre', 'visitante' => 1), 
            array('label' => 'Servi&ccedil;os', 'name' => 'servico', 'visitante' => 1), 
            array('label' => 'Dentistas', 'name' => 'dentista', 'visitante' => 1), 
            array('label' => 'Como Chegar', 'name' => 'como', 'visitante' => 1), 
            array('label' => 'Contato', 'name' => 'contato', 'visitante' => 1)
        );

        foreach ($data AS $row) $this->db->insert('menu', $row);
    }

}