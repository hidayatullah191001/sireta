      <main id="main" class="p-3">
        <section id="services" class="services">
          <div class="container" data-aos="fade-up" >
           <?=$this->session->flashdata('message') ?>
           <div class="section-title">
            <h2><?=$title ?></h2>
            <div class=" d-flex flex-row-reverse">
              <a href="<?=base_url('admin/tambah_barang/') ?>" class="btn btn-primary btn-sm"><i class="bx bx-plus me-2"></i>Tambah Barang</a>
            </div>
          </div>

          <div class="shadow p-4 mb-5 bg-white rounded">
            <table id="tableuser" class="table table-striped table-bordered nowrap" style="width: 100%" >
              <thead class="bg-primary text-white">
                <tr>
                  <th>No</th>
                  <th>Nama Barang</th>
                  <th>Cabang</th>
                  <th>Stok</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody class="text-center">
                <?php 
                $i = 1;
                foreach ($barang as $brg) :?>
                  <tr>
                    <th scope="row"><?=$i++ ?></th>
                    <td><?=$brg['title'] ?></td>                    
                    <td><?=$brg['cabang'] ?></td>                    
                    <td><?=$brg['stok'] ?></td>                    
                    <td>
                      <a href="<?=base_url('admin/edit_akun/').$brg['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                      <a href="<?=base_url('admin/hapus_akun/').$brg['id']?>" onclick="return confirm('Yakin ingin hapus akun ini?')" class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>

          </div>
        </div>
      </section>
    </main>
