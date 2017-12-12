<?php
include_once APPPATH . 'libraries/util/ORMObject.php';
include_once APPPATH . 'modules/menu/libraries/Menu.php';

class Navbar extends ORMObject{
    private $db;
    private $id = '';
    private $title = 'Dentalbit';
    private $menu_list = array();

    public function __construct(){
        parent::__construct('menu');
    }

    public function load($type){
        $v[$type] = 1;
        $v['parent'] = 0;
        $rs = $this->dao->getWhere($v, true);
        $this->menu_list = $rs;
    }

    public function getMenuList(){
        return $this->menu_list;
    }

    public function id($val){
        $this->id = $val;
    }

    public function getHTML(){
        return '<nav class="navbar navbar-toggleable-md fixed-top navbar-dark bg-faded scrolling-navbar">
                <div class="container">
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#'.$this->id.'" aria-controls="'.$this->id.'" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand waves-effect waves-light" href="<?= base_url() ?>" >'.$this->title.'</a>
                    <div class="collapse navbar-collapse" id="'.$this->id.'">'.$this->getItens().'</div>        
                </div>
            </nav>';
    }

    private function getItens(){
        $html = '<ul class="navbar-nav mr-auto">';
        foreach($this->menu_list AS $row){
            $menu = new Menu($row);
            $html .= $menu->getHTML();
        }
        return $html.'</ul>';
    }


    public function getObjectData(){}
}