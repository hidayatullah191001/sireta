    <main id="main" class="p-3">
      <section id="contact" class="contact">
        <div class="container">

          <div class="section-title">
            <h2><?=$title ?></h2>
            <div class="">
              <a href="<?=base_url('admin/kelola_akun') ?>" class="btn btn-primary btn-sm"><i class="bx bx-left-arrow-alt"></i>Kembali</a>
            </div>
          </div>

           <div class="shadow p-4 mb-5 bg-white rounded">
          <form action="<?=base_url('admin/tambah_akun') ?>" method="post" data-aos="fade-up">
            <div class="form-group mb-3">
              <label class="mb-2" for="name">Nama Lengkap</label>
              <input type="text" name="nama" class="form-control" value="<?=set_value('nama')?>" id="nama"placeholder="Masukkan Nama...">
            <?= form_error('nama', '<small class="text-danger">', '</small>') ?>
            </div>
            <div class="form-group mb-3">
              <label class="mb-2" for="name">Username</label>
              <input type="text" class="form-control" name="username" id="username" value="<?=set_value('username')?>" placeholder="Masukkan Username...">
            <?= form_error('username', '<small class="text-danger">', '</small>') ?>
            </div>
            <div class="form-group mb-3">
              <label class="mb-2" for="name">Role</label>
              <select class="form-control" name="role" id="role">
                <option selected="" disabled="">--Pilih Role--</option>
                <?php foreach ($role as $rl) : ?>
                <option value="<?=$rl->id ?>"><?=$rl->role ?></option>
              <?php endforeach ?>
              </select>
            </div>
            <div class="row mb-3">
              <div class="form-group col-md-6">
                <label class="mb-2" for="name">Password</label>
                <input type="password" placeholder="Masukkan Password..." class="form-control" name="password1" id="password1">
                 <?= form_error('password1', '<small class="text-danger">', '</small>') ?>
              </div>
              <div class="form-group col-md-6">
                <label class="mb-2" for="name">Ulangi Password</label>
                <input type="password" placeholder="Ulangi Passwrod..." class="form-control" name="password2" id="password2">
              </div>
            </div>

            <div class="form-group form-check mb-3">
              <input type="checkbox" class="form-check-input" id="cek" onclick="lihatpw()">
              <label class="form-check-label" for="exampleCheck1">Lihat Password</label>
            </div>

            <div class="text-center">
              <button type="submit" class="mt-1 mb-3 btn btn-sm btn-primary">Daftarkan Akun!</button>
            </div>
          </form>
        </div>
        </section>
      </main>
