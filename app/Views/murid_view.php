<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Data Murid</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <style>
          .container {
               max-width: '800px';
               margin-top: 20px;
          }
     </style>
</head>

<body>
     <!-- CONTAINER -->
     <div class="container">
          <!-- CARD -->
          <div class="card">
               <h5 class="card-header bg-secondary text-white">Data Murid</h5>
               <div class="card-body">
                    <!-- TEXT PENCARIAN -->
                    <form action="" method="get">
                         <div class="input-group mb-3">
                              <input type="text" class="form-control" name="katakunci" placeholder="Masukan Kata Kunci" aria-label="Masukan Kata Kunci" aria-describedby="button-addon2">
                              <button class="btn btn-outline-secondary" type="button" id="button-addon2">Cari</button>
                         </div>
                    </form>
                    <!-- MODAL -->
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                         Tambah Data Murid
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                         <div class="modal-dialog">
                              <div class="modal-content">
                                   <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Form Murid</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                   </div>
                                   <div class="modal-body">
                                        <!-- JIKA ERROR -->
                                        <div class="alert alert-danger error" role="alert" style="display: none;">

                                        </div>

                                        <!-- JIKA SUKSES -->
                                        <div class="alert alert-primary sukses" role="alert" style="display: none;">

                                        </div>

                                        <!-- FORM INPUT DATA -->
                                        <div class="mb-3 row">
                                             <label for="inputNama" class="col-sm-2 col-form-label">Nama</label>
                                             <div class="col-sm-10">
                                                  <input type="text" class="form-control" id="inputNama">
                                             </div>
                                        </div>
                                        <div class="mb-3 row">
                                             <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                             <div class="col-sm-10">
                                                  <input type="text" class="form-control" id="inputEmail">
                                             </div>
                                        </div>
                                        <div class="mb-3 row">
                                             <label for="inputBidang" class="col-sm-2 col-form-label">Bidang</label>
                                             <div class="col-sm-10">
                                                  <select id="inputBidang" class="form-delect">
                                                       <option value="matematika">Matematika</option>
                                                       <option value="fisika">Fisika</option>
                                                       <option value="bahasaInggris">Bahasa Inggris</option>
                                                       <option value="bahasaIndonesia">Bahasa Indonesia</option>
                                                  </select>
                                             </div>
                                        </div>
                                        <div class="mb-3 row">
                                             <label for="inputAlamat" class="col-sm-2 col-form-label">Alamat</label>
                                             <div class="col-sm-10">
                                                  <input type="text" class="form-control" id="inputAlamat">
                                             </div>
                                        </div>
                                   </div>
                                   <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="button" class="btn btn-primary" id="tombolSimpan">Simpan</button>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <table class="table">
                         <thead>
                              <tr>
                                   <th>No</th>
                                   <th>Nama</th>
                                   <th>Email</th>
                                   <th>Bidang</th>
                                   <th>Alamat</th>
                                   <th>Aksi</th>
                              </tr>
                         </thead>
                         <tbody>
                              <?php
                              foreach ($dataMurid as $k => $v) {
                              ?>
                                   <tr>
                                        <td></td>
                                        <td><?php echo $v['nama'] ?></td>
                                        <td><?php echo $v['email'] ?></td>
                                        <td><?php echo $v['bidang'] ?></td>
                                        <td><?php echo $v['alamat'] ?></td>

                                        <td>
                                             <button type="button" class="btn btn-warning btn-sm">Edit</button>
                                             <button type="button" class="btn btn-danger btn-sm">Delete</button>
                                        </td>
                                   </tr>
                              <?php } ?>
                         </tbody>
                    </table>
               </div>
          </div>
     </div>

     <!-- JAVASSCRIPT -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
     <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

     <script>
          $('#tombolSimpan').on('click', function() {
               var $nama = $('#inputNama').val();
               var $email = $('#inputEmail').val();
               var $bidang = $('#inputBidang').val();
               var $alamat = $('#inputAlamat').val();

               $.ajax({
                    url: "<?php echo site_url("/home/simpan") ?>",
                    type: "POST",
                    data: {
                         nama: $nama,
                         email: $email,
                         bidang: $bidang,
                         alamat: $alamat
                    },
                    success: function(hasil) {
                         var $obj = $.parseJSON(hasil);
                         if ($obj.sukses == false) {
                              $('.sukses').hide();
                              $('.error').show();
                              $('.error').html($obj.error);
                         } else {
                              $('.error').hide();
                              $('.sukses').show();
                              $('.sukses').html($obj.sukses);
                         }
                    }
               });

          });
     </script>
</body>

</html>