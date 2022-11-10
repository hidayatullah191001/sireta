    <main id="main" class="p-3">
      <section id="contact" class="contact">
        <div class="container">

          <div class="section-title">
            <h2><?=$title ?></h2>
            <div class="">
              <a href="<?=base_url('admin/input_barang') ?>" class="btn btn-primary btn-sm"><i class="bx bx-left-arrow-alt"></i>Kembali</a>
            </div>
          </div>

           <div class="shadow p-4 mb-5 bg-white rounded">
          <form action="<?=base_url('admin/tambah_barang') ?>" method="post" data-aos="fade-up">
            <div class="form-group mb-3">
              <label class="mb-2" for="name">Nama barang</label>
              <input type="text" name="barang" class="form-control" value="<?=set_value('barang')?>" id="barang"placeholder="Masukkan barang...">
            <?= form_error('barang', '<small class="text-danger">', '</small>') ?>
            </div>
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
              <label class="mb-2" for="name">Stok</label>
              <input type="text" name="stok" class="form-control" value="<?=set_value('stok')?>" id="stok"placeholder="Masukkan stok...">
            <?= form_error('stok', '<small class="text-danger">', '</small>') ?>
            </div>
            <div class="text-center">
              <button type="submit" class="mt-1 mb-3 btn btn-sm btn-primary">Tambah barang</button>
            </div>
          </form>
        </div>
        </section>
      </main>
