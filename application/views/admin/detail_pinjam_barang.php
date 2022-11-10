   <main id="main" class="p-3">
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <h2><?=$title ?></h2>
          <div class="">
            <a href="<?=base_url('admin/data_stok') ?>" class="btn btn-primary btn-sm"><i class="bx bx-left-arrow-alt"></i>Kembali</a>
          </div>
        </div>
        <div class="shadow p-4 mb-5 bg-white rounded">
          <h3><b>Lokasi Cabang : <?=$detail_pinjam['cabang'] ?></b></h3>
          <br>
          <h5>Barang : <?=$detail_pinjam['title'] ?></h5>
          <h5>Tanggal pinjam : <?php 
          date_default_timezone_set('Asia/Jakarta');
          echo date('d F Y',$detail_pinjam['date_created']); ?></h5>
          <h5>Total Pinjam : <?=$detail_pinjam['pinjam'] ?></h5>
          <h5>Keterangan : <?=$detail_pinjam['ket'] ?></h5>
          <br>
        </div>
      </div>
    </section>
  </main>
