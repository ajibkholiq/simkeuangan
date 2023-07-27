@extends('layout.master')


@section('main')
   {{-- membuat profile tampilan  --}}
   <div class="wrapper wrapper-content">
    <div class="row animated fadeInRight">
        <div class="col-md-3">
            <div class="ibox float-e-margins" style="border: 2px solid #1AB394; box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2); " >
              <style>
                /* Untuk layar dengan lebar 768 piksel atau kurang (misalnya tampilan ponsel) */
                @media screen and (max-width: 788px) {
                  .image {
                    width: 100px; /* Sesuaikan lebar gambar sesuai kebutuhan */
                    height: 100px; /* Sesuaikan tinggi gambar sesuai kebutuhan */
                    border-radius: 50%;
                    padding:10px;
                    display: block; /* Atur elemen menjadi blok agar dapat menggunakan margin */
                    margin-left: auto; /* Pusatkan gambar secara horizontal */
      margin-right: auto; /* Pusatkan gambar secara horizontal */
                  }
                }
              
                /* Untuk layar dengan lebar lebih dari 768 piksel (misalnya tampilan desktop) */
                @media screen and (min-width: 769px) {
                  .image {
                    width: 150px; /* Sesuaikan lebar gambar sesuai kebutuhan */
                    height: 150px; /* Sesuaikan tinggi gambar sesuai kebutuhan */
                    border-radius: 50%;
                    padding: 10px;
                    display: block; /* Atur elemen menjadi blok agar dapat menggunakan margin */
      margin-left: auto; /* Pusatkan gambar secara horizontal */
      margin-right: auto; /* Pusatkan gambar secara horizontal */
                  }
                }

                .form-control{
                  border-radius: 8px;
                }

                @media screen and (max-width: 788px) {
                  .buttom{
                    width: 100px; /* Sesuaikan lebar gambar sesuai kebutuhan */
                    height: 100px; /* Sesuaikan tinggi gambar sesuai kebutuhan */
                    border-radius: 50%;
                    display: block; /* Atur elemen menjadi blok agar dapat menggunakan margin */
                    margin-left: auto; /* Pusatkan gambar secara horizontal */
      margin-right: auto; /* Pusatkan gambar secara horizontal */
                  }

                }
              </style>
              
                <div>
                  <div class="ibox-content no-padding border-left-right">
                    <img src="{{ asset('assets/img/a4.jpg') }}" class="image" style="cursor: pointer;" alt="profile">

                    <!-- Modal untuk mengganti foto -->
                    <div class="modal fade" id="changePhotoModal" tabindex="-1" role="dialog" aria-labelledby="changePhotoModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="changePhotoModalLabel">Change Photo</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <!-- Input file untuk mengganti foto -->
                            <input type="file" id="photoInput" style="display: none; margin-right: 20px; margin-left: 20px;">
                            <label class="btn btn-primary" for="photoInput">
                              <i class="fa fa-upload"></i> Upload New Photo
                            </label>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <!-- Tombol simpan jika diperlukan -->
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    
                    <script>
                      // Tangkap elemen gambar dengan kelas "image"
                      var image = document.querySelector('.image');
                    
                      // Tambahkan event listener untuk aksi klik pada gambar
                      image.addEventListener('click', function() {
                        // Munculkan modal ketika gambar di klik
                        $('#changePhotoModal').modal('show');
                      });
                    </script>
                </div>
            
                    <div class="ibox-content profile-content">
                        <h4 style="text-align: center"><strong>Ricky Darmawan</strong></h4>
                        <p style="text-align: center"><i class="fa fa-map-marker"></i>Admin</p>
                        <div class="user-button">
                            <div class="row">
                              <label class="btn btn-primary btn-rounded" style="margin-right: 20px; margin-left: 20px; display: block; align-items: center; cursor: pointer; box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);" data-toggle="modal" data-target="#changePasswordModal">
                                <i class="fa fa-info-circle"></i> Password
                              </label>
                              <img id="previewImage" src="#" alt="Preview" style="display: none; max-width: 200px; margin: 20px;">
                                {{-- <div class="col-md-6">
                                    <button type="button" class="btn btn-default btn-sm btn-block"><i class="fa fa-coffee"></i> Buy a coffee</button>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <!-- Form untuk mengganti password -->
                            <form>
                              <div class="form-group">
                                <label for="currentPassword">Current Password</label>
                                <input type="password" class="form-control" id="currentPassword" placeholder="Enter current password" required>
                              </div>
                              <div class="form-group">
                                <label for="newPassword">New Password</label>
                                <input type="password" class="form-control" id="newPassword" placeholder="Enter new password" required>
                              </div>
                              <div class="form-group">
                                <label for="confirmPassword">Confirm New Password</label>
                                <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm new password" required>
                              </div>
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save Changes</button>
                          </div>
                        </div>
                      </div>
                    </div>
            </div>
        </div>
            </div>
        <div class="col-md-8">
            <div class="ibox float-e-margins" style="border:2px dashed #1AB394">
                
                <div class="ibox-content" style="box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">
                  <div class="form-group">    
                    <label for="nama_role">Nama:</label>
                    <input type="text" name="name" class="form-control" value="">
                </div>
                <div class="form-group">    
                  <label for="nama_role">email:</label>
                  <input type="email" name="email" class="form-control" value="">
              </div>
              <div class="form-group">    
                <label for="nama_role">Username:</label>
                <input type="text" name="name" class="form-control" value="">
            </div>
            <div class="form-group">    
              <label for="nama_role">No HP:</label>
              <input type="number" name="number" class="form-control" value="">
          </div>
          <div class="form-group">    
            <label for="nama_role">alamat:</label>
            <input type="text" name="name" class="form-control" value="">
        </div>
        <button type="submit" class="btn btn-primary" class="buttom" style="border-radius: 25px">Update</button>

                    

                </div>
            </div>

        </div>
    </div>
</div>
   
  
  




    
@endsection