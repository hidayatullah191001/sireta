		<main id="main" class="p-3">
			<section id="contact" class="contact">
				<div class="container">

					<div class="section-title">
						<h2><?=$title .' '. $akun->nama?></h2>
						<div class="">
							<a href="<?=base_url('admin/kelola_akun') ?>" class="btn btn-primary btn-sm"><i class="bx bx-left-arrow-alt"></i>Kembali</a>
						</div>
					</div>

					<div class="shadow p-4 mb-5 bg-white rounded">
						<form action="" method="post" data-aos="fade-up">
							<input type="hidden" name="id" value="<?= $akun->id; ?>">

							<div class="form-group mb-3">
								<label class="mb-2" for="name">Nama Lengkap</label>
								<input type="text" name="nama" class="form-control" value="<?=$akun->nama ?>" id="nama"placeholder="Masukkan Nama...">
								<?= form_error('nama', '<small class="text-danger">', '</small>') ?>
							</div>
							<div class="form-group mb-3">
								<label class="mb-2" for="name">Username</label>
								<input type="text" readonly="true" name="username" id="username" class="form-control" value="<?=$akun->username ?>"">
								<?= form_error('nama', '<small class="text-danger">', '</small>') ?>
							</div>
							<div class="form-group mb-3">
								<label class="mb-2" for="name">Role</label>
								<select class="form-control" name="role" id="role">
									<?php foreach ($role_id as $rl ): ?>
										<?php if ($akun->role_id == $rl['id']) {
											echo "<option selected value= '".$rl['id']."'>".$rl['role']."</option>'";
										} else{
											echo "<option value= '".$rl['id']."'>".$rl['role']."</option>'";
										}
										?>
									<?php endforeach ?>
								</select>
							</div>

							<div class="form-group col-md-6 mb-3">
								<?php 
								$data = array(
									'class'         => 'form-check-input'
								);
								if ($akun->status == 0): ?>
									<?= form_checkbox('status','1',FALSE,$data)."Aktif kan Akun";?>
								<?php endif ?>

								<?php if ($akun->status == 1): ?>
									<?= form_checkbox('status','1',TRUE,$data)."Aktif kan Akun";?>
								<?php endif ?>
							</div>

							<div class="form-group form-check col-md-6 mb-3">
								<input type="checkbox" class="form-check-input" id="cekubah" onclick="ubahpw()">
								<label class="form-check-label" for="exampleCheck1">Ubah Password</label>
							</div>

							<div hidden="" id="formpw" class="row mb-3">
								<div class="form-group col-md-6">
									<label class="mb-2" for="name">Password Baru</label>
									<input type="password" placeholder="Masukkan Password Baru..." class="form-control" name="password1" id="password1">
									<?= form_error('password1', '<small class="text-danger">', '</small>') ?>
								</div>
								<div class="form-group col-md-6">
									<label class="mb-2" for="name">Ulangi Password</label>
									<input type="password" placeholder="Ulangi Password..." class="form-control" name="password2" id="password2">
								</div>
							</div>
							<div hidden="" id="cekpw" class="form-group col-md-6 mb-3">
								<input type="checkbox" class="form-check-input" id="cek" onclick="lihatpw()">
								<label class="form-check-label" for="exampleCheck1">Lihat Password</label>
							</div>

							<div class="form-group mb-3">
								<input hidden="" type="text" name="pwlama" class="form-control" value="<?=$akun->password ?>" id="pwlama">
							</div>

							<div class="text-center">
								<button type="submit" class="mt-1 mb-3 btn btn-sm btn-primary">Perbarui Akun!</button>
							</div>
						</form>
					</div>
				</div>
				</section>
			</main>

			<script type="text/javascript">
				function ubahpw(){
					var cekubah = document.getElementById('cekubah');
					var formpw = document.getElementById('formpw');
					var cekpw = document.getElementById('cekpw');

					if (cekubah.checked == true) {
						formpw.hidden = false;
						cekpw.hidden = false;
					}else{
						formpw.hidden = true;
						cekpw.hidden = true;
					}
				}
			</script>