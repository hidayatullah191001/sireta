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
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <label class="mb-2" for="name">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" value="<?=$user['nama']?>" id="nama" placeholder="Masukkan Nama...">
                        <?= form_error('nama', '<small class="text-danger">', '</small>') ?>
                    </div>

                    <div class="form-group mb-3">
                        <label class="mb-2" for="name">Nama Pengguna</label>
                        <input type="text" name="username" id="username" class="form-control" value="<?=$user['username']?>" placeholder="Masukkan Nama...">
                        <?= form_error('username', '<small class="text-danger">', '</small>') ?>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">Gambar Profile</div>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-sm-3 mb-2">
                                    <img style="width: 150px" src="<?= base_url('assets/profile/').$user['image'] ?>" class="img-thumbnail">
                                </div>
                                <div class="col-sm-9">
                                    <div class="custom-file">
                                        <input type="file" class="tambah-file custom-file-input" name="image" id="image">
                                        <small class="form-text text-danger"><?= form_error('file'); ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <small class="text-danger mb-3">Note : Gambar profile max 2mb</small>
                    </div>
                    <div class="form-group d-flex flex-row-reverse">
                        <button class="ms-2 btn btn-primary" type="submit">Edit</button>
                        <a class="btn btn-danger" type="submit" href="<?=base_url('manager/hapusGambar/').$user['id'] ?>">Hapus</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

<script type="text/javascript">
    function ubahpw(){
        var cekubah = document.getElementById('cekubah');
        var formpw = document.getElementById('formpw');
        var cekpw = document.getElementById('cekpw');

        if (cekubah.checked == true) {
            formpw.hidden = false;
            cekpw.hidden = false;
        }else{
            formpw.hidden = true;
            cekpw.hidden = true;
        }
    }
</script>