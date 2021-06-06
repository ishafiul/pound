<?php
  class Pages extends Controller {
    public function __construct(){
     //your models gose here . example : $this->ModelName = $this->model('model_class_name');
        $this->sliderModel = $this->model('Slider');
        $this->siteInfoModel = $this->model('SiteInfo');
        $this->officeModel = $this->model('Office');
        $this->categoryModel = $this->model('Category');
        $this->brandModel = $this->model('Brands');
    }
    
    public function index(){// function name will define what will be the page url that user will input
        $sliders = $this->sliderModel->getSlider(); // call models
        $info = $this->siteInfoModel->getSiteInfo();
        $primary_cat = $this->categoryModel->getPrimaryCategory();
        $child = $this->categoryModel->getChildCategory();
        $brand = $this->brandModel->getBrands();
        $data =[
            'description' => '',
            'page_title'=>'Home Page',
            'slider'=>$sliders,
            'info'=>$info,
            'primary_cat'=>$primary_cat,
            'child'=>$child,
            'brands'=>$brand
        ];
      $this->view('pages/index', $data); // which view will load
    }

    public function about(){
        $info = $this->siteInfoModel->getSiteInfo();
        $primary_cat = $this->categoryModel->getPrimaryCategory();
        $child = $this->categoryModel->getChildCategory();
        $brand = $this->brandModel->getBrands();
        $data =[
            'description' => '',
            'page_title'=>'About Us',
            'info'=>$info,
            'primary_cat'=>$primary_cat,
            'child'=>$child,
            'brands'=>$brand
        ];

      $this->view('pages/about', $data);
    }
      public function contact(){
          $info = $this->siteInfoModel->getSiteInfo();
          $office = $this->officeModel->getAllOfficeInfo();
          $primary_cat = $this->categoryModel->getPrimaryCategory();
          $child = $this->categoryModel->getChildCategory();
          $brand = $this->brandModel->getBrands();
          $data = [
              'page_title' => 'Contacts Us',
              'description' => '',
              'info'=>$info,
              'office'=>$office,
              'primary_cat'=>$primary_cat,
              'child'=>$child,
              'brands'=>$brand
          ];

          $this->view('pages/contact', $data);
      }
      public function error(){
          $info = $this->siteInfoModel->getSiteInfo();
          $data = [
              'page_title' => 'Contacts Us',
              'description' => '',
              'info'=>$info
          ];

          $this->view('pages/404', $data);
      }

  }