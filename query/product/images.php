<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    define("IN_SITE", true);
}
require_once('../../c0nFig.php');
if ( $_SERVER['HTTP_HOST'] != HOSTT ) die ("Direct access not premitted");
$id = (isset($_POST['pid']))?(int)$_POST['pid']:0;
if($id != $_POST['pid']){
    echo "The request not found";
    exit();
}
$sql = 'select `link` from `images` where `product_id`='.$id.' and status = 1 order by `pos` desc';
$list = $db->db_get_list($sql);
?>
<style>
* {box-sizing: border-box}
.mySlides1, .mySlides2 {display: none}
img {vertical-align: middle;transition: .2s; z-index: 9}
/*#zoom:hover {
  transform: scale(2, 1);
  margin-left: 170px;
}*/
.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -22px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}
.prev{
    left: 0;
}
.prev:hover, .next:hover {
  background-color: #f1f1f1;
  color: black;
}
</style>
<div class="slideshow-container">
    <?php foreach($list as $image): ?>
  <div class="mySlides1">
    <img src="<?=$image['link']?>" id="zoom" style="max-width:100%;height:340px">
  </div>
<?php endforeach; ?>

  <a class="prev" onclick="plusSlides(-1, 0)">&#10094;</a>
  <a class="next" onclick="plusSlides(1, 0)">&#10095;</a>
</div>
<script>
var slideIndex = [1,1];
var slideId = ["mySlides1"]
showSlides(1, 0);
showSlides(1, 1);

function plusSlides(n, no) {
  showSlides(slideIndex[no] += n, no);
}

function showSlides(n, no) {
  var i;
  var x = document.getElementsByClassName(slideId[no]);
  if (n > x.length) {slideIndex[no] = 1}    
  if (n < 1) {slideIndex[no] = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";  
  }
  x[slideIndex[no]-1].style.display = "block";  
}
</script>