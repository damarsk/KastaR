<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ManageKasirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('manage_kasir.index');
    }

    public function data() 
    {
        $users = User::where('level', 0)->get();

        return datatables()
            ->of($users)
            ->addIndexColumn()
            ->addColumn('aksi', function ($user) {
                $editUrl = route('kasir.edit', $user->id);
                $updateUrl = route('kasir.update', $user->id);
                $deleteUrl = route('kasir.destroy', $user->id);
                return '
                <div class="btn-group">
                    <button onclick="editForm(\'' . $editUrl . '\', \'' . $updateUrl . '\')" class="btn btn-sm btn-info text-white"><i class="fa fa-edit"></i></button>
                    <button onclick="deleteData(\'' . $deleteUrl . '\')" class="btn btn-sm btn-danger text-white"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8|same:password',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->level = 0;

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('uploads/photos'), $photoName);
            $user->foto = $photoName;
        }

        $user->save();

        return response()->json(['success' => true, 'message' => 'Akun berhasil dibuat!.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($user->foto) {
                $oldPhotoPath = public_path('uploads/photos/' . $user->foto);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }

            $photo = $request->file('photo');
            $photoName = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('uploads/photos'), $photoName);
            $user->foto = $photoName;
        }

        $user->save();

        return response()->json('Data Berhasil Diubah!', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if ($user) {
            // Hapus foto jika ada
            if ($user->foto) {
                $oldPhotoPath = public_path('uploads/photos/' . $user->foto);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }

            $user->delete();
            return response()->json(['success' => true, 'message' => 'Akun berhasil dihapus!']);
        }

        return response()->json(['success' => false, 'message' => 'Akun tidak ditemukan.'], 404);
    }
}
