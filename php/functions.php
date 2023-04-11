<?php
function asset(){
    
}

function is_active($curr_module){
    $link = $_SERVER['REQUEST_URI'];
    $index = strrpos($_SERVER['REQUEST_URI'], "/") + 1;
    $module = substr($link, $index);
    echo $curr_module == $module ? "active" : null;
}
