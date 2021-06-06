<?php
function calculate_median($arr) {
    $coun = count($arr); //total numbers in array
    if($coun % 2) { // odd number, middle is the median
        $median = ($coun/2)+1;
    } else { // even number, calculate avg of 2 medians
        $median = ($coun/2);
    }
    return $median;
}


function pagination($total_pages,$pageno){

    $html='';
    $html = '
<nav aria-label="">
      <ul class="pagination pagination-flush justify-content-center"><li class="page-item ';
    if ($pageno <= 1){
        $html.='disabled';
    }
    $html.='"><a class="page-link" href="';
    if($pageno <= 1){
        $html .='#';
    }
    else{
        $html .= "?pageno=".($pageno - 1);
    }
    $html.='">Previous</a></li>';
    for($i= 1; $i<=$total_pages; $i++){
        //$html .='<li class="page-item active"><a class="page-link" href="#"><span>'.$i.'</span></a></li>';
        $html .= '<li class="page-item ';
        if ($pageno == $i){
            $html.='active';
        }
        if($pageno == $i){
            $html.='"><a class="page-link" href="#">';
        }
        else{
            $html.='"><a class="page-link" href="?pageno='.$i.'"';
        }
        $html.='<span>'.$i.'</span></a></li>';

    }


    //Next
    $html .='<li class="page-item ';
    if($pageno >= $total_pages){
        $html.='disabled';
    }
    $html .='"><a class="page-link" href="';
    if($pageno >= $total_pages){
        $html .='#';
    }
    else{
        $html .= "?pageno=".($pageno + 1);
    }
    $html.='">Next</a></li>';

    $html.='</ul></nav>';
    echo $html;
}
?>
