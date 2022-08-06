<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJemaatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jemaats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('nama_lengkap')->nullable();
            $table->string('nama_panggilan')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('golongan_darah', ['A', 'AB', 'AB+', 'B', 'B+', 'O', 'X'])->nullable();
            $table->boolean('isSiapDonor')->default(0);
            $table->text('alamat_lengkap')->nullable();
            $table->string('no_rt')->nullable();
            $table->string('no_rw')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('email')->nullable();
            $table->unsignedBigInteger('kebangsaan_id')->nullable();
            $table->string('telp_1')->nullable();
            $table->string('telp_2')->nullable();
            $table->string('wa_1')->nullable();
            $table->string('wa_2')->nullable();
            $table->string('hp_1')->nullable();
            $table->string('hp_2')->nullable();
            $table->enum('pendidikan_terakhir', ['SD', 'SMP', 'SMA', 'SMK', 'D1', 'D2', 'D3', 'D4', 'S1', 'S2', 'S3', 'Tidak Sekolah'])->nullable();
            $table->string('pendidikan_jurusan')->nullable();
            $table->enum('fungsi_keluarga', ['Ayah', 'Ibu', 'Istri', 'Suami', 'Anak', 'Kakak', 'Adik'])->nullable();
            $table->enum('status_nikah', ['Belum Menikah', 'Sudah Menikah', 'Cerai Hidup', 'Cerai Meninggal'])->nullable();
            $table->date('tanggal_nikah')->nullable();
            $table->enum('kepercayaan_sebelumnya', ['Buddha', 'Hindu', 'Islam', 'Katolik', 'Konghucu', 'Kristen', 'Lainnya'])->nullable();
            $table->integer('tahun_baptis_air')->nullable();
            $table->string('tahun_baptis_roh')->nullable();
            $table->integer('tahun_lahir_baru')->nullable();
            $table->integer('berjemaat_sejak')->nullable();
            $table->string('gereja_sebelumnya')->nullable();
            $table->unsignedBigInteger('ikut_ibadah_id')->nullable();
            $table->string('beribadah_di_jemaat')->nullable();
            $table->unsignedBigInteger('komsel_id')->nullable();
            $table->unsignedBigInteger('fungsi_dalam_jemaat_id')->nullable();
            $table->unsignedBigInteger('status_daftar_id')->nullable();
            $table->string('keterangan_tambahan')->nullable();
            $table->string('profile_picture_url')->nullable()->default('img/bg-img/2.jpg');

            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('modified_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jemaats');
    }
}
