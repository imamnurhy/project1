<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Datatables;
use Spatie\Permission\Models\Role;

use App\Models\Pegawai;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = user::find($id);
        $roles = Role::all();
        return view('master._user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        switch ($request->type) {
            case 1:
                $c_status = ($request->c_status == 'on' ? 1 : 0);
                $user = User::findOrFail($id);
                $user->status = $c_status;
                $user->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Data user berhasil diperbaharui. Status user ' . $c_status
                ]);
                break;
            case 2:
                $request->validate([
                    'username' => 'required|unique:users,username,' . $id
                ]);

                $username = $request->username;
                $user = User::findOrFail($id);
                $user->username = $username;
                $user->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Data user berhasil diperbaharui. Username user ' . $username
                ]);
                break;
            case 3:
                $request->validate([
                    'password' => 'required|string|min:6|confirmed'
                ]);

                $password = bcrypt($request->password);
                $user = User::findOrFail($id);
                $user->password = $password;
                $user->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Data user berhasil diperbaharui. Password user ' . $request->password
                ]);
                break;
            case 4:
                $user = User::findOrFail($id);
                $user->assignRole($request->roles);

                return response()->json([
                    'success' => true,
                    'message' => 'Data role berhasil diperbaharui'
                ]);
                break;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pegawai::where('user_id', $id)->update(['user_id' => 0]);
        User::destroy($id);

        return response()->json([
            'success' => true,
            'message' => 'Data user berhasil dihapus.'
        ]);
    }

    public function add_user($pegawai_id)
    {
        $pegawai = Pegawai::findOrFail($pegawai_id);
        if ($pegawai->user_id == 0) {
            $user = User::updateOrCreate([
                'username' => $pegawai->n_pegawai,
                'password' => bcrypt('123456'),
                'lastlogin' => '',
                'status' => 1
            ]);
            $user_id = $user->id;
            $pegawai->user_id = $user_id;
            $pegawai->save();
        } else {
            $user_id = $pegawai->user_id;
        }
        return redirect()->route('user.edit', $user_id);
    }

    public function getRoles($id)
    {
        return User::find($id)->getRoleNames();
    }

    public function destroyRole(Request $request, $name)
    {
        return User::find($request->id)->removeRole($name);
    }
}
