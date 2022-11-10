  <div class="container h-100">
    <center>
      <div class="col-md-4">
        <?=$this->session->flashdata('message') ?>
      </div>
    </center>
    <div class="d-flex justify-content-center h-100">
      <div class="user_card">
        <div class="d-flex justify-content-center">
          <div class="brand_logo_container">
            <img src="<?=base_url('assets/login/img/logo.jpeg')?>" class="brand_logo" alt="Logo">
          </div>
        </div>
        <div class="d-flex justify-content-center form_container">
          <form method="post" action="<?=base_url('auth')?>">
            <div class="input-group mb-3">
              <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
              </div>
              <input type="text" name="username" id="username" class="form-control input_user" value="" placeholder="Nama pengguna...">
            </div>
            <div class="input-group mb-2">
              <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-key"></i></span>
              </div>
              <input type="password" name="password" id="password1" class="form-control input_pass" value="" placeholder="Kata sandi...">
            </div>
            <div class="form-group">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" onclick="lihatpw()" class="custom-control-input" id="customControlInline">
                <label class="custom-control-label" for="customControlInline">Lihat Kata Sandi</label>
              </div>
            </div>
            <div class="d-flex justify-content-center mt-3 login_container">
              <button type="submit" name="button" class="btn login_btn">Masuk</button>
            </div>
          </form>
        </div>

        <div class="mt-4">
          <div class="d-flex justify-content-center links">
            Belum punya akun? Hubungi Admin
          </div>
        </div>
      </div>
    </div>
  </div>
