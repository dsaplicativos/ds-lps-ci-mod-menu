<?php
include_once APPPATH . 'libraries/util/ORMObject.php';
include_once APPPATH . 'modules/menu/libraries/Menu.php';

class Navbar extends ORMObject{

    private $db;
    private $id = '';
    private $menu_list = array();

    /**
     * Title properties
     */
    private $title = '';
    private $brand = null;
    private $brandSize = null;
    /**
     * Color properties
     */
    private $bgColor = array('class' => '', 'style' => '');
    private $textColor = 'dark';
    private $dropdownColor = 'primary';
    /**
     * Size properties
     */
    private $containerFluid = false;
    private $toggleScreen = 'md';
    private $marginBottom = null;
    /**
     * Content properties
     */
    private $search = false;

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
     * Define o título, onde ficará o link para a página inicial.
     * @param string $title
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * Recebe a url da imagem e a define o título da barra de navegação
     * @param string $brand
     */
    public function setBrand($brand) {
        $this->brand = $brand;
    }

    /**
     * Define a largura, em pixels, da imagem de título
     * @param int $size
     */
    public function setBrandSize($size) {
        $this->brandSize = $size;
    }

    /**
     * Recebe uma string que define a cor do plano de fundo da navbar.
     * Cores hexadecimais devem, OBRIGATORIAMENTE, conter "#"
     * @see https://mdbootstrap.com/css/colors/
     * @param string $color
     */
    public function setBackgroundColor($color) {
        if (strpos($color, '#') === FALSE) {
            $this->bgColor['class'] = $color;
            $this->bgColor['style'] = '';
        }
        else {
            $this->bgColor['class'] = '';
            $this->bgColor['style'] = 'background-color: ' . $color . ';';
        }
    }

    /**
     * Define a cor do texto de acordo com a cor do fundo.
     * @see https://mdbootstrap.com/angular/components/navbars/#color-schemes
     * Default: dark
     * @param string $color
     */
    public function setTextColor($color) {
        $this->textColor = $color;
    }

    /**
     * Define a cor de hover no menu dropdown
     * @see https://mdbootstrap.com/components/dropdowns/#material-dropdowns
     * @param string $color
     */
    public function setDropdownColor($color) {
        $this->dropdownColor = $color;
    }

    /**
     * Define a exibição da barra de pesquisa
     * @param boolean $search
     */
    public function setSearchBar($search) {
        $this->search = $search;
    }

    /**
     * Define a largura do conteúdo da navbar.
     * @see https://mdbootstrap.com/layout/bootstrap-layout/#introduction
     * Default: false
     * @param boolean $fluid
     */
    public function setContainerFluid($fluid) {
        $this->containerFluid = $fluid;
    }

    /**
     * Adiciona uma div, cuja margem vertical é o valor informado
     * @param int $margin
     * @see https://mdbootstrap.com/utilities/bootstrap-spacing/
     */
    public function setMarginBottom($margin) {
        $this->marginBottom = $margin;
    }

    /**
     * Define a largura inicial de expansão (apresentação em formato ampliado) da navbar
     * @see https://mdbootstrap.com/layout/layout-grid/#grid-options
     * Default: md
     * @param string $size
     */
    public function setToggleScreenSize($size) {
        $this->toggleScreen = $size;
    }

    public function id($val){
        $this->id = $val;
    }

    public function getHTML($user = null){
        $ci = &get_instance();
        return '<nav class="navbar navbar-expand-'. $this->toggleScreen . ' fixed-top navbar-'. $this->textColor . ' ' . $this->bgColor['class'] . ' bg-faded scrolling-navbar" style="' . $this->bgColor['style'] . '">
                    ' . ($this->containerFluid == false ? '' : '<div class="container">') . '
                        <a class="navbar-brand" href="' . base_url() . '" >
                        ' . ($this->brand == null ? $this->title : '<img src="' . base_url($this->brand) . '" width="' . ($this->brandSize == null ? '62' : $this->brandSize) . '" alt="">') . '
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#'.$this->id.'" aria-controls="'.$this->id.'" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="'.$this->id.'">'.$this->getItems($user).'</div>        
                    ' . ($this->containerFluid == false ? '' : '</div>') . '
            </nav>' . ($this->marginBottom == null ? '' : '<div class="my-' . $this->marginBottom . '">&nbsp;</div>') . ($user != null ? '' : $ci->load->view('menu/loginModal', null, true));
    }

    private function getItems($user = null) {
        $items = $this->getLeftItems() . $this->getRightItems($user);
        return $items;
    }

    private function getLeftItems(){
        $html = '<ul class="navbar-nav mr-auto">';
        foreach($this->menu_list AS $row){
            $menu = new Menu($row, $this->dropdownColor);
            $html .= $menu->getHTML();
        }
        return $html . '</ul>';
    }

    private function getUserMenu($user = null) {
        $ci = &get_instance();
        if ($user != null) {
            $html = $ci->load->view('menu/usermenu', array(
                'firstName' => $user->first_name,
                'dropdownColor' => $this->dropdownColor
            ), true);
        }
        else {
            $html = $ci->load->view('menu/loginButton', null, true);
        }
        return $html;
    }

    private function getRightItems($user = null) {
        $html = '<ul class="navbar-nav ml-auto">';
        $html .= $this->search == true ? '<form class="form-inline mx-2">
                    <input type="text" class="form-control filtro-nome" alt="table" placeholder="Pesquisar"
                           aria-describedby="basic-addon1">
                </form>' : '';
        $html .= $this->getUserMenu($user);
        return $html . '</ul>';
    }

    public function getObjectData(){}

}