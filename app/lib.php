<?php

function processingAction($url) 
{
    $url = mb_strtolower($url);
    $data = explode('-', $url);
    $dataCount = count($data);

    if ($dataCount > 1) {
        $url = $data[0];
        for ($i = 1; $i < $dataCount; $i++) {
            $url .= ucfirst($data[$i]);
        }
    }

    return $url;
}

function pa($v){
    echo '<pre>';
    print_r($v);
    echo '</pre>';
}

function getPagination($currentPage, $count, $countOnePage) {
    if (!$currentPage) {
        $currentPage = 1; 
    }
    $countPage = (int)ceil($count / $countOnePage); 
    $countShowPage = 5; 
    $part = (int)floor($countShowPage / 2); 
    $page = [];  
    if ($countPage <= $countShowPage) {
        $maxShow = $countPage;
    } else {
        $maxShow = $countShowPage;
    }    

    for ($i = 1; $i <= $countPage; $i++) {
        if ($currentPage - $part <= 0) { 
            if ($i <= $maxShow) { 
                $page[] = $i;
            }    
        } elseif ($currentPage + $part >= $countPage) {  
            if ($i > $countPage - $maxShow && $i <= $countPage) {
                $page[] = $i;
            }        

        } else { 
            if ($i >= $currentPage - $part && $i <= $currentPage + $part)  {
                $page[] = $i;
            }    
        }
    }
    return [$page, $currentPage, $countPage];
}