<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use App\Models\Pegawai;

class AccountController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile()
    {
        return view('account.profile');
    }

    public function password()
    {
        return view('account.password');
    }
    
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_last' => 'required|string|min:6',
            'password' => 'required|string|min:6|confirmed|different:password_last'
        ]);

        if (!password_verify($request->password_last, Auth::user()->password)) {
            return response()->json([
                'message' => "Password lama salah."
            ], 422);
        }

        $user = User::findOrFail(Auth::user()->id);
        $user->password = bcrypt($request->password);
        $user->save();
        
        return response()->json([
            'message' => 'Data user berhasil diperbaharui.'
        ]);
    }

    public function updateFoto(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        $file = $request->file('file');
        if(!in_array($file->getClientOriginalExtension(), ['jpeg', 'jpg', 'png'])){
            return response()->json([
                'message' => "Terdapat kesalahan saat menyimpan data.<br/>Error Allow Extension."
            ], 422);
        }
        
        $user_id = Auth::User()->pegawai->id;

            //--- Delete Last Foto
        $pegawai = Pegawai::select('id', 'foto')->where('id', $user_id)->first();
        if($pegawai->foto != '')
        {
            Storage::disk('sftp')->delete('foto/'.$pegawai->file);
        }

        $nameFile = $user_id.rand().'.'.$file->getClientOriginalExtension();
        $file->storeAs('foto', $nameFile, 'sftp', 'public');

        $pegawai->foto = $nameFile;
        $pegawai->save();

        return response()->json([
            'file' => $nameFile,
            'message' => 'Berhasil mengunggah foto'
        ]);
    }
}
