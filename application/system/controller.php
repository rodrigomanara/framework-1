<?php

abstract Class Controller {

    /**
     * 
     * @see model
     * @var model esta funcao ira trazer a class do Banco de dados
     */
    public $model;

    /**
     * @see load
     * @var load 
     */
    public $load;
    /**
     *
     * @var type 
     */
    public $url;
    /**
     *
     * @var type 
     */
    public $graphic;
    /**
     *
     * @var type 
     */
    public $graphic2;

    /**
     * function
     * @see  function
     * @var function 
     */
    public $function;

    /**
     * @see functions
     * it will replace function
     * @var functions 
     */
    public $functions;
    /**
     *
     * @var type 
     */
    public $data = array();
    /**
     *
     * @var type 
     */
    public $salt_login;
    /**
     *
     * @var type 
     */
    public $session;
    /**
     *
     * @var type 
     */
    public $post;
    /**
     *
     * @var type 
     */
    public $get;

    /**
     *
     * @var randon
     * @see randon 
     * @commenst [bring the final function]
     */
    public $randon;
    /**
     *
     * @var SERVER 
     */
    public $server;
    /**
     *
     * @var type 
     */
    public $validation;
    /**
     *
     * @var type 
     */
    public $image;

    /**
     *
     * @var arry  extends function to get url break down 
     */
    public $breaklink;
    /**
     *
     * @var type 
     */
    public $cache;

    /**
     *
     * @var http_host
     * @example url __root description
     */
    public $http_host;
    /**
     *
     * @var type 
     */
    public $export;
    /**
     *
     * @var type 
     */
    public $upload;

    public function __construct() {
        $this->functions = new functions();
        $this->load = new load();
        $this->salt_login = new randon();
        $this->session = $_SESSION;
        $this->post = $_POST;
        $this->randon = $this->salt_login->randon();
        $this->server = $_SERVER;
        $this->url = str_replace("///", "/", 'http://' . $this->server['HTTP_HOST'] . "/" . $this->server['REQUEST_URI']);
        $this->export = new export();
        $this->validation = new validation();
        $this->image = new getimage();
        $this->get = $_GET;
        $this->cache = new cache();
        $this->http_host = 'http://' . $this->server['HTTP_HOST'] . "/" . __system;
        $this->breaklink = $this->functions->breaklink($this->get);
        $str = "asdfghjklpoiuyytqwexmbzbhshjgcbnmcsgygasdkgjdgasd";
        !isset($_SESSION['token']) ? $_SESSION['token'] = $this->salt_login->randon() . substr($str, rand(strlen($str), strlen($str))) : false;
    
        $this->upload = new UploadHandler();
        
        
    }

}

?>
