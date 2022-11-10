		<main id="main" class="p-3">
			<section id="contact" class="contact">
				<div class="container">

					<div class="section-title">
						<h2><?=$title .' '. $list->judul?></h2>
						<div class="">
							<?php if ($idkategori != null): ?>

								<a href="<?=base_url('admin/list_data/').$idkategori?>" class="btn btn-primary btn-sm"><i class="bx bx-left-arrow-alt"></i>Kembali</a>
								<?php else :  ?>
									<a href="<?=base_url('admin/list_data/').$idkategori?>" class="btn btn-primary btn-sm"><i class="bx bx-left-arrow-alt"></i>Kembali</a>
								<?php endif ?>
							</div>
						</div>

						<div class="shadow p-4 mb-5 bg-white rounded">
							<form action="" method="post" data-aos="fade-up" enctype="multipart/form-data">
								<input type="hidden" name="id" value="<?= $list->id; ?>">
								<div class="form-group mb-3">
									<label class="mb-2" for="name">Judul</label>
									<input type="text" name="judul" class="form-control" value="<?=$list->judul ?>" id="judul" placeholder="Masukkan judul...">
									<?= form_error('judul', '<small class="text-danger">', '</small>') ?>
								</div>
								<div class="form-group mb-3">
								    <label class="mb-2" for="name">Kategori</label>
									<select id="kategori" name="kategori" class="form-control" id="exampleFormControlSelect1">
										<?php if ($list->id_kategori == 0) {
											echo "<option selected >--Pilih Kategori--</option>'";
										} ?>

										<?php foreach ($kategori as $kg): ?>
											<?php if ($list->id_kategori == $kg->id) {
											echo "<option selected value= '".$kg->id."'>".$kg->kategori."</option>'";
											} else{
											echo "<option value= '".$kg->id."'>".$kg->kategori."</option>'";
											}
										?>
										<?php endforeach ?>
									</select>
								</div>
								<div class="form-group mb-3">
									<input type="file" name="file" id="file">
									<?= form_error('file', '<br><small class="text-danger">', '</small>') ?>
									<br>
									<small class="text-danger">Format : xls, xlsx, pdf, ppt, pptx, doc, docx.</small><br> 
									<small class="text-danger">Catatan : File yang diupload maksimal 8 MB</small>
								</div>
								<div>
									<button type="submit" class="mt-1 mb-3 btn btn-sm btn-primary">Perbarui data!</button>
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