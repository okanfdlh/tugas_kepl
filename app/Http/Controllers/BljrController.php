<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;
use App\Rules\LoginCheck;
use Illuminate\Support\Facades\Session;

class BljrController extends Controller
{
    //
    function tampil()
    {
        return view('home.cobaview');
    }
    function tampil2()
    {
        return "hellooooooooo";
    }
    function tampiladmin()
    {
        return view('admin.dashboard');
    }
    function login()
    {
        return view('admin.login');
    }
    function listbarang()
    {
        return view('admin.databarang');
    }

    function fhitung()
    {
        return view('admin.formhitung');
    }

    function calculate(Request $request)
    {
        $request->validate([
            'angka1' => 'required|numeric',
            'angka2' => 'required|numeric',
        ]);

        $number1 = $request->input('angka1');
        $number2 = $request->input('angka2');

        $result = $number1 + $number2;
        return view('admin.formhitung', compact('result', 'number1', 'number2'));
    }

    function fregister()
    {
        $users = UserModel::all();
        return view('admin.formregister', compact('users'));
    }

    function daftar(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:5|string|max:255',
            'no_hp' => 'required|min:5|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $dataInsert = [
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        UserModel::insert($dataInsert);

        return redirect()->route('formregister')->with('success', 'Pendaftaran Berhasil');
    }

    function editUser($id)
    {
        $users = UserModel::where('id', $id)->first();
        $data = [
            'user' => $users
        ];
        return view('admin.edituser', $data);
    }

    function updateUser(Request $request, $id)
    {
        $nama = $request->input('nama');
        $no_hp = $request->input('no_hp');
        $email = $request->input('email');
        $password = $request->input('password');

        $dataUpdate = [
            'nama' => $nama,
            'no_hp' => $no_hp,
            'email' => $email,
        ];

        if ($password) {
            $dataUpdate['password'] = Hash::make($password);
        }

        UserModel::where('id', $id)->update($dataUpdate);
        return redirect()->route('formregister')->with('success', 'Data Berhasil Diubah');
    }

    function deleteUser($id)
    {
        $user = UserModel::findOrFail($id);
        $user->delete();

        return redirect()->route('formregister')->with('success', 'Data Berhasil Dihapus');
    }

    function listgempa()
    {
        $url = 'https://data.bmkg.go.id/DataMKG/TEWS/gempaterkini.json';
        $json = file_get_contents($url);

        $data = json_decode($json, true);

        $gempaData = $data['Infogempa']['gempa'] ?? [];
        return view('admin.listgempa', compact('gempaData'));
    }

    function proseslogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => ['required', new LoginCheck($request)]
        ]);
        return redirect()->route('dashboardadmin');
    }

    function logout()
    {
        session::flush();
        return redirect()->route('loginadmin');
    }
}
