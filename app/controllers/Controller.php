<?php

namespace app\controllers;
use Flight;
use app\models\MenuModel;

class Controller {
    protected $url;

	public function __construct($url) {
        $this->url=$url;
	}

    public function index() {
        $data = ['page'=>'','url'=>$this->url];
        Flight::render('index',$data);
    }

}