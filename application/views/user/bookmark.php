<main id="main" class="p-3">
    <section id="services" class="services">
        <div class="container" data-aos="fade-up" >
            <?=$this->session->flashdata('message') ?>
            <div class="section-title">
                <h2><?=$title ?></h2>
                <div class=" d-flex flex-row-reverse">
                    <!-- <a href="<?=base_url('admin/tambah_akun/') ?>" class="btn btn-primary btn-sm"><i class="bx bx-plus"></i>Tambah Data</a> -->
                </div>
            </div>

            <div class="shadow p-4 mb-5 bg-white rounded">
                <h3 class="mb-3">Pencarian</h3>
                <form action="<?=base_url('user/bookmark/')?>" method="post">
                    <div class="form-group row">
                        <div class="col-sm-11 mb-3">
                            <input type="text" class="form-control" id="key" name="key" placeholder="Masukkan kata kunci...">
                        </div>
                        <div class="col-sm-1">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="row">
                <?php if (empty($bookmark)) :  ?>
                    <div class="p-3">
                        <div class="alert alert-danger" role="alert">
                            Data yang dicari tidak ditemukan!
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ($total < 1) : ?>
                    <div class="p-3">
                        <div class="alert alert-danger">Data Item Tersimpan kosong, pilih data 
                            <a href="<?=base_url('user/library/')?>">disini!</a></div>
                        </div>
                        <?php else : ?>
                            <?php foreach ($bookmark as $ld) : ?>
                                <div class="col-12 col-md-6">
                                    <div class="shadow p-4 mb-5 bg-white rounded col">
                                        <h3>
                                            <?php
                                            $kalimat = $ld->judul;
                                            $max = 25;
                                            $cetak = substr($kalimat, 0, $max);
                                            if (strlen($kalimat)>$max) {
                                                echo $cetak.'...';
                                            }else{
                                                echo $cetak;
                                            }?></h3>
                                            <small>Tanggal Upload : <?=$ld->date_uploaded;?></small>
                                            <br>
                                            <small>Uploader : 
                                                <?php foreach ($akun as $ak) : ?>
                                                    <?php if ($ld->id_user == $ak->id) {
                                                        echo $ak->nama;
                                                    } ?>
                                                <?php endforeach ?>
                                            </small>
                                            <br><br>
                                            <a target="_blank" href="<?=base_url('assets/file/upload/').$ld->nama_file ?>" class="btn btn-success btn-sm mb-3"><i class='bx bxs-download me-2'></i></i>Unduh</a>
                                            <a href="<?=base_url('user/hapus_bookmark/').$ld->id ?>" class="btn btn-danger btn-sm mb-3"><i class='bx bx-trash me-2'></i>Hapus Item</a>
                                        </div>
                                    </div>  
                                <?php endforeach ?>
                            <?php endif ?>  
                        </div>
                    </div>
                </section>
            </main>