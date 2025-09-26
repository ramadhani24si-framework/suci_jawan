<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon; 
class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $name = 'Suci Ramadhani';
        $tanggal_lahir = '2005-05-15';
        $hobbies = ['Membaca', 'Bersepeda', 'Memancing', 'Main Game', 'Nonton Film'];
        $tgl_harus_wisuda = '2025-12-15';
        $current_semester = 8;
        $future_goal = 'Menjadi Software Engineer Handal';

        $birthDate = Carbon::parse($tanggal_lahir);
        $my_age = $birthDate->age;

        $today = Carbon::today();
        $graduationDate = Carbon::parse($tgl_harus_wisuda);
        $time_to_study_left = $today->diffInDays($graduationDate, false);

        if ($current_semester < 3) {
            $message = "Masih Awal, Kejar TAK";
        } else {
            $message = "Jangan main-main, kurang-kurangi main game!";
        }

        $data = [
            'name' => $name,
            'my_age' => $my_age,
            'hobbies' => $hobbies,
            'tgl_harus_wisuda' => $tgl_harus_wisuda,
            'time_to_study_left' => $time_to_study_left,
            'current_semester' => $current_semester,
            'message' => $message,
            'future_goal' => $future_goal,
        ];

        return view('pegawai.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
