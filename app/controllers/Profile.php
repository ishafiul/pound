<?php


class Profile extends Controller
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
        $user_id = $_SESSION['user_id'];
        $user_detail = $this->userModel->getUserById($user_id);

        $pament_info = $this->paymentModel->findPaymentByUser($user_detail->id);



        $info = $this->siteInfoModel->getSiteInfo();
        $office = $this->officeModel->getAllOfficeInfo();
        $primary_cat = $this->categoryModel->getPrimaryCategory();
        $child = $this->categoryModel->getChildCategory();
        $brand = $this->brandModel->getBrands();
        $data = [
            'page_title' => 'Contacts Us',
            'description' => '',
            'user_detail'=>$user_detail,
            'payment_info'=>$pament_info,
            'info'=>$info,
            'office'=>$office,
            'primary_cat'=>$primary_cat,
            'child'=>$child,
            'brands'=>$brand
        ];
        $this->view('profile/index', $data);
    }
}