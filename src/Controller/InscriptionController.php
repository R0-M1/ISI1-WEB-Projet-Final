<?php
namespace App\Controller;

class InscriptionController extends BaseController{
    public function index(){
        echo $this->renderView('inscription/index.twig');
    }
}