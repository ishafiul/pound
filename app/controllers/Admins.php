<?php
class Admins extends Controller {
    public function __construct(){
        $this->adminModel = $this->model('Admin');
        $this->sliderModel = $this->model('Slider');
        $this->siteInfoModel = $this->model('SiteInfo');
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
    public function Categorys(){
        $info = $this->siteInfoModel->getSiteInfo();
        $data = [
            'page_title' => 'Contacts Us',
            'description' => '',
            'info'=>$info
        ];

        $this->view('admin/category', $data);
    }
}