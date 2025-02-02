<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ManageAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("manage_admin.index");
    }

    public function data()
    {
        $users = User::where('level', 1)->get();
        return datatables()->of($users)
            ->addIndexColumn()
            ->addColumn('foto', function ($user) {
                if ($user->foto && file_exists(public_path('storage/' . $user->foto))) {
                    return asset('storage/' . $user->foto);
                } else {
                    return asset('images/unknown-avatar.png'); // Sesuaikan dengan path gambar default Anda
                }
            })
            ->addColumn('aksi', function ($user) {
                $editUrl = route('admin.edit', $user->id);
                $deleteUrl = route('admin.destroy', $user->id);
                return '
                <div class="btn-group">
                    <button onclick="editForm(\'' . $editUrl . '\')" class="btn btn-sm btn-info text-white">Edit</button>
                    <button onclick="deleteData(\'' . $deleteUrl . '\')" class="btn btn-sm btn-danger text-white">Delete</button>
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
