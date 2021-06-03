<?php
  class Pages extends Controller {
    public function __construct(){
     //your models gose here . example : $this->ModelName = $this->model('model_class_name');
        $this->sliderModel = $this->model('Slider');
        $this->siteInfoModel = $this->model('SiteInfo');
        $this->officeModel = $this->model('Office');
    }
    
    public function index(){// function name will define what will be the page url that user will input
        $sliders = $this->sliderModel->getSlider(); // call models
        $info = $this->siteInfoModel->getSiteInfo();
        $data =[
            'description' => '',
            'page_title'=>'Home Page',
            'slider'=>$sliders,
            'info'=>$info
        ];
      $this->view('pages/index', $data); // which view will load
    }

    public function about(){
        $info = $this->siteInfoModel->getSiteInfo();
      $data = [
          'page_title' => 'About Us',
          'description' => '',
          'info'=>$info
      ];

      $this->view('pages/about', $data);
    }
      public function contact(){
          $info = $this->siteInfoModel->getSiteInfo();
          $office = $this->officeModel->getAllOfficeInfo();
          $data = [
              'page_title' => 'Contacts Us',
              'description' => '',
              'info'=>$info,
              'office'=>$office
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