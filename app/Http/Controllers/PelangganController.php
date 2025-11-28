<?php
namespace App\Http\Controllers;


use App\Models\MultipleUpload;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filterableColumns     = ['gender'];
        $searchableColumns     = ['first_name', 'last_name', 'email', 'phone'];
        $data['dataPelanggan'] = Pelanggan::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->paginate(10)
            ->onEachSide(2);


        return view('admin.pelanggan.index', $data);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pelanggan.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data['first_name'] = $request->first_name;
        $data['last_name']  = $request->last_name;
        $data['birthday']   = $request->birthday;
        $data['gender']     = $request->gender;
        $data['email']      = $request->email;
        $data['phone']      = $request->phone;


        Pelanggan::create($data);


        return redirect()->route('pelanggan.index')->with('success', 'Penambahan Data Berhasil!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['pelanggan'] = Pelanggan::with('files')->findOrFail($id);
        return view('admin.pelanggan.show', $data);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // PERBAIKAN: Load files relationship dan gunakan variabel 'pelanggan'
        $data['pelanggan'] = Pelanggan::with('files')->findOrFail($id);
        return view('admin.pelanggan.edit', $data);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pelanggan_id = $id;
        $pelanggan    = Pelanggan::findOrFail($pelanggan_id);


        $pelanggan->first_name = $request->first_name;
        $pelanggan->last_name  = $request->last_name;
        $pelanggan->birthday   = $request->birthday;
        $pelanggan->gender     = $request->gender;
        $pelanggan->email      = $request->email;
        $pelanggan->phone      = $request->phone;


        $pelanggan->save();


        // PERBAIKAN: Redirect ke edit agar bisa lanjut upload file
        return redirect()->route('pelanggan.edit', $pelanggan->pelanggan_id)->with('success', 'Data Berhasil Diupdate!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);


        // Hapus semua file terkait pelanggan
        foreach ($pelanggan->files as $file) {
            Storage::delete('public/uploads/' . $file->filename);
            $file->delete();
        }


        $pelanggan->delete();


        return redirect()->route('pelanggan.index')->with('success', 'Data Berhasil Dihapus!');
    }


    /**
     * Upload multiple files for pelanggan
     */
    public function uploadFiles(Request $request, string $id)
    {
        $request->validate([
            'files.*' => 'required|file|mimes:jpg,jpeg,png,pdf,doc,docx,txt|max:2048',
        ]);


        $pelanggan     = Pelanggan::findOrFail($id);
        $uploadedFiles = [];


        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $filename = time() . '' . uniqid() . '' . $file->getClientOriginalName();
                $file->storeAs('public/uploads', $filename);


                $uploadedFile = MultipleUpload::create([
                    'filename'      => $filename,
                    'original_name' => $file->getClientOriginalName(),
                    'ref_table'     => 'pelanggan',
                    'ref_id'        => $pelanggan->pelanggan_id,
                ]);


                $uploadedFiles[] = $uploadedFile;
            }
        }


        $fileCount = count($uploadedFiles);
        return back()->with('success', "{$fileCount} file berhasil diupload!");
    }


    /**
     * Delete specific file for pelanggan
     */
    public function deleteFile(string $id, string $fileId)
    {
        $pelanggan = Pelanggan::findOrFail($id);


        $file = MultipleUpload::where('id', $fileId)
            ->where('ref_table', 'pelanggan')
            ->where('ref_id', $pelanggan->pelanggan_id)
            ->firstOrFail();


        $fileName = $file->original_name;


        // Delete physical file
        Storage::delete('public/uploads/' . $file->filename);


        // Delete database record
        $file->delete();


        return back()->with('success', "File '{$fileName}' berhasil dihapus!");
    }
}



