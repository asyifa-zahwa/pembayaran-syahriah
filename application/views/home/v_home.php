<div class="container">
    <div class="row" style="margin-top: 80px;">
        <div class="col-12 text-center my-5">
            <h3>Pembayaran Syahriyah Pondok Pesantren Al-Muhsin</h3>
        </div>
        <div class="col-md-6" style="float:none;margin:auto;">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3 d-flex justify-content-between">
                        <h6 class=" text-white text-capitalize ps-3">Cari Data Berdasarkan Nomor Induk Santri</h6>
                    </div>
                </div>
                <div class="card-body px-4 mb-5">
                    <p> * Inputkan Nama dan NIS sesuai dengan Kartu Tanda Santri (KTS)</p>
                    <form action="<?= base_url() ?>home/cari" method="post">
                        <div class="input-group input-group-outline my-3">
                            <!-- <label class="form-label">Nama</label> -->
                            <input type="text" class="form-control" name="nama" placeholder="Nama...">
                        </div>
                        <div class="input-group input-group-outline mb-0">
                            <!-- <label class="form-label">Tanggal Lahir</label> -->
                            <input type="text" class="form-control" name="kode" placeholder="Nomor Induk Santri">
                        </div>
                        <button type="submit" class="btn bg-gradient-success my-4 mb-2">Cari</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>