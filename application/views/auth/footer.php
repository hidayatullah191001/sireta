
</body>
</html>

<script type="text/javascript">
  function lihatpw(){

    var cek = document.getElementById('customControlInline');
    var pw1 = document.getElementById('password1');
    var pw2 = document.getElementById('password2');
    if (cek.checked == true) {
      pw1.type = 'text';
      pw2.type = 'text';
    }else{
      pw1.type = 'password';
      pw2.type = 'password';
    }
  }
</script>