  <div class="container h-100">
    <div class="d-flex justify-content-center h-100">
      <div class="user_card">
        <div class="d-flex justify-content-center">
          <div class="brand_logo_container mb-3">
            <img src="<?=base_url('assets/login/img/logo.jpeg')?>" class="brand_logo" alt="Logo">
          </div>
        </div>
        <div class="d-flex justify-content-center form_container">
          <form method="post" action="<?=base_url('auth/register') ?>">

            <div class="input-group mb-2">
              <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
              </div>
              <input type="text" name="nama" id="nama" value="<?=set_value('nama') ?>" class="form-control input_user" value="" placeholder="Nama lengkap...">
            </div>
            <div class="mb-2">
              <?= form_error('nama', '<small class="text-white">', '</small>') ?>
            </div>

            <div class="input-group mb-2">
              <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
              </div>
              <input type="text" name="username" id="username" value="<?=set_value('username') ?>" class="form-control input_user" value="" placeholder="Nama pengguna...">
            </div>
            <div class="mb-2">
              <?= form_error('username', '<small class="text-white">', '</small>') ?>
            </div>

            <div class="row">
              <div class="col">
                <div class="input-group mb-2">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                  </div>
                  <input type="password" name="password1" id="password1" class="form-control input_pass" value="" placeholder="Kata sandi...">
                </div>
              </div>
              <div class="col">
                <div class="input-group mb-2">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                  </div>
                  <input type="password" name="password2" id="password2" class="form-control input_pass" value="" placeholder="Ulangi...">
                </div>
              </div>
            </div>
            <div class="mb-2">
              <?= form_error('password1', '<small class="text-white">', '</small>') ?>
            </div>
            <div class="form-group">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" onclick="lihatpw()" class="custom-control-input" id="customControlInline">
                <label class="custom-control-label" for="customControlInline">Lihat Password</label>
              </div>
            </div>
            <div class="d-flex justify-content-center mt-3 login_container">
              <button type="submit" name="button" class="btn login_btn">Daftar</button>
            </div>
          </form>
        </div>

        <div class="mt-4">
          <div class="d-flex justify-content-center links">
           Sudah punya akun? <a href="<?=base_url('auth') ?>" style="color: #fff" class="ml-2">Masuk disini</a>
         </div>
      </div>
    </div>
  </div>
</div>

