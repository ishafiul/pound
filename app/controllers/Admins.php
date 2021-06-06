<?php
class Admins extends Controller {
    public function __construct(){
        $this->adminModel = $this->model('Admin');
        $this->sliderModel = $this->model('Slider');
        $this->siteInfoModel = $this->model('SiteInfo');
        $this->adminCategoryModel = $this->model('Category');
        $this->brandsModel = $this->model('Brands');
        $this->officeModel = $this->model('Office');
    }

    public function index(){// function name will define what will be the page url that user will input
        $info = $this->siteInfoModel->getSiteInfo();
        $data = [
            'page_title' => 'BlogMVC',
            'description' => '',
            'info'=>$info
        ];

        $this->view('admin/index', $data); // which view will load
    }
    public function login(){
        $info = $this->siteInfoModel->getSiteInfo();
        // Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Process form

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data =[
                'password' => trim($_POST['password']),
                'username' => trim($_POST['username']),
                'username_err' => '',
                'password_err' => '',
                'info'=>$info
            ];

            // Validate Email
            if(empty($data['username'])){
                $data['username_err'] = 'Please enter Username';
            }

            // Validate Password
            if(empty($data['password'])){
                $data['password_err'] = 'Please enter password';
            }

            // Check for user/email
            if($this->adminModel->findUserByusernName($data['username'])){
                // User found
            } else {
                // User not found
                $data['username_err'] = 'No user found';
            }

            // Make sure errors are empty
            if(empty($data['username_err']) && empty($data['password_err'])){
                // Validated
                // Check and set logged in user
                $loggedInUser = $this->adminModel->login($data['username'], $data['password']);

                if($loggedInUser){
                    // Create Session
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['password_err'] = 'Password incorrect';

                    $this->view('admin/login', $data);
                }
            } else {
                // Load view with errors
                $this->view('admin/login', $data);
            }


        } else {
            // Init data
            $data =[

                'password' => '',
                'username' => '',
                'email_err' => '',
                'username_err' => '',
                'password_err' => '',
                'info'=>$info
            ];

            // Load view
            $this->view('admin/login', $data);// from where this post method will work
        }
    }
    public function createUserSession($user){
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;
        $_SESSION['user_type'] = $user->type;
        redirect('admins');
    }
    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        session_destroy();
        redirect('admins/login');
    }


    public function settings(){
        $sliders = $this->sliderModel->getSlider(); // call models
        $info = $this->siteInfoModel->getSiteInfo();

        if (isset($_POST['upload_slider'])){
            $data =[
                'featur1_ok' =>'',
                'featur1_err'=>'',
                'featur2_ok' =>'',
                'featur2_err'=>'',
                'logo_ok' =>'',
                'logo_err'=>'',
                'imgName' =>$_FILES['sliderImg']['name'],
                'page_title' => 'Settings',
                'description' => 'All post here ',
                'slider'=>$sliders,
                'slider_err'=>'',
                'info'=>$info
            ];

            $file_name = $_FILES['sliderImg']['name'];
            $file_size = $_FILES['sliderImg']['size'];
            $permited  = array('jpg', 'jpeg', 'png', 'gif');
            $div = explode('.', $file_name);
            $ext = strtolower(end($div));
            if(empty($data['imgName'])){
                $data['slider_err'] = 'No File Selected';
            }

            elseif ($file_size >2048567) {
                $data['slider_err'] = 'Image Size Should be Less Then 2MB';
            }
            elseif (in_array($ext, $permited) === false) {
                $data['slider_err'] ="You can upload only: " .implode(', ', $permited);
            }
            else{
                $file_temp = $_FILES['sliderImg']['tmp_name'];
                $unique_image = substr(md5(time()), 0, 10).'.'.$ext;
                $uploaded_image = DOCROOT."/public/img/slider/".$unique_image;
                move_uploaded_file($file_temp, $uploaded_image);
                $loggedInUser = $this->sliderModel->addSlider($unique_image);
                if ($loggedInUser){
                    redirect('admins/settings?slide_success=Slide Uploaded Successfully');
                }
            }
            $this->view('admin/site_settings', $data);
        }

        //delete slide
        if (isset($_POST['deleteSlide'])){
            $id=$_POST['id'];
            $img=$_POST['imgName'];
            $data =[
                'featur1_ok' =>'',
                'featur1_err'=>'',
                'featur2_ok' =>'',
                'featur2_err'=>'',
                'imgName' =>'',
                'logo_ok' =>'',
                'slider_err'=>'',
                'slide_success'=>'',
                'logo_err'=>'',
                'page_title' => 'Settings',
                'slider'=>$sliders,
                'info'=>$info
            ];
            unlink(DOCROOT."/public/img/slider/".$img);
            $ress = $this->sliderModel->deleteSlide($id);
            if ($ress){
                redirect('admins/settings?slide_success=Slider Deleted Successfully');
            }
        }

        //edit slider
        if (isset($_POST['editSlider'])){
            $id=$_POST['idEdit'];
            $img=$_POST['imgNameEdit'];
            $data =[
                'featur1_ok' =>'',
                'featur1_err'=>'',
                'featur2_ok' =>'',
                'featur2_err'=>'',
                'imgName' =>'',
                'logo_ok' =>'',
                'logo_err'=>'',
                'slider_err'=>'',
                'slide_success'=>'',
                'slider_err_edit'=>'',
                'slider'=>$sliders,
                'page_title' => 'Settings',
                'info'=>$info
            ];

            $file_name = $_FILES['sliderImgEdit']['name'];
            $file_size = $_FILES['sliderImgEdit']['size'];
            $permited  = array('jpg', 'jpeg', 'png', 'gif');
            $div = explode('.', $file_name);
            $ext = strtolower(end($div));
            if(empty($file_name)){
                $data['slider_err_edit'] = 'No File Selected';
            }

            elseif ($file_size >2048567) {
                $data['slider_err_edit'] = 'Image Size Should be Less Then 2MB';
            }
            elseif (in_array($ext, $permited) === false) {
                $data['slider_err_edit'] ="You can upload only: " .implode(', ', $permited);
            }
            else{
                $file_temp = $_FILES['sliderImgEdit']['tmp_name'];
                $unique_image = substr(md5(time()), 0, 10).'.'.$ext;
                $uploaded_image = DOCROOT."/public/img/slider/".$unique_image;
                move_uploaded_file($file_temp, $uploaded_image);
                $loggedInUser = $this->sliderModel->editSlider($unique_image,$id);
                if ($loggedInUser){

                    $oldImg = DOCROOT."/public/img/slider/".$img;
                    if (file_exists($oldImg)){
                        unlink($oldImg);
                    }
                    redirect('admins/settings?slide_success=Slide Edited Successfully');
                    //$data['slide_success'] = 'Slider Edited Successfully. Please Reload';
                }

            }
            $this->view('admin/site_settings', $data);
        }

        //logo
        if (isset($_POST['uploadLogo'])){
            $data =[
                'imgName' =>$_FILES['logoImg']['name'],
                'page_title' => 'Settings',
                'description' => 'All post here ',
                'slider'=>$sliders,
                'slider_err'=>'',
                'logo_err'=>'',
                'logo_ok'=>'',
                'featur1_ok' =>'',
                'featur1_err'=>'',
                'featur2_ok' =>'',
                'featur2_err'=>'',
                'info'=>$info
            ];

            $file_name = $_FILES['logoImg']['name'];
            $file_size = $_FILES['logoImg']['size'];
            $permited  = array('jpg', 'jpeg', 'png', 'gif');
            $div = explode('.', $file_name);
            $ext = strtolower(end($div));
            if(empty($data['imgName'])){
                $data['logo_err'] = 'No File Selected';
            }

            elseif ($file_size >2048567) {
                $data['logo_err'] = 'Image Size Should be Less Then 2MB';
            }
            elseif (in_array($ext, $permited) === false) {
                $data['logo_err'] ="You can upload only: " .implode(', ', $permited);
            }
            else{
                $file_temp = $_FILES['logoImg']['tmp_name'];
                $unique_image = substr(md5(time()), 0, 10).'.'.$ext;
                $uploaded_image = DOCROOT."/public/img/".$unique_image;
                move_uploaded_file($file_temp, $uploaded_image);
                $loggedInUser = $this->siteInfoModel->addLogo($unique_image);
                if ($loggedInUser){
                    $img = $info[0]->logo;
                    $oldImg = DOCROOT."/public/img/".$img;
                    if (file_exists($oldImg)){

                        unlink($oldImg);
                    }
                    //print_r($info);
                    //redirect('admins/settings?slide_success=Slide Edited Successfully');
                    $data['logo_ok'] = 'Logo Uploaded Successfully. Please Reload';
                }
            }
            $this->view('admin/site_settings', $data);
        }

        //uploadfeatur1
        if (isset($_POST['uploadfeatur1'])){
            $data =[
                'imgName' =>$_FILES['featurImg1']['name'],
                'page_title' => 'Settings',
                'slider'=>$sliders,
                'slider_err'=>'',
                'logo_err'=>'',
                'logo_ok'=>'',
                'featur1_ok' =>'',
                'featur1_err'=>'',
                'featur2_ok' =>'',
                'featur2_err'=>'',
                'info'=>$info
            ];

            $file_name = $_FILES['featurImg1']['name'];
            $file_size = $_FILES['featurImg1']['size'];
            $permited  = array('jpg', 'jpeg', 'png', 'gif');
            $div = explode('.', $file_name);
            $ext = strtolower(end($div));
            if(empty($data['imgName'])){
                $data['featur1_err'] = 'No File Selected';
            }

            elseif ($file_size >2048567) {
                $data['featur1_err'] = 'Image Size Should be Less Then 2MB';
            }
            elseif (in_array($ext, $permited) === false) {
                $data['featur1_err'] ="You can upload only: " .implode(', ', $permited);
            }
            else{
                $file_temp = $_FILES['featurImg1']['tmp_name'];
                $unique_image = substr(md5(time()), 0, 10).'.'.$ext;
                $uploaded_image = DOCROOT."/public/img/".$unique_image;
                move_uploaded_file($file_temp, $uploaded_image);
                $loggedInUser = $this->siteInfoModel->featurImg1($unique_image);
                if ($loggedInUser){
                    $img = $info[0]->featurImg1;
                    $oldImg = DOCROOT."/public/img/".$img;
                    if (file_exists($oldImg)){

                        unlink($oldImg);
                    }
                    //print_r($info);
                    //redirect('admins/settings?slide_success=Slide Edited Successfully');
                    $data['featur1_ok'] = 'Logo Uploaded Successfully. Please Reload';
                }
            }
            $this->view('admin/site_settings', $data);
        }
        //uploadfeatur2
        if (isset($_POST['uploadfeatur2'])){
            $data =[
                'imgName' =>$_FILES['featurImg2']['name'],
                'page_title' => 'Settings',
                'slider'=>$sliders,
                'slider_err'=>'',
                'logo_err'=>'',
                'logo_ok'=>'',
                'featur1_ok' =>'',
                'featur1_err'=>'',
                'featur2_ok' =>'',
                'featur2_err'=>'',
                'info'=>$info
            ];

            $file_name = $_FILES['featurImg2']['name'];
            $file_size = $_FILES['featurImg2']['size'];
            $permited  = array('jpg', 'jpeg', 'png', 'gif');
            $div = explode('.', $file_name);
            $ext = strtolower(end($div));
            if(empty($data['imgName'])){
                $data['featur2_err'] = 'No File Selected';
            }

            elseif ($file_size >2048567) {
                $data['featur2_err'] = 'Image Size Should be Less Then 2MB';
            }
            elseif (in_array($ext, $permited) === false) {
                $data['featur2_err'] ="You can upload only: " .implode(', ', $permited);
            }
            else{
                $file_temp = $_FILES['featurImg2']['tmp_name'];
                $unique_image = substr(md5(time()), 0, 10).'.'.$ext;
                $uploaded_image = DOCROOT."/public/img/".$unique_image;
                move_uploaded_file($file_temp, $uploaded_image);
                $loggedInUser = $this->siteInfoModel->featurImg2($unique_image);
                if ($loggedInUser){
                    $img = $info[0]->featurImg2;
                    $oldImg = DOCROOT."/public/img/".$img;
                    if (file_exists($oldImg)){

                        unlink($oldImg);
                    }
                    //print_r($info);
                    //redirect('admins/settings?slide_success=Slide Edited Successfully');
                    $data['featur2_ok'] = 'Logo Uploaded Successfully. Please Reload';
                }
            }
            $this->view('admin/site_settings', $data);
        }
        //info
        if (isset($_POST['infoAdd'])){

            $data =[
                'title' => $_POST['title'],
                'details' => $_POST['details'],
                'fb' => $_POST['fb'],
                'tw' => $_POST['tw'],
                'ig' => $_POST['ig']
            ];
            $infoUpdate = $this->siteInfoModel->infoUpdate($data);
            if ($infoUpdate){
                $data =[
                    'imgName' =>'',
                    'logo_ok' =>'',
                    'logo_err'=>'',
                    'featur1_ok' =>'',
                    'featur1_err'=>'',
                    'featur2_ok' =>'',
                    'featur2_err'=>'',
                    'slider_err'=>'',
                    'infoUpdate_success'=>'Info Updated Successfully. Please Reload The Page',
                    'slide_success'=>'',
                    'page_title' => 'Settings',
                    'slider'=>$sliders,
                    'info'=>$info,
                ];
                $this->view('admin/site_settings', $data);
            }

        }
        else{
            $data =[
                'imgName' =>'',
                'logo_ok' =>'',
                'logo_err'=>'',
                'featur1_ok' =>'',
                'featur1_err'=>'',
                'featur2_ok' =>'',
                'featur2_err'=>'',
                'slider_err'=>'',
                'slide_success'=>'',
                'infoUpdate_success'=>'',
                'page_title' => 'Settings',
                'slider'=>$sliders,
                'info'=>$info
            ];
            $this->view('admin/site_settings',$data);
        }
    }
    public function Categories(){
        $info = $this->siteInfoModel->getSiteInfo();
        $category = $this->adminCategoryModel->getPrimaryCategory();
        $categoryChild = $this->adminCategoryModel->getChildCategory();
        if (isset($_POST['categoryPAdd'])){
            $data = [
                'page_title' => 'Categories',
                'description' => '',
                'info'=>$info,
                'categoryPName'=>$_POST['categoryPName'],
                'cataddP_err'=>'',
                'cataddP_Succ'=>'',
                'cataddC_err'=>'',
                'cataddC_Succ'=>'',
                'categoryCName'=>'',
                'cataddC_select_err'=>'',
                'primaryCategory'=>$category,
                'childCategory'=>$categoryChild,
            ];
            if (empty($data['categoryPName'])){
                $data['cataddP_err']='Give Category A Name';
            }
            else{
                $data['cataddP_Succ']='Primary Category Added Successfully';
                $this->adminCategoryModel->addPrimaryCategory($data);
            }
           $this->view('admin/category', $data);
        }
        if (isset($_POST['editPrimaryCategory'])){
            $data = [
                'page_title' => 'Categories',
                'description' => '',
                'info'=>$info,
                'categoryPName'=>'',
                'cataddP_err'=>'',
                'cataddP_Succ'=>'',
                'cataddC_err'=>'',
                'cataddC_Succ'=>'',
                'cataddC_select_err'=>'',
                'categoryCName'=>'',
                'primaryCategory'=>$category,
                'childCategory'=>$categoryChild,
                'editPrimaryCatName'=>$_POST['editPrimaryCat'],
                'editPrimaryCatId'=>$_POST['id']
            ];
            if (empty($data['editPrimaryCatName'])){
                $data['cataddP_err']='Give Category A Name For Edit';
            }
            else{
                $data['cataddP_Succ']='Primary Category Edited Successfully';
                $this->adminCategoryModel->editPrimaryCategory($data);
            }
            $this->view('admin/category', $data);
        }
        if (isset($_POST['deletePrimaryCat'])){
            $data = [
                'page_title' => 'Categories',
                'description' => '',
                'info'=>$info,
                'categoryPName'=>'',
                'cataddP_err'=>'',
                'cataddP_Succ'=>'',
                'cataddC_err'=>'',
                'cataddC_Succ'=>'',
                'categoryCName'=>'',
                'cataddC_select_err'=>'',
                'primaryCategory'=>$category,
                'childCategory'=>$categoryChild,
                'editPrimaryCatId'=>$_POST['id']
            ];

                $data['cataddP_Succ']='Primary Category Deleted Successfully';
                $this->adminCategoryModel->deletePrimaryCategory($data);

            $this->view('admin/category', $data);
        }
        //child
        if (isset($_POST['categoryCAdd'])){
            $data = [
                'page_title' => 'Categories',
                'description' => '',
                'info'=>$info,
                'categoryCName'=>$_POST['categoryCName'],
                'childOf'=>$_POST['selectP'],
                'categoryPName'=>'',
                'cataddP_err'=>'',
                'cataddP_Succ'=>'',
                'cataddC_err'=>'',
                'cataddC_select_err'=>'',
                'cataddC_Succ'=>'',
                'categoryCName'=>'',
                'primaryCategory'=>$category,
                'childCategory'=>$categoryChild,

            ];
            if ($data['childOf'] == 0){
                $data['cataddC_select_err']='Select a Primary Category';
            }
            if(empty($data['categoryCName'])){
                $data['cataddC_err']='Give Category A Name';
            }
            if (empty($data['cataddC_err']) && empty($data['cataddC_select_err'])){
                $data['cataddC_Succ']='Primary Category Added Successfully';
                $this->adminCategoryModel->addChildCategory($data);
            }
            $this->view('admin/category', $data);
        }
        if (isset($_POST['editChildCategory'])){
            $data = [
                'page_title' => 'Categories',
                'description' => '',
                'info'=>$info,
                'categoryPName'=>'',
                'cataddP_err'=>'',
                'cataddP_Succ'=>'',
                'cataddC_err'=>'',
                'cataddC_select_err'=>'',
                'cataddC_Succ'=>'',
                'categoryCName'=>'',
                'primaryCategory'=>$category,
                'childCategory'=>$categoryChild,
                'editChildCat'=>$_POST['editChildCat'],
                'childOf'=>$_POST['selectPForEdit'],
                'editChildCatId'=>$_POST['id']
            ];
            if ($data['childOf'] == 0){
                $data['cataddC_select_err']='Select a Primary Category';
            }
            if(empty($data['editChildCat'])){
                $data['cataddC_err']='Give Category A Name';
            }
            if (empty($data['cataddC_err']) && empty($data['cataddC_select_err'])){
                $data['cataddC_Succ']='Primary Category Edited Successfully';
                $this->adminCategoryModel->editChildCategory($data);
            }

            /*else{
                $data['cataddP_Succ']='Primary Category Edited Successfully';
                $this->adminCategoryModel->editPrimaryCategory($data);
            }*/
            $this->view('admin/category', $data);
        }
        if (isset($_POST['deleteChildCat'])){
            $data = [
                'page_title' => 'Categories',
                'description' => '',
                'info'=>$info,
                'categoryPName'=>'',
                'cataddP_err'=>'',
                'cataddP_Succ'=>'',
                'cataddC_err'=>'',
                'cataddC_Succ'=>'',
                'categoryCName'=>'',
                'cataddC_select_err'=>'',
                'primaryCategory'=>$category,
                'childCategory'=>$categoryChild,
                'editChildCatId'=>$_POST['id']
            ];

            $data['cataddC_Succ']='Child Category Deleted Successfully';
            $this->adminCategoryModel->deleteChildCategory($data);

            $this->view('admin/category', $data);
        }
        else{
            $data = [
                'page_title' => 'Categories',
                'description' => '',
                'info'=>$info,
                'categoryPName'=>'',
                'cataddP_err'=>'',
                'cataddP_Succ'=>'',
                'cataddC_err'=>'',
                'cataddC_Succ'=>'',
                'categoryCName'=>'',
                'cataddC_select_err'=>'',
                'primaryCategory'=>$category,
                'childCategory'=>$categoryChild,
            ];
            $this->view('admin/category', $data);
        }
    }

    public function brands(){
        $info = $this->siteInfoModel->getSiteInfo();
        $category = $this->adminCategoryModel->getPrimaryCategory();
        $brands= $this->brandsModel->getBrands();
        if (isset($_POST['addBrand'])){
            $data = [
                'page_title' => 'Brands',
                'description' => '',
                'info'=>$info,
                'primaryCategory'=>$category,
                'brand_Name_err'=>'',
                'brand_succ'=>'',
                'cat_select_err'=>'',
                'brands'=>$brands,
                'brand_name'=>$_POST['brandName'],
                'cat_id'=>$_POST['selectCat']
            ];
            if ($data['cat_id'] == 0){
                $data['cat_select_err']='Select a Primary Category';
            }
            if(empty($data['brand_name'])){
                $data['brand_Name_err']='Give a Brand name';
            }
            if (empty($data['cat_select_err']) && empty($data['brand_Name_err'])){
                $data['brand_succ']='Brand Added Successfully';
                $this->brandsModel->addBrands($data);
            }
            $this->view('admin/brands',$data);
        }
        if (isset($_POST['deletebrand'])){
            $data = [
                'page_title' => 'Brands',
                'description' => '',
                'info'=>$info,
                'primaryCategory'=>$category,
                'brands'=>$brands,
                'brand_Name_err'=>'',
                'brand_succ'=>'',
                'cat_select_err'=>'',
                'brand_name'=>'',
                'id'=>$_POST['id'],
            ];

            $data['brand_succ']='Brand Deleted Successfully';
            $this->brandsModel->deleteBrand($data);

            $this->view('admin/brands', $data);
        }
        if (isset($_POST['editBrands'])){
            $data = [
                'page_title' => 'Brands',
                'description' => '',
                'info'=>$info,
                'primaryCategory'=>$category,
                'brands'=>$brands,
                'brand_Name_err'=>'',
                'brand_succ'=>'',
                'cat_select_err'=>'',
                'id'=>$_POST['editid'],
                'brand_name'=>$_POST['editBrandName'],
                'cat_id'=>$_POST['selectEditCat']
            ];

            if ($data['cat_id'] == 0){
                $data['cat_select_err']='Select a Primary Category';
            }
            if(empty($data['brand_name'])){
                $data['brand_Name_err']='Give a Brand name';
            }
            if (empty($data['cat_select_err']) && empty($data['brand_Name_err'])){
                $data['brand_succ']='Brand Added Successfully';
                $this->brandsModel->editBrands($data);
            }

            $this->view('admin/brands', $data);
        }
        else{
            $data = [
                'page_title' => 'Brands',
                'description' => '',
                'info'=>$info,
                'primaryCategory'=>$category,
                'brands'=>$brands,
                'brand_Name_err'=>'',
                'brand_succ'=>'',
                'cat_select_err'=>'',
                'brand_name'=>'',
            ];
            $this->view('admin/brands',$data);
        }
    }
    public function office(){
        $info = $this->siteInfoModel->getSiteInfo();
        $office = $this->officeModel->getAllOfficeInfo();
        if (isset($_POST['addOffice'])){
            $data = [
                'page_title' => 'Office',
                'description' => '',
                'info'=>$info,
                'office'=>$office,
                'address'=>$_POST['address'],
                'mobile'=>$_POST['mobile'],
                'telephone'=>$_POST['telephone'],
                'fax'=>$_POST['fax'],
                'email'=>$_POST['email'],
                'office_succ'=>'',
                'address_err'=>'',
                'mobile_err'=>'',
                'telephone_err'=>'',
                'fax_err'=>'',
                'email_err'=>'',
            ];

            if (empty($data['address'])){
                $data['address_err']='Insert Address';
            }
            if(empty($data['mobile'])){
                $data['mobile_err']='Insert Mobile Number';
            }
            if(empty($data['telephone'])){
                $data['telephone_err']='Insert Telephone Number';
            }
            if(empty($data['fax'])){
                $data['fax_err']='Insert FAX Number';
            }
            if(empty($data['email'])){
                $data['email_err']='Insert Email';
            }
            if (empty($data['address_err']) && empty($data['mobile_err']) && empty($data['telephone_err']) && empty($data['fax_err']) && empty($data['email_err'])){
                $data['office_succ']='Office Added Successfully';
                $this->officeModel->addOffice($data);
            }
            else{

            }
            $this->view('admin/office',$data);
        }
        if (isset($_POST['editOffice'])){
            $data = [
                'page_title' => 'Office',
                'description' => '',
                'info'=>$info,
                'office'=>$office,
                'editaddress'=>$_POST['editaddress'],
                'editmobile'=>$_POST['editmobile'],
                'edittelephone'=>$_POST['edittelephone'],
                'editfax'=>$_POST['editfax'],
                'editemail'=>$_POST['editemail'],
                'address'=>'',
                'mobile'=>'',
                'telephone'=>'',
                'fax'=>'',
                'email'=>'',
                'id'=>$_POST['id'],
                'office_succ'=>'',
                'address_err'=>'',
                'mobile_err'=>'',
                'telephone_err'=>'',
                'fax_err'=>'',
                'email_err'=>'',
            ];
            if ($this->officeModel->editOffice($data)){
                $data['office_succ']='Office Edited Successfully';
            }
            $this->view('admin/office',$data);
        }
        if (isset($_POST['deleteOffice'])){
            $data = [
                'page_title' => 'Office',
                'description' => '',
                'info'=>$info,
                'office'=>$office,
                'address'=>'',
                'mobile'=>'',
                'telephone'=>'',
                'fax'=>'',
                'email'=>'',
                'office_succ'=>'',
                'address_err'=>'',
                'mobile_err'=>'',
                'telephone_err'=>'',
                'fax_err'=>'',
                'email_err'=>'',
                'id'=>$_POST['id'],
            ];
            if ($this->officeModel->deleteOffice($data)){
                $data['office_succ']='Office Deleted Successfully';
            }
            $this->view('admin/office',$data);
        }
        else{
            $data = [
                'page_title' => 'Office',
                'description' => '',
                'info'=>$info,
                'office'=>$office,
                'address'=>'',
                'mobile'=>'',
                'telephone'=>'',
                'fax'=>'',
                'email'=>'',
                'office_succ'=>'',
                'address_err'=>'',
                'mobile_err'=>'',
                'telephone_err'=>'',
                'fax_err'=>'',
                'email_err'=>'',
            ];
            $this->view('admin/office',$data);
        }

    }
}