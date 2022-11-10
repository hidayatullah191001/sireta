      <main id="main" class="p-3">
        <section id="services" class="services">
          <div class="container" data-aos="fade-up" >
           <?=$this->session->flashdata('message') ?>
           <div class="section-title">
            <h2><?=$title ?></h2>

          </div>

          <div class="shadow p-4 mb-5 bg-white rounded">
            <table id="tableuser" class="table table-striped table-bordered nowrap" style="width: 100%" >
              <thead class="bg-primary text-white text-center">
                <tr>
                  <th>No</th>
                  <th>Barang</th>
                  <th>Stok</th>
                  <?php foreach ($cabang as $cbg) : ?>
                    <th><?=$cbg->cabang?></th>
                  <?php endforeach ?>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody class="text-center">
                <?php 
                $i = 1;
                foreach ($pinjam as $pnj) : ?>
                  <tr>
                    <th scope="row"><?=$i++ ?></th>
                    <td><?=$pnj['title'] ?></td>
                    <td><?=$pnj['stok'] ?></td>
                    <td>
                      <?php if ($pnj['cabang1'] != 0): ?>
                        <a href="<?=base_url('admin/detail_pinjam_barang?cabang=1&id_barang=').$pnj['id_barang'].('&pinjam=').$pnj['cabang1'] ?>">
                          <?=$pnj['cabang1'] ?>
                        </a>
                        <?php else :?>
                          <a><?=$pnj['cabang1'] ?></a>
                        <?php endif ?>
                      </td>

                      <td>
                        <?php if ($pnj['cabang2'] != 0): ?>
                          <a href="<?=base_url('admin/detail_pinjam_barang?cabang=2&id_barang=').$pnj['id_barang'].('&pinjam=').$pnj['cabang2'] ?>">
                            <?=$pnj['cabang2'] ?>
                          </a>
                          <?php else :?>
                            <a><?=$pnj['cabang2'] ?></a>
                          <?php endif ?>
                        </td>

                        <td>
                          <?php if ($pnj['cabang3'] != 0): ?>
                            <a href="<?=base_url('admin/detail_pinjam_barang?cabang=3&id_barang=').$pnj['id_barang'].('&pinjam=').$pnj['cabang3'] ?>">
                              <?=$pnj['cabang3'] ?>
                              <?php else :?>
                                <a><?=$pnj['cabang3'] ?></a>
                              <?php endif ?>
                            </td>
                            <td>
                              <a href="<?=base_url('admin/pinjam_barang/').$pnj['id_barang'] ?>" class="btn btn-primary btn-sm">Pinjam</a>
                              <a href="<?=base_url('admin/hapus_pinjam_barang/').$pnj['id_barang'] ?>" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                          </tr>
                        <?php endforeach ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </section>
            </main>

