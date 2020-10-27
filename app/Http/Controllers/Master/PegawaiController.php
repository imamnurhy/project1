<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Datatables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Models\Pegawai;
use App\Models\Unitkerja;
use App\Models\Opd;
use App\Models\User;
use App\Models\Golongan;
use App\Models\Eselon;

use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Tmopd;

class PegawaiController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pegawai = Pegawai::find(Auth::user()->id);
        $auth_pegawai_id = ($pegawai) ? $pegawai->id : 0;
        return view('master.pegawai', compact('auth_pegawai_id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'n_pegawai'    => 'required',
            'telp'         => 'required|string|min:10|max:14|unique:pegawais,telp',
            'alamat'       => 'required',
            't_lahir'      => 'required',
            'd_lahir'      => 'required',
            'jk'           => 'required',
            'pekerjaan'    => 'required',
        ]);

        $input = $request->all();
        Pegawai::create($input);

        return response()->json([
            'success' => true,
            'message' => 'Data pegawai berhasil tersimpan.'
        ]);
    }

    public function edit($id)
    {
        return Pegawai::find($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'n_pegawai' => 'required',
            'telp' => 'required|string|min:10|max:14|unique:pegawais,telp,' . $id,
            't_lahir' => 'required',
            'd_lahir' => 'required',
            'jk' => 'required',
            'pekerjaan' => 'required',
            'alamat' => 'required',
        ]);

        $input = $request->all();
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->update($input);

        return response()->json([
            'success' => true,
            'message' => 'Data pegawai berhasil diperbaharui.'
        ]);
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $lastFoto = $pegawai->foto;
        if ($lastFoto != '') {
            Storage::disk('sftp')->delete('foto/' . $lastFoto);
        }

        User::destroy($pegawai->user_id);
        Pegawai::destroy($id);
        return response()->json([
            'success' => true,
            'message' => 'Data pegawai berhasil dihapus.'
        ]);
    }

    public function api()
    {
        $pegawai = Pegawai::get();
        return Datatables::of($pegawai)
            ->editColumn('user_id', function ($p) {
                if ($p->user_id == "") {
                    return "Tidak <a href='" . route('user.add_user', $p->id) . "' class='float-right text-success' title='Tambah sebagai pengguna aplikasi'><i class='icon-user-plus'></i></a>";
                } else {
                    return "Ya <a href='" . route('user.edit', $p->user_id) . "' class='float-right' title='Edit akun user'><i class='icon-user'></i></a>";
                }
            })
            ->editColumn('foto', function ($p) {
                if ($p->foto == "") {
                    $img = "Tidak";
                } else {
                    $img = "<img src='' alt='img' align='center' width='50%'/>";
                }
                return $img . "<br/><a onclick='editFoto(" . $p->id . ")' href='javascript:;' data-fancybox data-src='#formUpload' data-modal='true' title='Upload foto pegawai' class='btn btn-xs'>Unggah Foto <i class='icon-upload'></i></a>";
            })
            ->addColumn('action', function ($p) {
                return
                    "<a onclick='edit(" . $p->id . ")' data-fancybox data-src='#formAdd' data-modal='true' href='javascript:;' title='Edit Pegawai'><i class='icon-pencil mr-1'></i></a>
                    <a href='#' onclick='remove(" . $p->id . ")' class='text-danger' title='Hapus Pegawai' id='del_" . $p->id . "'><i class='icon-remove'></i></a>";
            })
            ->rawColumns(['foto', 'user_id', 'action'])
            ->toJson();
    }


    //--- Foto
    public function updateFoto(Request $request, $id)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $pegawai = Pegawai::findOrFail($id);
        $lastFoto = $pegawai->foto;
        $foto = $request->file('foto');
        $nameFoto = $pegawai->nip . '_' . rand() . '.' . $foto->getClientOriginalExtension();
        $foto->storeAs('foto', $nameFoto, 'sftp', 'public');
        $pegawai->foto = $nameFoto;
        $pegawai->save();

        if ($lastFoto != '') {
            Storage::disk('sftp')->delete('foto/' . $lastFoto);
        }

        return response()->json([
            'success'   => true,
            'message' => $nameFoto
        ]);
    }
}
