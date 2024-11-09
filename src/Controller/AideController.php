<?php
namespace App\Controller;

class AideController extends BaseController{
    public function index()
    {
        echo $this->renderView('aide.twig');
    }
}