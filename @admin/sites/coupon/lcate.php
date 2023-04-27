<div class="row" style="max-height: 150px; overflow-y: auto">
<?php
$sql = 'select `id`, `name` from `categories` where `actived`=true order by `id`';
$list = $db->db_get_list($sql);
foreach($list as $item):
?>
<label class="col-md-6 col-sm-12"><input type="checkbox" name="category[]" value="<?=$item['id']?>" id="categories"><?=$item['name']?></label>
<?php
endforeach;
?>
</div>