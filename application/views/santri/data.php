<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3 d-flex justify-content-between">
                    <h6 class=" text-white text-capitalize ps-3"><?= $title  ?></h6>
                    <!-- Button trigger modal -->
                    <div>

                    </div>
                    <button type="button" class="btn btn-sm btn-info m-0 me-4" data-bs-toggle="modal" data-bs-target="#staticBackdrop" onclick="tambah()">
                        Tambah
                    </button>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">No</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NIS</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Santri</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NO HP</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Alamat ( Kecamatan dan Kabupaten )</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Wali</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Status</th>
                                <th colspan="2" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = $this->uri->segment('3') + 1;
                            foreach ($santri->result() as $key) : ?>
                                <tr>
                                    <td class="text-center">
                                        <?= $no ++ ?>
                                    </td>
                                    <td>
                                        <?= $key->kode ?>
                                    </td>
                                    <td>
                                        <?= $key->nama ?>
                                    </td>
                                    <td>
                                        <?= $key->no_hp ?>
                                    </td>
                                    <td>
                                        <?= $key->alamat ?>
                                    </td>
                                    <td>
                                        <?= $key->nama_wali ?>
                                    </td>
                                    <td class="align-middle text-center text-sm">

                                        <?php if ($key->status == 0) : ?>
                                            <span type="button" class="badge badge-sm bg-gradient-success" id="status">Aktif</span>
                                        <?php else : ?>
                                            <span type="button" class="badge badge-sm bg-gradient-secondary" id="status" >Tidak Aktif</span>
                                         <?php endif ?>
                                    </td>
                                    <td>
                                        <a href="#" class="edit" data-bs-toggle="modal" data-bs-target="#update" onclick="edit('<?= $key->id_santri ?>','<?= $key->kode ?>','<?= $key->nama ?>','<?= $key->no_hp ?>','<?= $key->alamat ?>','<?= $key->nama_wali ?>','<?= $key->status ?>')"><i class="fa fa-edit"></i></a>
                                    </td>
                                    <td>
                                        <a href="#" onclick="hapus('<?= base_url() ?>santri/hapus/<?= $key->id_santri ?>', 'Jika Anda Menghapus Data <span class=\'text-success\'><?= $key->nama ?></span> Tagihannya Juga Ikut Terhapus')"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <br>
                    <?= $this->pagination->create_links();?>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog bg-dark">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Form Santri</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url() ?>santri/tambah" method="POST" id="form_santri">
                    <div class="input-group input-group-outline mb-3">
                        <label for="kode" class="form-label">NIS *</label>
                        <input type="number" class="form-control" name="kode" id="kode">
                    </div>
                    <div class="input-group input-group-outline mb-3">
                        <label for="nama" class="form-label">Nama Lengkap *</label>
                        <input type="text" class="form-control" name="nama" id="nama">
                        <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <div class="input-group input-group-outline mb-3">
                        <label for="no_hp" class="form-label">Nomor HP</label>
                        <input type="number" class="form-control" name="no_hp" id="no_hp">
                    </div>
                    <div class="input-group input-group-outline mb-3">
                        <label for="alamat" class="form-label">Alamat ( Kecamatan dan Kabupaten )</label>
                        <input type="text" class="form-control" name="alamat" id="alamat">
                    </div>
                    <div class="input-group input-group-outline mb-3">
                        <label for="nama_wali" class="form-label">Nama Wali</label>
                        <input type="text" class="form-control" name="nama_wali" id="nama_wali">
                    </div>
                    <div class="input-group input-group-outline mb-3 is-filled">
                        <label class="form-label">Status *</label>
                        <select id="status" class="form-control" name="status">
                            <option value="0">Aktif</option>
                            <option value="1">Tidak Aktif</option>
                        </select>
                    </div>
                    <p style="color: red;">* Wajib Diisi</p>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="update" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog bg-dark">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel1">Form Update Santri</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form  method="POST" id="form_update_santri">
                   
                    <div class="input-group input-group-outline mb-3">
                        <!-- <label for="kode" class="form-label">NIS</label> -->
                        <input type="number" class="form-control" name="kode" id="kode1" placeholder="NIS *" >
                    </div>
                    <div class="input-group input-group-outline mb-3">
                        <!-- <label for="nama" class="form-label">Nama</label> -->
                        <input type="text" class="form-control" name="nama" id="nama1" placeholder="Nama Lengkap *" >
                        <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <div class="input-group input-group-outline mb-3">
                        <!-- <label for="no_hp" class="form-label">NO HP</label> -->
                        <input type="number" class="form-control" name="no_hp" id="no_hp1" placeholder="Nomor HP">
                    </div>
                    <div class="input-group input-group-outline mb-3">
                        <!-- <label for="alamat" class="form-label">Alamat</label> -->
                        <input type="text" class="form-control" name="alamat" id="alamat1" placeholder="ALamat ( Kecamatan dan Kabupaten )">
                    </div>
                    <div class="input-group input-group-outline mb-3">
                        <!-- <label for="nama_wali" class="form-label">Nama Wali</label> -->
                        <input type="text" class="form-control" name="nama_wali" id="nama_wali1" placeholder="Nama Wali">
                    </div>
                    <div class="input-group input-group-outline mb-3 is-filled">
                        <label class="form-label">Status *</label>
                        <select id="status1" class="form-control" name="status">

                            <?php if (value == 0) : ?>
                                 <option value="0">Aktif</option>
                                 <option value="1">Tidak Aktif</option> 
                            <?php else : ?>
                                 <option value="1">Tidak Aktif</option>
                                 <option value="0">Tidak Aktif</option>               
                            <?php endif ?>
                               
                        </select>
                    </div>
                    <p style="color: red;">* Wajib Diisi</p>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function tambah() {
        $('#form_santri')[0].reset();
        $('#form_santri').attr('action', '<?= base_url() ?>santri/tambah');
    }

    function edit(id, kode, nama, no_hp, alamat, nama_wali, status) {
        $('#form_update_santri').attr('action', '<?= base_url() ?>santri/update/' + id);
        $('#kode1').val(kode);
        $('#nama1').val(nama);
        $('#no_hp1').val(no_hp);
        $('#alamat1').val(alamat);
        $('#nama_wali1').val(nama_wali);
        $('#status1').val(status);
    }
//     function status() // no ';' here
// {
//     var elem = document.getElementById("status");
//     if (elem.value==0) elem.value = 1;elem.innerHTML="Tidak Aktif"
//     else elem.value = 0;elem.innerHTML="Aktif"
// }
</script>