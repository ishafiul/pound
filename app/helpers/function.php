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
?>