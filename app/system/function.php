<?php

function redirect($newUrl){
	header('Location:'.$newUrl);
	exit;
}

function dumpHtmlReadable($v){
    echo "<pre>";
    print_r($v);
    echo "</pre>";
}

function calculatePageInfomation($totalPage,$pSize,$currentPn,$buffSize){

    $pages=array(array("pn"=>$currentPn,"is_current"=>1));
    $pre=$currentPn-1;
    $next=$currentPn+1;
    while(count($pages)<$buffSize && ($pre>0 || $next <=$totalPage )){
        if($pre>0){
            array_unshift($pages,array("pn"=>$pre,"is_current"=>0));
            $pre--;
        }
        if(count($pages)<$buffSize && $next <=$totalPage){
            $pages[]=array("pn"=>$next,"is_current"=>0);
            $next++;
        }
    }

    $re=array();
    $re["pages"]=$pages;
    if($currentPn==1){
        $re["is_first"]=1;
    }
    else{
        $re["is_first"]=0;
        $re["pre_page"]=$currentPn-1;

    }
    if($currentPn==$totalPage){
        $re["is_last"]=1;
    }
    else{
        $re["is_last"]=0;
        $re["next_page"]=$currentPn+1;
    }
    return $re;


}

?>