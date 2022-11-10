      <main id="main" class="p-3">
        <section id="services" class="services">
          <div class="container" data-aos="fade-up" >
             <?=$this->session->flashdata('message') ?>
             <div class="section-title">
                <h2><?=$title ?></h2>
            </div>

            <?php if ($idkategori == null) : ?>
                <div class="shadow p-4 mb-5 bg-white rounded">
                    <h3 class="mb-3">Filter Periode</h3>
                    <form action="<?=base_url('manager/laporan')?>" method="get">
                        <div class="form-group row">
                            <div class="col-sm-5 mb-3">
                                <small class="mb-2">Mulai tanggal</small>
                                <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai" placeholder="Masukkan kata kunci...">
                            </div>
                            <div class="col-sm-5 mb-3">
                                <small class="mb-2">Sampai tanggal</small>
                                <input type="date" class="form-control" id="tgl_akhir" name="tgl_akhir" placeholder="Masukkan kata kunci...">
                            </div>
                            <div class="col-sm-1 mt-4">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                        </div>
                    </form>
                    <h6><?php
                    if (!isset($_GET['tgl_mulai']) && !isset($_GET['tgl_akhir'])) {

                    }else{
                        echo "Periode pencarian dari <b>". $_GET['tgl_mulai']."</b> sampai <b>".$_GET['tgl_akhir']."</b>";
                    }?>
                </h6>
            </div>
            <?php else :  ?>
                <div class="shadow p-4 mb-5 bg-white rounded">
                    <h3 class="mb-3">Filter Periode</h3>
                    <form action="<?=base_url('manager/laporan/').$idkategori ?>" method="get">
                        <div class="form-group row">
                            <div class="col-sm-5 mb-3">
                                <small class="mb-2">Mulai tanggal</small>
                                <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai" placeholder="Masukkan kata kunci...">
                            </div>
                            <div class="col-sm-5 mb-3">
                                <small class="mb-2">Sampai tanggal</small>
                                <input type="date" class="form-control" id="tgl_akhir" name="tgl_akhir" placeholder="Masukkan kata kunci...">
                            </div>
                            <div class="col-sm-1 mt-4">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                        </div>
                    </form>
                    <h6><?php
                    if (!isset($_GET['tgl_mulai']) && !isset($_GET['tgl_akhir'])) {

                    }else{
                        echo "Periode pencarian dari <b>". $_GET['tgl_mulai']."</b> sampai <b>".$_GET['tgl_akhir']."</b>";
                    }?>
                </h6>
            </div>
        <?php endif ?>

        <div class="shadow p-4 mb-5 bg-white rounded">
            <div class="d-flex flex-row-reverse">
                <!-- <button class="btn btn-danger btn-sm mb-4 ms-3"><i class='bx bxs-file-pdf me-2'></i>PDF</button> -->
                <?php 
                if (!isset($_GET['tgl_mulai']) && !isset($_GET['tgl_akhir'])) {
                    $tanggal = 0;
                }else{
                    $tgl_mulai = $_GET['tgl_mulai']; 
                    $tgl_akhir = $_GET['tgl_akhir']; 
                    $tanggal = $tgl_mulai."--".$tgl_akhir;
                }
                ?>

                <?php if ($idkategori == null) : ?>
                    <a type="button" href="<?=base_url('manager/export/').$tanggal ?>" class="btn btn-success btn-sm mb-4"><i class='bx bx-spreadsheet me-2'></i>Excel</a>
                    <?php else :?>
                        <a type="button" href="<?=base_url('manager/export/').$tanggal.'/'.$idkategori?>" class="btn btn-success btn-sm mb-4"><i class='bx bx-spreadsheet me-2'></i>Excel</a>
                    <?php endif ?>
                </div>
                <table id="tableuser" class="table table-striped table-bordered nowrap" style="width: 100%" >
                  <thead class="bg-primary text-white">
                      <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Tanggal Upload</th>
                        <th>File Upload</th>
                        <th>Pengupload</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                  <?php 
                  $i = 1;
                  foreach ($fileupload as $ls) :?>
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
                        <?php 
                        $newDate = date("d F Y", strtotime($ls->date_uploaded));
                        echo $newDate;
                        ?>
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
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

</div>
</div>
</section>
</main>