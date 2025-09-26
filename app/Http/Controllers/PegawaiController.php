<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        $name = 'Suci Ramadhani';
        $tanggal_lahir = '2005-05-15';
        $hobbies = ['Membaca', 'Bersepeda', 'Memancing', 'Main Game', 'Nonton Film'];
        $tgl_harus_wisuda = '2025-12-15';
        $current_semester = 8;
        $future_goal = 'Menjadi Software Engineer Handal';

        // Hitung umur tanpa Carbon
        $birthDate = new \DateTime($tanggal_lahir);
        $today = new \DateTime();
        $ageInterval = $birthDate->diff($today);
        $my_age = $ageInterval->y;

        // Hitung sisa hari sampai wisuda tanpa Carbon
        $graduationDate = new \DateTime($tgl_harus_wisuda);
        $diffInterval = $today->diff($graduationDate);
        // diff->days selalu positif, kita cek apakah wisuda sudah lewat atau belum dengan invert
        $time_to_study_left = $diffInterval->invert ? -$diffInterval->days : $diffInterval->days;

        // Pesan sesuai semester
        if ($current_semester < 3) {
            $message = "Masih Awal, Kejar TAK";
        } else {
            $message = "Jangan main-main, kurang-kurangi main game!";
        }

        return view('pegawai.index', [
            'name' => $name,
            'my_age' => $my_age,
            'hobbies' => $hobbies,
            'tgl_harus_wisuda' => $tgl_harus_wisuda,
            'time_to_study_left' => $time_to_study_left,
            'current_semester' => $current_semester,
            'message' => $message,
            'future_goal' => $future_goal,
        ]);
    }
}
