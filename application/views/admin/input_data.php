      <main id="main" class="p-3">
        <section id="services" class="services">
          <div class="container" data-aos="fade-up" >
           <?=$this->session->flashdata('message') ?>
           <div class="section-title">
            <h2><?=$title ?></h2>
            <div class=" d-flex flex-row-reverse">
              <!-- <a href="<?=base_url('admin/tambah_akun/') ?>" class="btn btn-primary btn-sm"><i class="bx bx-plus"></i>Tambah Data</a> -->
          </div>
      </div>

      <div class="shadow p-4 mb-5 bg-white rounded">
        <h5>Upload Data</h5>
        <br>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="file">
            <?= form_error('file', '<br><small class="text-danger">', '</small>') ?>
            <br>
            <small class="text-danger">Format : xls, xlsx, pdf, ppt, pptx, doc, docx.</small><br> 
            <small class="text-danger">Catatan : File yang diupload maksimal 8 MB</small>
            <br>
            <br>
            <div class="form-group mb-3">
                <label class="mb-2" for="judul">Judul File</label>
                <input type="text" name="judul" class="form-control" value="<?=set_value('judul')?>" id="judul"placeholder="Masukkan judul..">
                <?= form_error('judul', '<small class="text-danger">', '</small>') ?>
            </div>
            <div class="form-group mb-3">
                <select id="kategori" name="kategori" class="form-control" id="exampleFormControlSelect1">
                    <option selected="" disabled="">--Pilih Kategori--</option>
                  <?php foreach ($kategori as $kg) : ?>
                    <option value="<?=$kg->id?>"><?=$kg->kategori ?></option>
                  <?php endforeach ?>
              </select>
              <?= form_error('kategori', '<small class="text-danger">', '</small>') ?>
          </div>
          <button class="btn btn-success" type="submit"><i class='bx bx-upload me-2'></i>Mengunggah</button>
      </form>
  </div>

  <div class="shadow p-4 mb-5 bg-white rounded">
        <h5>Backup Data</h5>
        <br>
        <a href="<?=base_url('admin/backup_data') ?>" class="btn btn-warning" type="button"><i class='bx bx-upload me-2'></i>Backup Data</a>
        <a  href="<?=base_url('admin/backup_db') ?>" class="btn btn-warning" type="button"><i class='bx bx-upload me-2'></i>Backup Database</a>
  </div>
</div>
</section>
</main>
