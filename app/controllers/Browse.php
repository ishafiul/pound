<?php
class Categorys extends Controller
{
    public function __construct()
    {
        //your models gose here . example : $this->ModelName = $this->model('model_class_name');
        $this->sliderModel = $this->model('Slider');
        $this->siteInfoModel = $this->model('SiteInfo');
        $this->officeModel = $this->model('Office');
        $this->categoryModel = $this->model('Category');
        $this->brandModel = $this->model('Brands');
        $this->productModel = $this->model('Products');
        $this->imgModel = $this->model('Image');
    }
    public function index(){
        $primary_cat = $this->categoryModel->getPrimaryCategory();
        $child = $this->categoryModel->getChildCategory();
        $info = $this->siteInfoModel->getSiteInfo();
        $categoryChild = $this->categoryModel->getChildCategory();
        $brands = $this->brandModel->getBrands();
        $products = '';
        $relatedProducts = '';
        $img= '';
        $data = [
            'page_title' => 'Products',
            'description' => '',
            'info' => $info,
            'products' => $products,
            'related_products' => $relatedProducts,
            'childCategory' => $categoryChild,
            'brands'=>$brands,
            'img'=>$img,
            'product_succ'=>'',
            'img_err'=>'',
            'primary_cat'=>$primary_cat,
            'child'=>$child,

        ];
        $this->view('category/index',$data);
    }
}