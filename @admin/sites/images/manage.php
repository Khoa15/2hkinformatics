<div class="row">
	<div class="col-md-12" style="text-align: right;">
		<button class="btn btn-info" onclick="loadData()"></button>
		<button class="btn btn-primary my-btn" id="newImage" data-toggle="modal" data-target="#newprictures">Thêm Hình Ảnh</button>
	</div>
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">Danh Sách Hình Ảnh</div>
			<div class="card-body">
				<div class="table-responsive showdata"></div>
			</div>
		</div>
	</div>
</div>
<!-- Modal ./-->
<div class="modal fade" id="newprictures">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Thêm Hình Ảnh</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body newpic">
        Loading..
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<script>
	$(document).ready(function(){
		var page = <?php if(!isset($_GET['page'])){echo 0;}elseif($_GET['page']==""){echo 0;}else{echo $_GET['page'];} ?>;
		if (page==0)
		{
			$("#newImage").click(function(){
				$(".modal-body.newpic").load('/admin/pages/hinhanh/add.php');
			});
		}else{
			$("#newImage").click(function(){
				$(".modal-body.newpic").load('/admin/pages/hinhanh/add.php');
			});
		}
	});
	loadData();
	function loadData()
	{
		$(".btn.btn-info").html('<span class="spinner-border spinner-border-sm"></span>');
		var page = <?php if(isset($_GET['page']) && !empty($_GET['page'])){$page = htmlspecialchars(addslashes($_GET['page']));echo $page;}else{echo 0;} ?>;
		$.ajax({
			url: '/admin/function.php',
			method: 'post',
			data: {action:'getListSlider',page:page},
			success: function(data)
			{
				if (data){
					$(".showdata").html(data);
				}else
				{
					error();
				}
			},error:function()
			{
				error();
			}
		});
		$(".btn.btn-info").html('<i class="fa fa-refresh"></i>');
	}
	function error()
	{
		$(".showdata").html("<center>Không thể lấy dữ liệu.</center>");
	}
	function deleteImg(id)
	{
		swal({
		  title: "Bạn có chắc chứ?",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonClass: "btn-danger",
		  confirmButtonText: "Xóa!",
		  closeOnConfirm: false,
		  showLoaderOnConfirm: true
		},
		function(){
		  $.ajax({
		  	method: 'POST',
		  	url: '/admin/function.php',
		  	data: {action:'deleteImg',id:id},
		  	success: function(data)
		  	{
		  		if(data)
		  		{
		  			data = JSON.parse(data);
		  			if (data.sts==0)
		  			{
		  				swal("Thất bại!", data.msg, "danger");
		  			}else{
		  				swal("Thành công!", "", "success");
		  				loadData();
		  			}
		  			
		  		}
		  	}, error: function()
		  	{
		  		swal("Xảy ra lỗi!", "Mất kết nối.", "danger");
		  	}
		  });
		});
	}
	var clipboard = new ClipboardJS('.btn');

clipboard.on('success', function(e) {
    console.info('Action:', e.action);
    console.info('Text:', e.text);
    console.info('Trigger:', e.trigger);

    e.clearSelection();
});

clipboard.on('error', function(e) {
    console.error('Action:', e.action);
    console.error('Trigger:', e.trigger);
});
</script>