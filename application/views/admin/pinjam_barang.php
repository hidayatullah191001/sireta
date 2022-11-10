    <main id="main" class="p-3">
      <section id="contact" class="contact">
        <div class="container">

          <div class="section-title">
            <h2><?=$title ?></h2>
            <div class="">
              <a href="<?=base_url('admin/data_stok') ?>" class="btn btn-primary btn-sm"><i class="bx bx-left-arrow-alt"></i>Kembali</a>
            </div>
          </div>

          <?=$this->session->flashdata('message') ?>
          <div class="shadow p-4 mb-5 bg-white rounded">
            <form action="<?=base_url('admin/pinjam_barang/'.$barang['id']) ?>" method="post" data-aos="fade-up">
              <div class="form-group mb-3">
                <label class="mb-2" for="name">Cabang</label>
                <select class="form-control" name="cabang" id="cabang">
                  <option selected="" disabled="">--Pilih cabang--</option>
                  <?php foreach ($cabang as $cbg) : ?>
                    <option value="<?=$cbg->id ?>"><?=$cbg->cabang ?></option>
                  <?php endforeach ?>
                </select>
                <?= form_error('cabang', '<small class="text-danger">', '</small>') ?>

              </div>
              <div class="form-group mb-3">
                <label class="mb-2" for="name">Pinjam</label>
                <input type="text" name="pinjam" class="form-control" value="<?=set_value('pinjam')?>" id="pinjam"placeholder="Masukkan banyak pinjam...">
                <?= form_error('pinjam', '<small class="text-danger">', '</small>') ?>
              </div>
              <div class="form-group mb-3">
                <label class="mb-2" for="name">Keterangan</label>
                <input type="text" name="ket" class="form-control" value="<?=set_value('ket')?>" id="ket"placeholder="Masukkan keterangan...">
                <?= form_error('ket', '<small class="text-danger">', '</small>') ?>
              </div>
              <div class="text-center">
                <button type="submit" class="mt-1 mb-3 btn btn-sm btn-primary">Pinjam barang</button>
              </div>
            </form>
          </div>
        </section>
      </main>
