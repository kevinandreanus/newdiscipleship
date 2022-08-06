@extends('template.template')

@push('custom-css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
    <style>
      .item .item-city{
            font-size: 10px;
            opacity: 0.5;
      }
      .item .item-urban{
            font-size: 10px;
            opacity: 0.5;
      }
      .item .item-sub_district{
            font-size: 10px;
            opacity: 0.5;
      }
    </style>
@endpush

@section('content')
<div class="container">
    <!-- User Information-->
    <div class="card user-info-card mb-3">
      <div class="card-body d-flex align-items-center">
        
        <div class="user-profile me-3"><img src="{{ asset($user->profile_picture_url) }}" alt=""><i class="bi bi-pencil"></i>
          <form action="/update-profile/picture" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name="id" readonly class="d-none" value="{{ Crypt::encryptString($id) }}">
            <input class="form-control" type="file" name="profile_picture" onchange="this.form.submit()">
          </form>
        </div>
        <div class="user-info">
          <div class="d-flex align-items-center">
            <h5 class="mb-1">{{ $user->nama_lengkap }}</h5>
            {{-- <span class="badge bg-warning ms-2 rounded-pill">Pro</span> --}}
          </div>
          <p class="mb-0">{{ $user->fungsi_jemaat->name }} - {{ $user->beribadah_di_jemaat }}</p>
        </div>
      </div>
      @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
    </div>
    <!-- User Meta Data-->
    <div class="card user-data-card">
      <div class="card-body">
        <div class="minimal-tab">
          <ul class="nav nav-tabs mb-3" id="affanTab2" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="btn active" id="main-tab" data-bs-toggle="tab" data-bs-target="#main" type="button" role="tab" aria-controls="main" aria-selected="true">Main Profile</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="btn" id="additional-tab" data-bs-toggle="tab" data-bs-target="#additional" type="button" role="tab" aria-controls="additional" aria-selected="false">Additionals</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="btn" id="spiritual-tab" data-bs-toggle="tab" data-bs-target="#spiritual" type="button" role="tab" aria-controls="spiritual" aria-selected="false">Spiritual</button>
            </li>
          </ul>
          <div class="tab-content rounded-lg p-3" id="affanTab2Content">
            <div class="tab-pane fade show active" id="main" role="tabpanel" aria-labelledby="main-tab">
              <form action="/update-profile/main" method="POST" id="updateMain">
                @csrf
                <input type="text" name="id" readonly class="d-none" value="{{ Crypt::encryptString($id) }}">
                <div class="form-group mb-3">
                  <label class="form-label" for="Username">Nama Lengkap</label>
                  <input class="form-control" id="full_name" type="text" placeholder="Nama Lengkap" value="{{ $user->nama_lengkap }}" disabled>
                </div>
                <div class="form-group mb-3">
                  <label class="form-label" for="nickname">Nama Panggilan</label>
                  <input class="form-control" id="nickname" type="text" placeholder="Nama Panggilan" name="nickname" value="{{ $user->nama_panggilan }}">
                </div>
                <div class="form-group mb-3">
                  <label class="form-label" for="nickname">Jenis Kelamin</label>
                  <select name="gender" id="gender" class="form-control">
                    <option value="" disabled selected>Belum Dipilih</option>
                    <option value="L" {{ $user->jenis_kelamin == 'L' ?  'selected' : '' }}>Male</option>
                    <option value="P" {{ $user->jenis_kelamin == 'P' ?  'selected' : '' }}>Female</option>
                  </select>
                </div>
                <div class="form-group mb-3">
                  <label class="form-label" for="email">Email</label>
                  <input class="form-control" id="email" type="text" placeholder="Email" value="{{ $user->user->email }}" disabled>
                </div>
                <div class="form-group mb-3">
                  <label class="form-label" for="job">No. Whatsapp</label>
                  <input class="form-control" id="job" type="text" placeholder="Job Title" value="{{ $user->wa_1 }}" disabled>
                </div>
                <button class="btn btn-success w-100 pt-2" id="btnUpdateMain">Update Now</button>
              </form>
            </div>
            <div class="tab-pane fade" id="additional" role="tabpanel" aria-labelledby="additional-tab">
              <form action="/update-profile/additional" method="POST" id="updateAdditional">
                @csrf
                <input type="text" name="id" readonly class="d-none" value="{{ Crypt::encryptString($id) }}">
                <div class="form-group mb-3">
                  <label class="form-label" for="Place of Birth">Tempat Lahir</label>
                  <input class="form-control" name="place_of_birth" id="place_of_birth" type="text" placeholder="Tempat Lahir" value="{{ $user->tempat_lahir }}">
                </div>
                <div class="form-group mb-3">
                  <label class="form-label" for="date_of_birth">Tanggal Lahir</label>
                  <input class="form-control" id="date_of_birth" type="date" placeholder="Tanggal Lahir" name="date_of_birth" value="{{ $user->tanggal_lahir }}">
                </div>
                <div class="form-group mb-3">
                  <label class="form-label" for="blood_group">Golongan Darah</label>
                  <select name="blood_group" id="blood_group" class="form-control">
                    <option value="" disabled selected>Belum Dipilih</option>
                    <option value="A" {{ $user->golongan_darah == 'A' ?  'selected' : '' }}>A</option>
                    <option value="AB" {{ $user->golongan_darah == 'AB' ?  'selected' : '' }}>AB</option>
                    <option value="AB+" {{ $user->golongan_darah == 'AB+' ?  'selected' : '' }}>AB+</option>
                    <option value="B" {{ $user->golongan_darah == 'B' ?  'selected' : '' }}>B</option>
                    <option value="B+" {{ $user->golongan_darah == 'B+' ?  'selected' : '' }}>B+</option>
                    <option value="O" {{ $user->golongan_darah == 'O' ?  'selected' : '' }}>O</option>
                    <option value="X" {{ $user->golongan_darah == 'X' ?  'selected' : '' }}>X</option>
                  </select>
                </div>
                <div class="form-check mb-3">
                  <input class="form-check-input" id="defaultCheckbox" type="checkbox" {{ $user->isSiapDonor == 1 ? 'checked' : '' }} name="isSiapDonor">
                  <label class="form-check-label" for="defaultCheckbox">Siap Donor Darah</label>
                </div>
                <div class="form-group mb-3">
                  <label class="form-label" for="wa_2">No. Whatsapp Cadangan</label>
                  <input class="form-control" id="wa_2" type="number" placeholder="No. Whatsapp Cadangan" name="wa_2" value="{{ $user->wa_2 }}">
                </div>
                <div class="form-group mb-3">
                  <label class="form-label" for="phone_no">No. HP</label>
                  <input class="form-control" id="phone_no" type="number" placeholder="No. HP" name="phone_no" value="{{ $user->hp_1 }}">
                </div>
                <div class="form-group mb-3">
                  <label class="form-label" for="additional_phone_no">No. HP Cadangan</label>
                  <input class="form-control" id="additional_phone_no" type="number" placeholder="No. HP Cadangan" name="additional_phone_no" value="{{ $user->hp_2 }}">
                </div>
                <div class="form-group mb-3">
                  <label class="form-label" for="address">Alamat Lengkap</label>
                  <textarea class="form-control" id="address" name="address" cols="30" rows="10" >{{ $user->alamat_lengkap }}</textarea>
                </div>
                <div class="form-group mb-3">
                  <label class="form-label" for="no_rt">No. RT</label>
                  <input class="form-control" id="no_rt" type="number" placeholder="No. RT" name="no_rt" value="{{ $user->no_rt }}">
                </div>
                <div class="form-group mb-3">
                  <label class="form-label" for="no_rw">No. RW</label>
                  <input class="form-control" id="no_rw" type="number" placeholder="No. RW" name="no_rw" value="{{ $user->no_rw }}">
                </div>
                <div class="form-group mb-3">
                  <label class="form-label" for="postal_code">Kode Pos</label>
                  <input class="form-control flexdatalist" id="postal_code" type="number" placeholder="Kode Pos" name="postal_code" value="{{ $user->kode_pos }}">
                </div>
                <div class="form-group mb-3">
                  <label class="form-label" for="nationality">Kebangsaan</label>
                  <select name="nationality" class="form-control" id="nationality">
                    <option value="" disabled selected>Belum Dipilih</option>
                    @foreach ($kebangsaan as $k)
                        <option value="{{ $k->id }}" {{ $k->id == $user->kebangsaan_id ? 'selected' : '' }}>{{ $k->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group mb-3">
                  <label class="form-label" for="last_education">Pendidikan Terakhir</label>
                  <select name="last_education" class="form-control" id="last_education">
                    <option value="" disabled selected>Belum Dipilih</option>
                    <option value="SD" {{ $user->pendidikan_terakhir == 'SD' ? 'selected' : '' }}>SD</option>
                    <option value="SMP" {{ $user->pendidikan_terakhir == 'SMP' ? 'selected' : '' }}>SMP</option>
                    <option value="SMA" {{ $user->pendidikan_terakhir == 'SMA' ? 'selected' : '' }}>SMA</option>
                    <option value="SMK" {{ $user->pendidikan_terakhir == 'SMK' ? 'selected' : '' }}>SMK</option>
                    <option value="D1" {{ $user->pendidikan_terakhir == 'D1' ? 'selected' : '' }}>D1</option>
                    <option value="D2" {{ $user->pendidikan_terakhir == 'D2' ? 'selected' : '' }}>D2</option>
                    <option value="D3" {{ $user->pendidikan_terakhir == 'D3' ? 'selected' : '' }}>D3</option>
                    <option value="D4" {{ $user->pendidikan_terakhir == 'D4' ? 'selected' : '' }}>D4</option>
                    <option value="S1" {{ $user->pendidikan_terakhir == 'S1' ? 'selected' : '' }}>S1</option>
                    <option value="S2" {{ $user->pendidikan_terakhir == 'S2' ? 'selected' : '' }}>S2</option>
                    <option value="S3" {{ $user->pendidikan_terakhir == 'S3' ? 'selected' : '' }}>S3</option>
                    <option value="Tidak Sekolah" {{ $user->pendidikan_terakhir == 'Tidak Sekolah' ? 'selected' : '' }}>Tidak Sekolah</option>
                  </select>
                </div>
                <div class="form-group mb-3">
                  <label class="form-label" for="pendidikan_jurusan">Pendidikan Jurusan</label>
                  <input class="form-control" id="pendidikan_jurusan" type="text" placeholder="Pendidikan Jurusan" name="pendidikan_jurusan" value="{{ $user->pendidikan_jurusan }}">
                </div>
                <div class="form-group mb-3">
                  <label class="form-label" for="fungsi_keluarga">Fungsi Keluarga</label>
                  <select name="fungsi_keluarga" class="form-control" id="fungsi_keluarga">
                    <option value="" disabled selected>Belum Dipilih</option>
                    <option value="Ayah" {{ $user->pendidikan_terakhir == 'Ayah' ? 'selected' : '' }}>Ayah</option>
                    <option value="Ibu" {{ $user->pendidikan_terakhir == 'Ibu' ? 'selected' : '' }}>Ibu</option>
                    <option value="Istri" {{ $user->pendidikan_terakhir == 'Istri' ? 'selected' : '' }}>Istri</option>
                    <option value="Suami" {{ $user->pendidikan_terakhir == 'Suami' ? 'selected' : '' }}>Suami</option>
                    <option value="Anak" {{ $user->pendidikan_terakhir == 'Anak' ? 'selected' : '' }}>Anak</option>
                    <option value="Kakak" {{ $user->pendidikan_terakhir == 'Kakak' ? 'selected' : '' }}>Kakak</option>
                    <option value="Adik" {{ $user->pendidikan_terakhir == 'Adik' ? 'selected' : '' }}>Adik</option>
                  </select>
                </div>
                <div class="form-group mb-3">
                  <label class="form-label" for="status_nikah">Status Pernikahan</label>
                  <select name="status_nikah" class="form-control" id="status_nikah">
                    <option value="" disabled selected>Belum Dipilih</option>
                    <option value="Belum Menikah" {{ $user->pendidikan_terakhir == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                    <option value="Sudah Menikah" {{ $user->pendidikan_terakhir == 'Sudah Menikah' ? 'selected' : '' }}>Sudah Menikah</option>
                    <option value="Cerai Hidup" {{ $user->pendidikan_terakhir == 'Cerai Hidup' ? 'selected' : '' }}>Bercerai (Hidup)</option>
                    <option value="Cerai Meninggal" {{ $user->pendidikan_terakhir == 'Cerai Meninggal' ? 'selected' : '' }}>Bercerai (Meninggal)</option>
                  </select>
                </div>
                <div class="form-group mb-3">
                  <label class="form-label" for="tanggal_pernikahan">Tanggal Pernikahan</label>
                  <input class="form-control" id="tanggal_pernikahan" type="date" placeholder="Tanggal Pernikahan" name="tanggal_pernikahan" value="{{ $user->tanggal_nikah }}">
                </div>
                
                <button class="btn btn-success w-100 pt-2" type="submit">Update Now</button>
              </form>
            </div>
            <div class="tab-pane fade" id="spiritual" role="tabpanel" aria-labelledby="spiritual-tab">
              <form action="/update-profile/spiritual" method="POST" id="updateSpiritual">
                @csrf
                <input type="text" name="id" readonly class="d-none" value="{{ Crypt::encryptString($id) }}">
                <div class="form-group mb-3">
                  <label class="form-label" for="kepercayaan_sebelumnya">Kepercayaan Sebelumnya</label>
                  <select name="kepercayaan_sebelumnya" id="kepercayaan_sebelumnya" class="form-control">
                    <option value="" disabled selected>Belum Dipilih</option>
                    <option value="Buddha" {{ $user->kepercayaan_sebelumnya == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                    <option value="Hindu" {{ $user->kepercayaan_sebelumnya == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                    <option value="Islam" {{ $user->kepercayaan_sebelumnya == 'Islam' ? 'selected' : '' }}>Islam</option>
                    <option value="Katolik" {{ $user->kepercayaan_sebelumnya == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                    <option value="Konghucu" {{ $user->kepercayaan_sebelumnya == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                    <option value="Kristen" {{ $user->kepercayaan_sebelumnya == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                    <option value="Lainnya" {{ $user->kepercayaan_sebelumnya == 'Lainnya' ? 'selected' : '' }}>Others</option>
                  </select>
                </div>
                <div class="form-group mb-3">
                  <label class="form-label" for="tahun_baptis_air">Tahun Baptis Air</label>
                  <input class="form-control" id="tahun_baptis_air" type="text" name="tahun_baptis_air" placeholder="Tahun Baptis Air" name="tahun_baptis_air" value="{{ $user->tahun_baptis_air }}">
                </div>
                <div class="form-group mb-3">
                  <label class="form-label" for="tahun_baptis_roh">Tahun Baptis Roh</label>
                  <input class="form-control" id="tahun_baptis_roh" type="text" name="tahun_baptis_roh" placeholder="Tahun Baptis Roh" name="tahun_baptis_roh" value="{{ $user->tahun_baptis_roh }}">
                </div>
                <div class="form-group mb-3">
                  <label class="form-label" for="tahun_lahir_baru">Tahun Lahir Baru</label>
                  <input class="form-control" id="tahun_lahir_baru" type="text" name="tahun_lahir_baru" placeholder="Tahun Lahir Baru" value="{{ $user->tahun_lahir_baru }}">
                </div>
                <div class="form-group mb-3">
                  <label class="form-label" for="berjemaat_sejak">Berjemaat Sejak Tahun</label>
                  <input class="form-control" id="berjemaat_sejak" type="text" name="berjemaat_sejak" placeholder="Berjemaat Sejak Tahun" value="{{ $user->berjemaat_sejak }}">
                </div>
                <div class="form-group mb-3">
                  <label class="form-label" for="gereja_sebelumnya">Gereja Sebelumnya</label>
                  <input class="form-control" id="gereja_sebelumnya" type="text" name="gereja_sebelumnya" placeholder="Gereja Sebelumnya" value="{{ $user->gereja_sebelumnya }}">
                </div>
                <div class="form-group mb-3">
                  <label class="form-label" for="ikut_ibadah">Ikut Ibadah</label>
                  <select name="ikut_ibadah" id="ikut_ibadah" class="form-control">
                    <option value="" disabled selected>Belum Dipilih</option>
                    @foreach ($ibadah as $i)
                        <option value="{{ $i->id }}" {{ $i->id == $user->ikut_ibadah_id ? 'selected' : '' }} >{{ $i->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group mb-3">
                  <label class="form-label" for="komsel">Komsel</label>
                  <select name="komsel" id="komsel" class="form-control">
                    <option value="" disabled selected>Belum Dipilih</option>
                    @foreach ($komsel as $k)
                        <option value="{{ $k->id }}" {{ $k->id == $user->komsel_id ? 'selected' : '' }}>{{ $k->name }}</option>
                    @endforeach
                  </select>
                </div>
                <button class="btn btn-success w-100 pt-2" id="btnUpdateMain">Update Now</button>
              </form>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
@endsection

@push('custom-js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>

    <script>
      $('#updateMain').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "/update-profile/main",
            data: $(this).serialize(), 
            beforeSend: function(){
              $.LoadingOverlay("show");
            },
            success: function( msg ) {
              $.LoadingOverlay("hide");
              showAlert("Success!");
            }
        });
      });

      $('#updateAdditional').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "/update-profile/additional",
            data: $(this).serialize(), 
            beforeSend: function(){
              $.LoadingOverlay("show");
            },
            success: function( msg ) {
              $.LoadingOverlay("hide");
              showAlert("Success!");
            }
        });
      });

      $('#updateSpiritual').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "/update-profile/spiritual",
            data: $(this).serialize(), 
            beforeSend: function(){
              $.LoadingOverlay("show");
            },
            success: function( msg ) {
              $.LoadingOverlay("hide");
              showAlert("Success!");
            }
        });
      });

      $('.flexdatalist').flexdatalist({
          minLength: 4,
          searchIn: 'postal_code',
          data: '/json/postal_code',
          maxShownResults: 5,
          selectionRequired: true,
          visibleProperties: ["postal_code","city","urban", "sub_district"],
          valueProperty: "postal_code",
      });

      $("#tahun_baptis_air").datepicker({
        format: "yyyy",
        viewMode: "years", 
        minViewMode: "years",
        autoclose:true
      });

      $("#tahun_baptis_roh").datepicker({
        format: "yyyy",
        viewMode: "years", 
        minViewMode: "years",
        autoclose:true
      });   

      $("#tahun_lahir_baru").datepicker({
        format: "yyyy",
        viewMode: "years", 
        minViewMode: "years",
        autoclose:true
      });   

      $("#berjemaat_sejak").datepicker({
        format: "yyyy",
        viewMode: "years", 
        minViewMode: "years",
        autoclose:true
      });    
      
      function showAlert(title){
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          });
          Toast.fire({
            icon: 'success',
            title: title
          });
      }
    </script>
@endpush