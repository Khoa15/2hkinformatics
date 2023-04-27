<?php
if(isset($_SESSION['id']) && isset($_SESSION['permission'])){
    $id = $_SESSION['id'];
    $permit = $_SESSION['permission'];
    if(empty($id) || empty($permit) || $permit<3){
        echo "The request not found";
        return false;
    }
}
?><style type="text/css">
* {padding: 0; margin: 0;}
body {font-family: 'Helvetica Neue', Arial, Helvetica,'Nimbus Sans L', sans-serif, 'Calibri'; font-size: 14px; color: #444; background-color: #ecf0f5;}
h1, h2, h3, h4, h5, h6 {font-weight: normal;}
.clearfix {clear: both;}
button {display: inline-block; margin-top: 10px; margin-right: 5px; padding: 7px; font-size: 14px; border-radius: 4px;}
button:hover {cursor: pointer; opacity: 0.8;}

/* Box upload */
.box-upload {width: 500px; margin: 20px auto; border: 1px solid #e5e5e5; background-color: #fff; padding: 10px;}
.box-upload h2 {text-align: center; margin-bottom: 20px;}
.progress {padding-bottom: 20px; border: 1px solid #e5e5e5; border-radius: 4px; margin-bottom: 12px; display: none;}
.progress-bar {background-color: #428bca; color: #fff; text-align: center; border-radius: 4px; padding: 2px 0; width: 0;}
input[type=file] {display: block; font-size: 14px;}
.box-preview-img {margin-top: 10px; display: none;}
.box-preview-img p {font-weight: bold;}
.box-preview-img img {width: 50px; height: 50px; border: 1px solid #e5e5e5; margin-right: 5px; margin-top: 5px;}
button.btn-reset {background-color: #fff; border: 1px solid #ccc; color: #444;}
button.btn-submit {background-color: #428bca; border: 1px solid #428bca; color: #fff;}
.output {display: none; background-color: #d9534f; color: #fff; padding: 7px; border-radius: 4px; margin-top: 10px;}
.success {background-color: #5cb85c;}</style>
<form action="/admin/images/list/add" method="POST" enctype="multipart/form-data" id="formUpload" onsubmit="return false;">
	<div class="progress">
		<div class="progress-bar">0%</div>
	</div>
	<input type="text" name="action" value="uploads" hidden>
	<input type="file" name="img_file[]" multiple="true" onchange="previewImg(event);" id="img_file" accept="image/*">
	<input type="text" name="id" id="id" class="form-control" placeholder="ID Sản phẩm">
	<div class="form-group">
		<label for="typeGame">Loại hình</label>
		<select name="typeGame" id="typeGame" class="form-control" onchange="choose()">
			<option value="1">Sản Phẩm</option>
			<option value="2" <?=($permit<5)?'disabled':false?>>Banner</option>
			<option value="3" <?=($permit<5)?'disabled':false?>>Slide Ảnh</option>
			<option value="4">Hình Website</option>
		</select>
	</div>
	<div class="form-group" id="typeImagesBoxSelectdivForm">
		<label for="typeImages">Vị trí</label>
		<select name="typeImages" class="form-control" id="type">
			<option value="1">Hình ảnh bình thường</option>
			<option value="2">Hình ảnh đại diện</option>
		</select>
	</div>
	<div class="form-group">
	    <div class="form-check">
	      <label class="form-check-label">
	          <input class="form-check-input" checked name="status" type="checkbox" value="1">
	          Hiện
	          <span class="form-check-sign">
	            <span class="check"></span>
	          </span>
	      </label>
	    </div>
	  </div>
	<div class="box-preview-img"></div>
	<button type="reset" class="btn-reset">Làm mới</button>
	<button type="submit" class="btn-submit">Upload</button>
	<div class="output"></div>
	<div class="load"></div>
</form>
<script>
	function choose(){
		var sel = document.getElementById('typeGame').value;
		if(sel==2 || sel==4 || sel==3){
			document.getElementById("typeImagesBoxSelectdivForm").style.display = "none";
			document.getElementById("id").style.display="none";
		}else{
			document.getElementById("typeImagesBoxSelectdivForm").style.display = "block";
			document.getElementById("id").style.display="block";
		}
	}
</script>
<script src="/assets/js/app/imagejs/jquery.js"></script>
<script src="/assets/js/app/imagejs/jquery.form.js"></script>
<script src="/assets/js/app/imagejs/main.js"></script>