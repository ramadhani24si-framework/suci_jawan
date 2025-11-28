<?php
namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage; // ✅ TAMBAH INI


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataUser = User::orderBy('created_at', 'desc')->paginate(2);
        return view('admin.user.index', compact('dataUser'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ✅ UPDATE VALIDASI
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $data = $request->only(['name', 'email']);
        $data['password'] = Hash::make($request->password);


        // ✅ HANDLE PROFILE PICTURE UPLOAD
        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $data['profile_picture'] = $profilePicturePath;
        }


        User::create($data);


        return redirect()->route('user.index')->with('success', 'Penambahan Data Berhasil!');
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
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);


        // ✅ UPDATE VALIDASI
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:8|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        // Jika password diisi, update password
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        } else {
            // Hapus password dari data jika tidak diisi
            unset($data['password']);
        }


        // ✅ HANDLE PROFILE PICTURE UPDATE
        if ($request->hasFile('profile_picture')) {
            // Delete old picture if exists
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }


            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $data['profile_picture'] = $profilePicturePath;
        }


        $user->update($data);


        return redirect()->route('user.index')->with('success', 'User berhasil diupdate!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);


        // ✅ DELETE PROFILE PICTURE IF EXISTS
        if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
            Storage::disk('public')->delete($user->profile_picture);
        }


        $user->delete();


        return redirect()->route('user.index')->with('success', 'Data berhasil dihapus!');
    }
}


