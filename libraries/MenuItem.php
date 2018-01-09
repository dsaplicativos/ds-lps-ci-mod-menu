<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
include_once APPPATH . 'libraries/util_libs/ORMObject.php';

class MenuItem extends ORMObject{
    private $item;

    function __construct($item){
        parent::__construct('menu');
        $this->item = $item;
        $this->loadItens();
    }

    /**
     * Carrega os itens filhos deste item.
     */
    private function loadItens(){
        $v = array('parent' => $this->item['id']);
        $u = $this->dao->getWhere($v, true);
        $this->item_list = $u;
    }

    /**
     * Retorna o html de um item do menu; este item pode ser simples ou um submenu.
     */
    public function getHTML(){
        if(sizeof($this->item_list) == 0)
            return '<a class="dropdown-item">'.$this->item['label'].'</a>';
        else{
            $html  = '<div class="dropdown-submenu">';
            $html .= '<a class="dropdown-item dropdown-toggle" type="button" data-toggle="dropdown" href="'.$this->item['link'].'">'.$this->item['label'].'&nbsp;</a>';
            $html .= '<div class="dropdown-menu">';

            foreach($this->item_list AS $item){
                $menuitem = new MenuItem($item);
                $html .= $menuitem->getHTML();
            }
            return $html .= '</div></div>';            
        }
    }

    public function getObjectData(){}
}