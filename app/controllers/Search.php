<?php


class Search extends Controller
{
    public function __construct(){
        //your models gose here . example : $this->ModelName = $this->model('model_class_name');
        $this->sliderModel = $this->model('Slider');
        $this->siteInfoModel = $this->model('SiteInfo');
        $this->officeModel = $this->model('Office');
        $this->categoryModel = $this->model('Category');
        $this->brandModel = $this->model('Brands');
        $this->productModel = $this->model('Products');
        $this->imgModel = $this->model('Image');
        $this->userModel = $this->model('User');
        $this->paymentModel = $this->model('Payment');
    }
    public function index(){




        $info = $this->siteInfoModel->getSiteInfo();
        $office = $this->officeModel->getAllOfficeInfo();
        $primary_cat = $this->categoryModel->getPrimaryCategory();
        $child = $this->categoryModel->getChildCategory();
        $brand = $this->brandModel->getBrands();
        $search_result ='';
        if (isset($_GET['q'])){
            $keyword = $_GET['q'];
            $search_result = $this->productModel->getSearchResult($keyword);
        }
        $data = [
            'page_title' => 'Contacts Us',
            'description' => '',
            'result'=>$search_result,
            'info'=>$info,
            'office'=>$office,
            'primary_cat'=>$primary_cat,
            'child'=>$child,
            'brands'=>$brand
        ];
        $this->view('search/index', $data);

    }
}