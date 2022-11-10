      <main id="main" class="p-3">
        <section id="services" class="services">
          <div class="container" data-aos="fade-up" >
           <?=$this->session->flashdata('message') ?>
           <div class="section-title">
            <h2><?=$title ?></h2>
          </div>

          <div class="shadow p-4 mb-5 bg-white rounded">
            <table id="tableuser" class="table table-striped table-bordered nowrap" style="width: 100%" >
              <thead class="bg-primary text-white">
                <tr>
                  <th>No</th>
                  <th>Judul</th>
                  <th>Tanggal Upload</th>
                  <th>File Upload</th>
                  <th>Pengupload</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody class="text-center">
                <?php 
                $i = 1;
                foreach ($list as $ls) :?>
                  <tr>
                    <th scope="row"><?=$i++ ?></th>
                    <td>
                      <?php
                      $kalimat = $ls->judul ;
                      $max = 20;
                      $cetak = substr($kalimat, 0, $max);
                      if (strlen($kalimat)>$max) {
                        echo $cetak.'...';
                      }else{
                        echo $cetak;
                      }?>
                    </td>
                    <td>
                       <?php echo $ls->date_uploaded; ?>
                    </td>
                    <td>
                      <a target="_blank" href="<?=base_url('assets/file/upload/').$ls->nama_file ?>">
                        <?php
                        $kalimat = $ls->nama_file;
                        $max = 20;
                        $cetak = substr($kalimat, 0, $max);
                        if (strlen($kalimat)>$max) {
                          echo $cetak.'...';
                        }else{
                          echo $cetak;
                        }?>
                      </a>
                    </td>
                    <td>
                      <?php foreach ($akun as $ak) : ?>
                        <?php if ($ak->id == $ls->id_user) {
                          echo $ak->nama;
                        } ?>
                      <?php endforeach ?>
                    </td>
                    <td>
                      <?php if ($idkategori != null):?>
                        <a href="<?=base_url('admin/edit_list/').$idkategori."/".$ls->id ?>" class="btn btn-primary btn-sm">Edit</a>
                        <a href="<?=base_url('admin/hapus_list/').$idkategori."/".$ls->id ?>" onclick="return confirm('Yakin ingin hapus list data ini?')" class="btn btn-danger btn-sm">Hapus</a>

                        <?php else : ?>
                          <a href="<?=base_url('admin/edit_list/').$ls->id ?>" class="btn btn-primary btn-sm">Edit</a>
                          <a href="<?=base_url('admin/hapus_list/').$ls->id ?>" onclick="return confirm('Yakin ingin hapus list data ini?')" class="btn btn-danger btn-sm">Hapus</a>
                        <?php endif ?>
                      </td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>

            </div>
          </div>
        </section>
      </main>
