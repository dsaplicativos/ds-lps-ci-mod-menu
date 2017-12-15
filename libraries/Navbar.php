<?php
include_once APPPATH . 'libraries/util/ORMObject.php';
include_once APPPATH . 'modules/menu/libraries/Menu.php';

class Navbar extends ORMObject{
    private $db;
    private $id = '';
    private $title = 'Dentalbit';
    private $menu_list = array();
    private $bgColor = array('class' => '', 'style' => '');
    private $textColor = 'dark';
    private $containerFluid = false;
    private $toggleSide = 'right';
    private $toggleScreen = 'md';

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

    /**
     * Recebe uma string que define a cor do plano de fundo da navbar.
     * Cores hexadecimais devem, OBRIGATORIAMENTE, conter "#"
     * @param string $color
     */
    public function setBackgroundColor($color) {
        if (strpos($color, '#') === FALSE) {
            $this->bgColor['class'] = $color;
            $this->bgColor['style'] = '';
        }
        else {
            $this->bgColor['class'] = '';
            $this->bgColor['style'] = 'color: ' . $color . ';';
        }
    }

    /**
     * Define a cor do texto de acordo com a cor do fundo.
     * Para fundos escuros, envie "dark": tornará o texto branco.
     * Para fundos claros, envie "light": tornará o texto preto.
     * Default: dark
     * @param string $color
     */
    public function setTextColor($color) {
        $this->textColor = $color;
    }

    /**
     * Define a largura do conteúdo da navbar.
     * True: container-fluid
     * False: container
     * Default: false
     * @param boolean $fluid
     */
//    public function setContainerFluid($fluid) {
//        $this->containerFluid = $fluid;
//    }

    /**
     * Define o lado onde aparecerá o botão de ampliar/reduzir a navbar.
     * Default: right
     * @param string $side = "left" ou "right"
     */
    public function setToggleSide($side) {
        $this->toggleSide = $side;
    }

    /**
     * Define a largura inicial de expansão (apresentação em formato ampliado) da navbar
     * Utilize as siglas de grid do bootstrap
     * Default: md
     * @param string $size
     */
    public function setToggleScreenSize($size) {
        $this->toggleScreen = $size;
    }

    public function id($val){
        $this->id = $val;
    }

    public function getHTML(){
        return '<nav class="navbar navbar-toggleable-'. $this->toggleScreen . ' fixed-top navbar-'. $this->textColor . ' ' . $this->bgColor['class'] . ' bg-faded scrolling-navbar" style="' . $this->bgColor['style'] . '">
                ' . ($this->containerFluid == true ? '' : '<div class="container">') . '
                    <button class="navbar-toggler float-' . $this->toggleSide . '" type="button" data-toggle="collapse" data-target="#'.$this->id.'" aria-controls="'.$this->id.'" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand ' . ($this->containerFluid == true ? 'text-center' : '') . ' waves-effect waves-light" href="<?= base_url() ?>" >'.$this->title.'</a>
                    <div class="collapse navbar-collapse" id="'.$this->id.'">'.$this->getItens().'</div>        
                ' . ($this->containerFluid == true ? '' : '</div>') . '
            </nav>';
    }

    private function getItens(){
        $html = '<ul class="navbar-nav mr-auto">';
        foreach($this->menu_list AS $row){
            $menu = new Menu($row);
            $html .= $menu->getHTML();
        }
        return $html . '</ul>';
    }


    public function getObjectData(){}
}