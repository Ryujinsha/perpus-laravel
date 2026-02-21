<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<body class="page page--dashboard">
<div class="container">

    <header class="section-header">
        <h2 class="section-title">Edit Buku</h2>
        <a href="/buku" class="btn btn--secondary">Kembali</a>
    </header>

    <form action="/buku/update/{{ $buku->id_buku }}" method="POST" class="card form-grid">
        @csrf

        <input type="text" name="judul_buku" class="input"
            value="{{ $buku->judul_buku }}" placeholder="Judul buku">

        <input type="text" name="penerbit" class="input"
            value="{{ $buku->penerbit }}" placeholder="Penerbit">

        <input type="text" name="tahun_terbit" class="input"
            value="{{ $buku->tahun_terbit }}" placeholder="Tahun Terbit">

        <input type="text" name="penulis" class="input"
            value="{{ $buku->penulis }}" placeholder="Penulis">

        <div class="form-actions">
            <button type="submit" class="btn btn--primary">Update</button>
            <button type="reset" class="btn btn--light">Reset</button>
        </div>
    </form>

</div>
</body>
