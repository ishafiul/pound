<?php
class Cart extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->adminModel = $this->model('Admin');
        $this->sliderModel = $this->model('Slider');
        $this->siteInfoModel = $this->model('SiteInfo');
        $this->categoryModel = $this->model('Category');
        $this->brandModel = $this->model('Brands');
        $this->officeModel = $this->model('Office');
        $this->productModel = $this->model('Products');
        $this->imgModel = $this->model('Image');


    }
    public function index(){
        $info = $this->siteInfoModel->getSiteInfo();
        $primary_cat = $this->categoryModel->getPrimaryCategory();
        $child = $this->categoryModel->getChildCategory();
        $brand = $this->brandModel->getBrands();
        $cart_p = [];
        if (isset($_SESSION['cart'])){
            $cart_p =$_SESSION['cart'];
        }
        $data =[
            'description' => '',
            'page_title'=>'About Us',
            'info'=>$info,
            'primary_cat'=>$primary_cat,
            'child'=>$child,
            'brands'=>$brand,
            'cartArr'=>$cart_p,
            'cart'=>''
        ];
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
            $ids ='';
            $count = count($_SESSION['cart']);
            for($i=1;$i<=$count;$i++){
                if($i == 1){
                    $ids .=$_SESSION['cart'][0];
                }
                else{
                    $ids .=','.$_SESSION['cart'][$i-1];
                }
            }
            $cartProduct = $this->productModel->getCartProduct($ids);
            $data['cart'] = $cartProduct;
            if (isset($_POST['deleteCart'])){
                $val = $_POST['id'];
                $arryPosition = array_search($val,$_SESSION['cart'],true);
                $_SESSION['cart'] = array_diff($_SESSION['cart'], array($val));
                 $_SESSION['cart'] = array_values(array_filter($_SESSION['cart']));
                 //print_r($_SESSION['cart']);
                //unset($_SESSION['cart'][1]);
                //reset($_SESSION['cart']);
                redirect('cart');
            }
        }

        $this->view('cart/index',$data);
    }
    public function checkout()
    {
        $info = $this->siteInfoModel->getSiteInfo();
        $primary_cat = $this->categoryModel->getPrimaryCategory();
        $child = $this->categoryModel->getChildCategory();
        $brand = $this->brandModel->getBrands();
        $cart_p = [];
        if (isset($_SESSION['cart'])) {
            $cart_p = $_SESSION['cart'];
        }
        $data = [
            'description' => '',
            'page_title' => 'About Us',
            'info' => $info,
            'primary_cat' => $primary_cat,
            'child' => $child,
            'brands' => $brand,
            'cartArr' => $cart_p,
            'cart' => '',
            'user_info'=>''
        ];
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            $ids = '';
            $count = count($_SESSION['cart']);
            for ($i = 1; $i <= $count; $i++) {
                if ($i == 1) {
                    $ids .= $_SESSION['cart'][0];
                } else {
                    $ids .= ',' . $_SESSION['cart'][$i - 1];
                }
            }
            $cartProduct = $this->productModel->getCartProduct($ids);
            $data['cart'] = $cartProduct;

        }
        if (isset($_SESSION['user_email'])){
            $user = $this->userModel->findUserByEmail($_SESSION['user_email']);
            $data['user_info'] =$user;
        }
        $this->view('cart/checkout', $data);
    }
    public function success(){
        $info = $this->siteInfoModel->getSiteInfo();
        $primary_cat = $this->categoryModel->getPrimaryCategory();
        $child = $this->categoryModel->getChildCategory();
        $brand = $this->brandModel->getBrands();
        $cart_p = [];
        if (isset($_GET['id']) && isset($_SESSION['cart'])) {
            unset($_SESSION['cart']);
        }
        $data = [
            'description' => '',
            'page_title' => 'About Us',
            'info' => $info,
            'primary_cat' => $primary_cat,
            'child' => $child,
            'brands' => $brand,
            'id' => '',
            'cart' => '',
            'user_info'=>''
        ];
        if (isset($_GET['id'])){
            $data['id']=$_GET['id'];
        }
        $this->view('cart/success',$data);
    }
}