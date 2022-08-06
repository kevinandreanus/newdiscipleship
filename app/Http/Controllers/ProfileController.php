<?php

namespace App\Http\Controllers;

use App\Models\Ibadah;
use App\Models\Jemaat;
use App\Models\Kebangsaan;
use App\Models\Komsel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Validator;
use Intervention\Image\ImageManagerStatic as Image;

class ProfileController extends Controller
{
    public function editProfile($id){

        $id = Crypt::decryptString($id);
        if($id != Auth::id()){
            abort(404);
        }
        
        $user = Jemaat::where('user_id', $id)->first();
        $kebangsaan = Kebangsaan::all();
        $ibadah = Ibadah::all();
        $komsel = Komsel::all();

        return view('edit_profile', compact('id', 'user', 'kebangsaan', 'ibadah', 'komsel'));

    }

    public function updateProfilePicture(Request $request){

        $validator = Validator::make($request->all(), [ 
            'profile_picture' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }

        $id = Crypt::decryptString($request->id);

        $image = $request->file('profile_picture');
        $name = $image->hashName();

        $image_resize = Image::make($image->getRealPath());              
        $image_resize->resize(500, 500);
        $image_resize->save(public_path('storage/image/'.time().$name));

        Jemaat::where('user_id', $id)
        ->update(
            [
                'profile_picture_url' => 'storage/image/'.time().$name
            ]
        );

        return redirect()->back();
    }

    public function updateProfileMain(Request $request){

        $id = Crypt::decryptString($request->id);

        if($id != Auth::id()){
            abort(404);
        }

        Jemaat::where('user_id', $id)
        ->update(
            [
                'nama_panggilan' => $request->nickname,
                'jenis_kelamin' => $request->gender
            ]
        );

        return 'Success';
    }

    public function updateProfileAdditional(Request $request){

        $id = Crypt::decryptString($request->id);

        if($id != Auth::id()){
            abort(404);
        }

        Jemaat::where('user_id', $id)
        ->update(
            [
                'tempat_lahir' => $request->place_of_birth,
                'tanggal_lahir' => $request->date_of_birth,
                'golongan_darah' => $request->blood_group ?? null,
                'wa_2' => $request->wa_2,
                'hp_1' => $request->phone_no,
                'hp_2' => $request->additional_phone_no,
                'alamat_lengkap' => $request->address,
                'no_rt' => $request->no_rt,
                'no_rw' => $request->no_rw,
                'kode_pos' => $request->postal_code,
                'kebangsaan_id' => $request->nationality ?? null,
                'pendidikan_terakhir' => $request->last_education,
                'fungsi_keluarga' => $request->fungsi_keluarga,
                'status_nikah' => $request->status_nikah,
                'pendidikan_jurusan' => $request->pendidikan_jurusan,
                'tanggal_nikah' => $request->tanggal_pernikahan,
                'isSiapDonor' => $request->isSiapDonor == 'on' ? 1 : 0
            ]
        );

        return redirect()->back();
    }

    public function updateProfileSpiritual(Request $request){

        $id = Crypt::decryptString($request->id);

        if($id != Auth::id()){
            abort(404);
        }

        Jemaat::where('user_id', $id)
        ->update(
            [
                'kepercayaan_sebelumnya' => $request->kepercayaan_sebelumnya ?? null,
                'tahun_baptis_air' => $request->tahun_baptis_air,
                'tahun_baptis_roh' => $request->tahun_baptis_roh,
                'tahun_lahir_baru' => $request->tahun_lahir_baru,
                'berjemaat_sejak' => $request->berjemaat_sejak,
                'gereja_sebelumnya' => $request->gereja_sebelumnya,
                'ikut_ibadah_id' => $request->ikut_ibadah ?? null,
                'komsel_id' => $request->komsel ?? null,
            ]
        );

        return redirect()->back();
    }
}
