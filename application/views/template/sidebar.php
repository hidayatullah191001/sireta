<!-- ======= Mobile nav toggle button ======= -->
<i class="bi bi-list mobile-nav-toggle d-xl-none"></i>


<?php 
$rolee = $this->session->userdata('role_id');
if ($rolee == 1) : ?>
	<!-- ======= Header Admin ======= -->
	<header id="header">
		<div class="d-flex flex-column">

			<div class="profile">
				<img  style="object-fit: cover; height: 120px" src="<?=base_url('assets/profile/').$user['image']?>" class="img-fluid rounded-circle">
				<h1 class="text-light"><a href="<?=base_url('admin') ?>"><?=$user['nama'] ?></a></h1>
				<?php foreach ($role as $rl) : ?>
					<?php if ($rl->id == $rolee): ?>
						<h6 class="text-light text-center">Masuk sebagai <?=$rl->role ?></h6>
					<?php endif ?>
				<?php endforeach ?>
			</div>

			<nav id="navbar" class="nav-menu navbar">
				<ul>
					<span class="text-light">Admin</span>
					<hr>
					<li <?php if ($title == "Beranda") echo "class='active'";?>>
						<a href="<?=base_url('admin') ?>" class="nav-link scrollto"><i class="bx bx-home"></i> <span>Beranda</span></a>
					</li>

					<li <?php if ($title == "Manajemen Akun") echo "class='active'";?>>
						<a href="<?=base_url('admin/kelola_akun') ?>" class="nav-link scrollto"><i class="bx bx-user-plus"></i><span>Manajemen Akun</span></a>
					</li>
					<li <?php if ($title == "Edit Profile") echo "class='active'";?>>
						<a href="<?=base_url('admin/profile') ?>" class="nav-link scrollto"><i class='bx bxs-user-detail'></i><span>Edit Profile</span></a>
					</li>
					<li <?php if ($title == "Tambah Kategori") echo "class='active'";?>>
						<a href="<?=base_url('admin/tambah_kategori') ?>" class="nav-link scrollto"><i class="bx bx-plus"></i><span>Tambah Kategori</span></a>
					</li>

					<span class="text-light">Menu</span>
					<hr >
					<li <?php if ($title == "Input Data") echo "class='active'";?>>
						<a href="<?=base_url('admin/input_data') ?>" class="nav-link scrollto"><i class="bx bx-plus"></i><span>Input</span></a>
					</li>

					<li <?php if ($title == "Data Barang") echo "class='active'";?>>
						<a href="<?=base_url('admin/input_barang') ?>" class="nav-link scrollto"><i class="bx bx-plus"></i><span>Input Barang</span></a>
					</li>

					<li <?php if ($title == "Data Stok") echo "class='active'";?>>
						<a href="<?=base_url('admin/data_stok') ?>" class="nav-link scrollto"><i class="bx bx-list-ul"></i><span>Data Stok</span></a>
					</li>

					<li class="nav-item dropdown">
						<a class="nav-link scrollto dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="true"><i class="bx bx-list-ul"></i> <span>List</span></a>
						<ul class="dropdown-menu" style="background-color: #040b14; border-color: #040b14">
							<?php foreach ($kategori as $kg) : ?>
								<li <?php if ($title == $kg->kategori) echo "class='active'";?>>
									<a href="<?=base_url('admin/list_data/').$kg->id ?>" class="nav-link scrollto ms-4"><i class="bx bx-list-ul"></i><span><?=$kg->kategori ?></span></a>
								</li>
							<?php endforeach ?>
							<li <?php if ($title == "Semua List Data") echo "class='active'";?>>
								<a href="<?=base_url('admin/list_data/')?>" class="nav-link scrollto ms-4"><i class="bx bx-list-ul"></i><span>Semua List Data</span></a>
							</li>
							<hr>
							<li>
								<a href="<?=base_url('auth/logout')?>" class="nav-link scrollto text-danger"><i class='bx bx-log-out text-danger'></i> <span>Keluar</span></a>
							</li>
							<br><br><br><br><br>
						</ul>
					</li>
					<hr>
					<li>
						<a href="<?=base_url('auth/logout')?>" class="nav-link scrollto text-danger"><i class='bx bx-log-out text-danger'></i> <span>Keluar</span></a>
					</li>
					<br><br><br><br><br>
				</ul>
			</nav><!-- .nav-menu -->
		</div>
	</header><!-- End Header -->

	<?php elseif ($rolee == 2) : ?>
		<!-- ======= Header User ======= -->
		<header id="header">
			<div class="d-flex flex-column">

				<div class="profile">
					<img  style="object-fit: cover; height: 120px" src="<?=base_url('assets/profile/').$user['image']?>" class="img-fluid rounded-circle">
					<h1 class="text-light"><a href="<?=base_url('user') ?>"><?=$user['nama'] ?></a></h1>
					<?php foreach ($role as $rl) : ?>
						<?php if ($rl->id == $rolee): ?>
							<h6 class="text-light text-center">Masuk sebagai <?=$rl->role ?></h6>
						<?php endif ?>
					<?php endforeach ?>
				</div>

				<nav id="navbar" class="nav-menu navbar">
					<ul>
						<span class="text-light">Pengguna</span>
						<hr>
						<li <?php if ($title == "Dashboard") echo "class='active'";?>>
							<a href="<?=base_url('user') ?>" class="nav-link scrollto"><i class="bx bx-home"></i> <span>Beranda</span></a>
						</li>

						<li class="nav-item dropdown">
							<a class="nav-link scrollto dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="true"><i class="bx bx-library"></i><span>Library</span></a>
							<ul class="dropdown-menu" style="background-color: #040b14; border-color: #040b14">
								<?php foreach ($kategori as $kg) : ?>
