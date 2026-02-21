<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<body class="page page--dashboard">
<div class="container">

    <header class="section-header">
        <h2 class="section-title">Manajemen Buku</h2>
        <div class="section-actions">
            <a href="/dashboard" class="btn btn--secondary">Dashboard</a>
            <form action="/logout" method="POST" class="inline-form">
                @csrf
                <button class="btn btn--danger">Logout</button>
            </form>
        </div>
    </header>

    <form action="/buku/search" method="GET" class="card form-inline">
        <input type="text" name="q" class="input" placeholder="Cari buku...">
        <button type="submit" class="btn btn--primary">Search</button>
        <a href="/buku" class="btn btn--light">Reset</a>
    </form>

    <form action="/buku/store" method="POST" class="card form-grid">
        @csrf
        <h3 class="card-title">Tambah Buku</h3>

        <input type="text" name="judul_buku" class="input" placeholder="Judul buku">
        <input type="text" name="penerbit" class="input" placeholder="Penerbit">
        <input type="number" name="tahun_terbit" class="input" placeholder="Tahun Terbit" max="9999">
        <input type="text" name="penulis" class="input" placeholder="Penulis">

        <button type="submit" class="btn btn--primary btn--block">Tambah Buku</button>
    </form>

    <div class="card">
        <h3 class="card-title">Daftar Buku</h3>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Penerbit</th>
                    <th>Tahun</th>
                    <th>Penulis</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($buku as $b)
                <tr>
                    <td>{{ $b->id_buku }}</td>
                    <td>{{ $b->judul_buku }}</td>
                    <td>{{ $b->penerbit }}</td>
                    <td>{{ $b->tahun_terbit }}</td>
                    <td>{{ $b->penulis }}</td>
                    <td class="table-actions">
                        <a href="/buku/edit/{{ $b->id_buku }}" class="btn btn--warning btn--sm">Edit</a>
                        <a href="/buku/delete/{{ $b->id_buku }}" class="btn btn--danger btn--sm">Hapus</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
</body>
