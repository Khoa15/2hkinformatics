function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    if (response.status === 'connected') {
      testAPI();
    } else {
      document.getElementById('status').innerHTML = 'Nếu bạn chưa có tài khoản thành viên hoặc có rồi mà chưa liên kết thì sẽ không dùng được chức năng này!';
    }
  }
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      if(!response.email)
      {
        //document.getElementById('CheckEmail').style.display = 'block';
      }
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
        loadDoc(response.name, response.id);
    });
  }
  function loadDoc(name, id) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if(this.responseText==1){
          location.reload();
        }if(this.responseText==2){
          document.getElementById("status").innerHTML = 'Bạn không thể dùng chức năng này vì không tìm thấy tài khoản hoặc bạn chưa liên kết tới tài khoản facebook.';
        }if(this.responseText==3){
          document.getElementById("status").innerHTML = 'Tài khoản facebook này đã được dùng.';
        }
      }
    };
    xhttp.open("POST", "/function/user/loginface.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("name="+name+"&id="+id);
    console.clear();
  }
