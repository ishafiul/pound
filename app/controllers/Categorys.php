<?php

class Categorys extends Controller
{
    public function __construct()
    {

    }
    public function index()
    {
        /*$data=[
            'g'=>$data
        ];*/
        $this->view('pages/category');
    }
}