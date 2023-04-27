<?php
$title = '2HK - Shopp';
$html = '<div class="container mb-6">
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <h1 class="animate__animated title-main text-center text-light animate__bounceInLeft">2HK - DB</h1>
            <form id="boxsearch" action="/products.html" class=" text-right animate__animated animate__bounceInRight">
                <div class="form-group shadow-sm mb-0">
                    <input type="text" class="form-control" name="q" id="searchkey" autocomplete="off">
                </div>
                <button type="submit" class="btn btn-lg btn-gradient-primary" id="btnsearch"><i class="mdi mdi-magnify"></i></button>
            </form>
                <div class="autocomplete">
                    <ul class="mt-3" id="autocomplete" style="list-style:none">
                       
                    </ul>
                </div>
        </div>
        <div class="col-lg-3"></div>
    </div>
</div>';
$data = array('title'=>$title,'html'=>$html);
echo json_encode($data);
?>