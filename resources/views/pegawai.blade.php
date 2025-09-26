<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profil Pegawai</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { color: #2c3e50; }
        ul { list-style-type: square; margin-left: 20px; }
        .highlight { font-weight: bold; color: #2980b9; }
    </style>
</head>
<body>
    <h1>Profil Pegawai</h1>

    <p><strong>Nama:</strong> {{ $name }}</p>
    <p><strong>Umur:</strong> {{ $my_age }} tahun</p>

    <p><strong>Hobi:</strong></p>
    <ul>
        @foreach ($hobbies as $hobby)
            <li>{{ $hobby }}</li>
        @endforeach
    </ul>

    <p><strong>Tanggal Harus Wisuda:</strong> {{ $tgl_harus_wisuda }}</p>
    <p><strong>Sisa Waktu Studi (hari):</strong> {{ $time_to_study_left }}</p>
    <p><strong>Semester Saat Ini:</strong> {{ $current_semester }}</p>

    <p class="highlight">{{ $message }}</p>

    <p><strong>Cita-cita:</strong> {{ $future_goal }}</p>
</body>
</html>
