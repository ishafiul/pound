<?php
if (!isset($_SESSION['user_id'])){
    redirect('admins/login');
}
require_once 'inc/header.php';
?>
<?php
require_once 'inc/footer.php';
?>