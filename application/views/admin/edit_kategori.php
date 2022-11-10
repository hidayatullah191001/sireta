     <main id="main" class="p-3">
      <section id="services" class="services">
        <div class="container" data-aos="fade-up" >
         <?=$this->session->flashdata('message') ?>
         <div class="section-title">
          <h2><?=$title ?></h2>

        </div>
        <div class="col-sm-8 shadow p-4 mb-5 bg-white rounded">
          <form action="" method="post">
            <input type="hidden" name="id" value="<?= $user['id']; ?>">
            <div class="form-group mb-3">
              <label class="mb-2" for="name">Nama Kategori Baru</label>
              <input type="text" name="kategori" class="form-control" id="kategori" placeholder="Masukkan kategori baru..." value="<?=$kategori2['kategori'] ?>">
              <?= form_error('kategori', '<small class="text-danger">', '</small>') ?>
            </div>
            <button type="submit" class="btn btn-success btn-sm"><i class="bx bx-plus me-2"></i>Edit Kategori</button>
          </form>
        </div>
        
      </section>
    </main>