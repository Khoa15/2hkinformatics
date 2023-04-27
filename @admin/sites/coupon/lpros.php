<div class="row" style="max-height: 150px; overflow-y: auto">
	<div class="form-group col-12">
		<input type="text" id="myInput" class="form-control" autocomplete="off" autofocus="false" autosave="false" onkeyup="myFunction()"placeholder="Nhập tên sản phẩm">
	</div>
<?php
$sql = 'select `id`, `name` from `products` where `actived`=true order by `id`';
$list = $db->db_get_list($sql);
foreach($list as $item):
?>
<label class="col-md-6 col-sm-12 namepro" title="<?=$item['name']?>"><input type="checkbox" name="product[]" value="<?=$item['id']?>" id="products"><?=mb_substr($item['name'],0, 20, 'UTF-8')?><?=(strlen($item['name'])>20)?'...':false?></a></label>
<?php
endforeach;
?>
</div>

<script>
function myFunction() {
  let input = document.getElementById('myInput').value 
    input=input.toLowerCase(); 
    let x = $('label.namepro');
    for (i = 0; i < x.length; i++) {  
        if (!x[i].getAttribute('title').toLowerCase().includes(input)) { 
            x[i].style.display="none"; 
        } 
        else { 
            x[i].style.display="inline-block";                  
        } 
    } 
}
</script>