<!-- 									<?php 

										$encodestring = urlencode($kg->kategori);

									 ?> -->
									<li <?php if ($title == $kg->kategori) echo "class='active'";?>>
										<a href="<?=base_url('user/library/?param=').$kg->id?>" class="nav-link scrollto ms-4"><i class="bx bx-library"></i><span><?=$kg->kategori ?></span></a>
									</li>
								<?php endforeach ?>

								<li <?php if ($title == "Semua Library") echo "class='active'";?>>
									<a href="<?=base_url('user/library/')?>" class="nav-link scrollto ms-4"><i class="bx bx-library"></i><span>Semua Library</span></a>
								</li>

								<li <?php if ($title == "Item Tersimpan") echo "class='active'";?>>
									<a href="<?=base_url('user/bookmark') ?>" class="nav-link scrollto"><i class="bx bx-bookmark-alt-plus"></i><span>Item Tersimpan</span></a>
								</li>
								
								<span class="text-light">Pengaturan</span>
								<hr>
								<li <?php if ($title == "Edit Profile") echo "class='active'";?>>
									<a href="<?=base_url('user/profile') ?>" class="nav-link scrollto"><i class='bx bxs-user-detail'></i><span>Edit Profile</span></a>
								</li>

								<li <?php if ($title == "Ubah Kata Sandi") echo "class='active'";?>>
									<a href="<?=base_url('user/ubah_password') ?>" class="nav-link scrollto"><i class='bx bxs-key'></i><span>Ubah Kata Sandi</span></a>
								</li>
								<hr>
								<li>
									<a href="<?=base_url('auth/logout')?>" class="nav-link scrollto text-danger"><i class='bx bx-log-out text-danger'></i> <span>Keluar</span></a>
								</li>
								<br><br><br><br><br>
							</ul>
						</li>

						<li <?php if ($title == "Item Tersimpan") echo "class='active'";?>>
							<a href="<?=base_url('user/bookmark') ?>" class="nav-link scrollto"><i class="bx bx-bookmark-alt-plus"></i><span>Item Tersimpan</span></a>
						</li>
						
						<span class="text-light">Pengaturan</span>
						<hr>
						<li <?php if ($title == "Edit Profile") echo "class='active'";?>>
							<a href="<?=base_url('user/profile') ?>" class="nav-link scrollto"><i class='bx bxs-user-detail'></i><span>Edit Profile</span></a>
						</li>

						<li <?php if ($title == "Ubah Kata Sandi") echo "class='active'";?>>
							<a href="<?=base_url('user/ubah_password') ?>" class="nav-link scrollto"><i class='bx bxs-key'></i><span>Ubah Kata Sandi</span></a>
						</li>
						<hr>
						<li>
							<a href="<?=base_url('auth/logout')?>" class="nav-link scrollto text-danger"><i class='bx bx-log-out text-danger'></i> <span>Keluar</span></a>
						</li>
						<br><br><br><br><br>
					</ul>
				</nav><!-- .nav-menu -->
			</div>
		</header><!-- End Header -->

		<?php elseif ($rolee == 3) : ?>
			<!-- ======= Header Manager ======= -->
			<header id="header">
				<div class="d-flex flex-column">

					<div class="profile">
						<img  style="object-fit: cover; height: 120px" src="<?=base_url('assets/profile/').$user['image']?>" class="img-fluid rounded-circle">
						<h1 class="text-light"><a href="<?=base_url('manager') ?>"><?=$user['nama'] ?></a></h1>
						<?php foreach ($role as $rl) : ?>
							<?php if ($rl->id == $rolee): ?>
								<h6 class="text-light text-center">Masuk sebagai <?=$rl->role ?></h6>
							<?php endif ?>
						<?php endforeach ?>
					</div>

					<nav id="navbar" class="nav-menu navbar">
						<ul>
							<span class="text-light">Manager</span>
							<hr>
							<li <?php if ($title == "Beranda") echo "class='active'";?>>
								<a href="<?=base_url('manager') ?>" class="nav-link scrollto"><i class="bx bx-home"></i> <span>Beranda</span></a>
							</li>

							<li class="nav-item dropdown">
								<a class="nav-link scrollto dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="true"><i class='bx bx-notepad'></i><span>Lihat Laporan</span></a>
								<ul class="dropdown-menu" style="background-color: #040b14; border-color: #040b14">
									<?php foreach ($kategori as $kg) : ?>
										<li <?php if ($title == $kg->kategori) echo "class='active'";?>>
											<a href="<?=base_url('manager/laporan/').$kg->id ?>" class="nav-link scrollto ms-4"><i class='bx bx-notepad'></i><span><?=$kg->kategori ?></span></a>
										</li>
									<?php endforeach ?>
									<li <?php if ($title == "Lihat Semua Laporan") echo "class='active'";?>>
										<a href="<?=base_url('manager/laporan/')?>" class="nav-link scrollto ms-4"><i class='bx bx-notepad'></i><span>Lihat Semua Laporan</span></a>
									</li>
									<span class="text-light">Pengaturan</span>
									<hr>
									<li <?php if ($title == "Edit Profile") echo "class='active'";?>>
										<a href="<?=base_url('manager/profile') ?>" class="nav-link scrollto"><i class='bx bxs-user-detail'></i><span>Edit Profile</span></a>
									</li>

									<li <?php if ($title == "Ubah Kata Sandi") echo "class='active'";?>>
										<a href="<?=base_url('manager/ubah_password') ?>" class="nav-link scrollto"><i class='bx bxs-key'></i><span>Ubah Kata Sandi</span></a>
									</li>
									<hr>
									<li>
										<a href="<?=base_url('auth/logout')?>" class="nav-link scrollto text-danger"><i class='bx bx-log-out text-danger'></i> <span>Keluar</span></a>
									</li>
									<br><br><br><br><br>
								</ul>
							</li>
							<span class="text-light">Pengaturan</span>
							<hr>
							<li <?php if ($title == "Edit Profile") echo "class='active'";?>>
								<a href="<?=base_url('manager/profile') ?>" class="nav-link scrollto"><i class='bx bxs-user-detail'></i><span>Edit Profile</span></a>
							</li>

							<li <?php if ($title == "Ubah Kata Sandi") echo "class='active'";?>>
								<a href="<?=base_url('manager/ubah_password') ?>" class="nav-link scrollto"><i class='bx bxs-key'></i><span>Ubah Kata Sandi</span></a>
							</li>
							<hr>
							<li>
								<a href="<?=base_url('auth/logout')?>" class="nav-link scrollto text-danger"><i class='bx bx-log-out text-danger'></i> <span>Keluar</span></a>
							</li>
						</ul>
					</nav><!-- .nav-menu -->
				</div>
			</header><!-- End Header -->

			<?php endif ?>