<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
include_once APPPATH . 'libraries/util/ORMObject.php';
include_once 'MenuItem.php';


class Menu extends ORMObject{
    private $menu;
    private $item_list;
    private $group = '';
    private $toggle = '';
    private $extra_data = '';
    private $extra_content = '';

    function __construct($menu){
        parent::__construct('menu');
        $this->menu = $menu;
        $this->loadItens();
    }

    /**
     * Retorna os itens deste menu
     */
    public function getHTML($active = ''){
        $html = '<li class="nav-item '.$active.' '.$this->group.'">';
        $html .= '<a href="'.$this->menu['link'].'" class="nav-link '.$this->toggle.'" '.$this->extra_data.'>'.$this->menu['label'].'</a>';
        $html .= $this->extra_content;
        return $html.'</li>';
    }

    /**
     * Carrega os itens deste menu
     */
    private function loadItens(){
        $v = array('parent' => $this->menu['id']);
        $u = $this->dao->getWhere($v, true);
        $this->item_list = $u;

        if(sizeof($u) == 0) return;
        $this->toggle = 'dropdown-toggle';
        $this->extra_data = 'id="dropdown_'.$this->menu['id'].'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"';
        $html = '<div class="dropdown-menu" aria-labelledby="dropdown_'.$this->menu['id'].'">';
        foreach($u AS $item){
            $menuitem = new MenuItem($item);
            $html .= $menuitem->getHTML();
        }
        $this->extra_content = $html.'</div>';
    }

    /**
     * Retorna a lista de itens deste menu
     */
    public function getItemList(){
        return $this->item_list;
    }

    /**
     * Retorna a lista de colunas que devem constar da tabela menu no bd
     */
    public static function getTableFields(){
        return array(
            'label' => array(
                'type' => 'VARCHAR',
                'constraint' => '50'
            ),
            'name' => array( // pessoa física: 0, pessoa jurídica: 1
                'type' => 'VARCHAR',
                'constraint' => '30'
            ),
            'icon' => array(
                'type' => 'VARCHAR',
                'constraint' => '60',
				'null'       => TRUE
            ),
            'parent' => array(
                'type' => 'INT',
                'constraint' => '6',
                'default' => 0
            ),
            'menu_order' => array(
                'type' => 'INT',
                'constraint' => '6',
                'default' => 0
            ),
            'admin' => array(
                'type' => 'INT',
                'constraint' => '6',
                'default' => 0
            ),
            'diretor' => array(
                'type' => 'INT',
                'constraint' => '6',
                'default' => 0
            ),
            'dentista' => array(
                'type' => 'INT',
                'constraint' => '6',
                'default' => 0
            ),
            'atendente' => array(
                'type' => 'INT',
                'constraint' => '6',
                'default' => 0
            ),
            'paciente' => array(
                'type' => 'INT',
                'constraint' => '6',
                'default' => 0
            ),
            'visitante' => array(
                'type' => 'INT',
                'constraint' => '6',
                'default' => 0
            )
        );
    }

    /**
     * Retorna os nomes das tabelas que devem fazer parte da restrição unique para a tabela menu
     */
    public static function unique(){
        return 'name, parent';
    }

    public function getObjectData(){}

}