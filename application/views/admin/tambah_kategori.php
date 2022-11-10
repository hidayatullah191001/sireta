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
              <input type="text" name="kategori" class="form-control" id="kategori" placeholder="Masukkan kategori baru...">
              <?= form_error('kategori', '<small class="text-danger">', '</small>') ?>
            </div>
            <button type="submit" class="btn btn-success btn-sm"><i class="bx bx-plus me-2"></i>Tambah Kategori</button>
          </form>
        </div>
        <div class="col-sm-8 shadow p-4 mb-5 bg-white rounded">
          <table id="tableuser" class="table table-striped table-bordered nowrap" style="width: 100%" >
            <thead class="bg-primary text-white">
              <tr>
                <th width="30px">No</th>
                <th>Kategori</th>
                <th width="100px">Aksi</th>
              </tr>
            </thead>
            <tbody class="text-center">
              <?php 
              $no = 1;
              foreach ($kategori as $kg):?>
                <tr>
                  <td><?=$no++ ?></td>
                  <td><?=$kg->kategori ?></td>
                  <td>
                    <a href="<?=base_url('admin/edit_kategori/').$kg->id?>" class="btn btn-primary btn-sm">Edit</a>
                    <a href="<?=base_url('admin/hapus_kategori/').$kg->id?>" onclick="return confirm('Yakin ingin hapus kategori ini?')" class="btn btn-danger btn-sm">Hapus</a>
                  </td>
                <?php endforeach ?>
              </tr>
            </tbody>
          </table>
        </div>
      </section>
    </main>