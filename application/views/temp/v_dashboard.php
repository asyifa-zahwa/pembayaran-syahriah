<div class="row">
    <div class="col-12 pb-5">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3 d-flex justify-content-between">
                    <h6 class=" text-white text-capitalize ps-3"><?= $title  ?></h6>
                </div>
            </div>
            <div class="card-body text-center px-0 py-5">
                <h4>Selamat Datang Di Sistem Pembayaran SAHAM</h4>
                <h4>Syahriyah Pondok Pesantren Al-Muhsin</h4>
            </div>
        </div>
    </div>
    <!-- <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">receipt_long</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Jumlah Tagihan</p>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <h4 class="mb-0">Rp. <?= number_format($tagihan) ?></h4>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">receipt_long</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Jumlah Pembayaran</p>

                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <h4 class="mb-0">Rp. <?= number_format($bayar) ?></h4>
            </div>
        </div>
    </div> -->
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">person</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Jumlah Santri</p>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer text-end p-3">
                <h4 class="mb-0"><?= $santri ?> data</h4>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">weekend</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Jumlah Spp</p>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer text-end p-3">
                <h4 class="mb-0"><?= $spp ?> data</h4>
            </div>
        </div>
    </div>
</div>