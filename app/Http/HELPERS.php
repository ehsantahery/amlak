<?php

///// view btn sidebar
function SlidAction($url, $status = true)
{


    if ($status)
        return (strpos(currenturl(), $url) === 0) ? "active" : '';
    else
        return ($url === currenturl()) ? "active" : '';
}



function HomeActive()
{
    
    return substr(currenturl(),22,1) === "" ? "active" : "";
    
}









///view message error class AND input 
function errorClass($name)
{


    return errorExist($name) ? 'is-invalid' : '';
}
function errorText($name)
{
    return errorExist($name) ? "<div><small class='danger'>" . error($name) . "</small></div>" : '';
}





///// keep input value  
function oldOrValue($name, $value)
{
    return empty(old($name)) ? $value : old($name);
}






///// view Actived Or UnActived class AND input
function ClassActiveOrUnActive($value)
{
    return $value == 1 ? "text-success" : "text-danger";
}

function TexActiveOrUnActive($value)
{
    return $value == 1 ? "تایید شده" : "در انتظار تایید...";
}




///// view Actived Or unActived btn AND input in about comments
function ClassBtnActiveOrUn($value)
{
    return $value == 1 ? "btn-warning" : "btn-danger";
}
function ClassBtnActiveOrUn_2($value)
{
    return $value == 1 ? "btn-success" : "btn-warning";
}
function ClassTextColor($value)
{
    return $value == 1 ? "text-success" : "text-danger";
}
function TexBtncunfirmOrUn($value)
{
    return $value == 1 ? "لغو تایید" : "تایید";
}
function texBtnActiveOrUn($value)
{
    return $value == 1 ? "فعال" : "غیر فعال";
}




/// comment
function coment($value,$result)
{
    return ($value) == null ? $result : ''; 
}

function result($value,$valueTow,$result)
{
    return ($value) == $valueTow ? $result : ''; 
}








