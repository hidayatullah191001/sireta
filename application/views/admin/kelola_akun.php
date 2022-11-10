      <main id="main" class="p-3">
        <section id="services" class="services">
          <div class="container" data-aos="fade-up" >
             <?=$this->session->flashdata('message') ?>
             <div class="section-title">
                <h2><?=$title ?></h2>
                <div class=" d-flex flex-row-reverse">
                  <a href="<?=base_url('admin/tambah_akun/') ?>" class="btn btn-primary btn-sm"><i class="bx bx-plus me-2"></i>Tambah Akun</a>
              </div>
          </div>

          <div class="shadow p-4 mb-5 bg-white rounded">
            <table id="tableuser" class="table table-striped table-bordered nowrap" style="width: 100%" >
              <thead class="bg-primary text-white">
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Tanggal Buat</th>
                  <th>Role</th>
                  <th>Status</th>
                  <th>Aksi</th>
              </tr>
          </thead>
          <tbody class="text-center">
            <?php 
            $i = 1;
            foreach ($akun as $ak) :?>
              <tr>
                <th scope="row"><?=$i++ ?></th>
                <td><?=$ak->nama ?></td>
                <td>  
                  <?php 
                  date_default_timezone_set('Asia/Jakarta');
                  echo date('d F Y',$ak->date_created); ?>
              </td>
              <td>
                <?php foreach ($role as $rl):?>
                  <?php if ($ak->role_id == $rl->id): ?>
                    <?php echo $rl->role ?>
                  <?php endif ?>
                <?php endforeach ?>
            </td>
            <td>
              <?php 
              $ak->status == 1? $status="Aktif":$status="Tidak Aktif";
              echo $status?>
          </td>
          <td>
              <a href="<?=base_url('admin/edit_akun/').$ak->id ?>" class="btn btn-primary btn-sm">Edit</a>
              <a href="<?=base_url('admin/hapus_akun/').$ak->id ?>" onclick="return confirm('Yakin ingin hapus akun ini?')" class="btn btn-danger btn-sm">Hapus</a>
          </td>
      </tr>
  <?php endforeach ?>
</tbody>
</table>

</div>
</div>
</section>
</main>
