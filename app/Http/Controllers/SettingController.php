<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        return view('setting.index');
    }

    public function show()
    {
        return Setting::first();
    }

    public function update(Request $request)
    {
        try {
            $setting = Setting::first();
            $setting->telepon = $request->telepon;
            $setting->alamat = $request->alamat;
            $setting->diskon = $request->diskon;
            $setting->tipe_nota = $request->tipe_nota;

            if ($request->hasFile('path_logo')) {
                $file = $request->file('path_logo');
                $nama = 'logo-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('/img'), $nama);

                $setting->path_logo = "/img/$nama";
            }

            if ($request->hasFile('path_kartu_member')) {
                $file = $request->file('path_kartu_member');
                $nama = 'logo-' . date('Y-m-dHis') . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('/img'), $nama);

                $setting->path_kartu_member = "/img/$nama";
            }

            $setting->update();

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan',
                'data' => $setting
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
