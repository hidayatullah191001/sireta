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

            <div class="shadow p-4 mb-5 bg-white rounded col-md-6">
                <form action="" method="post">
                    <div class="form-group">
                        <label class="mb-2" for="name">Kata Sandi Baru</label>
                        <input type="password" placeholder="Masukkan kata sandi baru..." class="form-control" name="password1" id="password1">
                        <?= form_error('password1', '<small class="text-danger">', '</small>') ?>
                    </div>
                    <br>
                    <div class="form-group">
                        <label class="mb-2" for="name">Ulangi Kata Sandi</label>
                        <input type="password" placeholder="Ulangi Kaya Sandi..." class="form-control" name="password2" id="password2">
                    </div>
                    <br>
                    <div id="cekpw" class="form-group mb-3">
                        <input type="checkbox" class="form-control" id="cek" onclick="lihatpw()">
                        <label class="form-check-label" for="exampleCheck1">Lihat Kata Sandi</label>
                    </div>

                    <div class="form-group d-flex flex-row-reverse mt-4">
                        <button class="ms-2 btn btn-primary" type="submit">Ubah</button>
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