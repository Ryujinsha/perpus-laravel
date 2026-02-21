<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<body class="page page--dashboard">
<div class="container">

    <header class="section-header">
        <h2 class="section-title">Manajemen Petugas</h2>
        <div class="section-actions">
            <a href="/dashboard" class="btn btn--secondary">Dashboard</a>
            <form action="/logout" method="POST" class="inline-form">
                @csrf
                <button class="btn btn--danger">Logout</button>
            </form>
        </div>
    </header>

    <form action="/petugas/search" method="GET" class="card form-inline">
        <input type="text" name="s" class="input" placeholder="Cari petugas...">
        <button type="submit" class="btn btn--primary">Search</button>
        <a href="/petugas" class="btn btn--light">Reset</a>
    </form>

    <form action="/petugas/store" method="POST" class="card form-grid">
        @csrf
        <h3 class="card-title">Tambah Petugas</h3>

        <input type="text" name="nama_petugas" class="input" placeholder="Nama petugas">
        <input type="text" name="username" class="input" placeholder="Username">
        <input type="password" name="password" class="input" placeholder="Password">

        <select name="posisi" class="input">
            <option value="" disabled selected>Pilih Posisi</option>
            <option value="Admin">Admin</option>
            <option value="Staff">Staff</option>
        </select>

        <button type="submit" class="btn btn--primary btn--block">
            Tambah Petugas
        </button>
    </form>

    <div class="card">
        <h3 class="card-title">Daftar Petugas</h3>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Posisi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($petugas as $p)
                <tr>
                    <td>{{ $p->id_petugas }}</td>
                    <td>{{ $p->nama_petugas }}</td>
                    <td>{{ $p->username }}</td>
                    <td>{{ $p->posisi }}</td>
                    <td class="table-actions">
                        <a href="/petugas/edit/{{ $p->id_petugas }}" 
                           class="btn btn--warning btn--sm">Edit</a>
                        <a href="/petugas/delete/{{ $p->id_petugas }}" 
                           class="btn btn--danger btn--sm">Hapus</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
</body>
