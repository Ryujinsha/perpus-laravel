<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<body class="page page--dashboard">
<div class="container">

    <header class="section-header">
        <h2 class="section-title">Edit Petugas</h2>
        <a href="/petugas" class="btn btn--secondary">Kembali</a>
    </header>

    <form action="/petugas/update/{{ $petugas->id_petugas }}" 
          method="POST" 
          class="card form-grid">
        @csrf

        <input type="text" 
               name="nama_petugas" 
               class="input"
               value="{{ $petugas->nama_petugas }}" 
               placeholder="Nama petugas">

        <input type="text" 
               name="username" 
               class="input"
               value="{{ $petugas->username }}" 
               placeholder="Username">

        <select name="posisi" class="input">
            <option value="Admin" 
                {{ $petugas->posisi == 'Admin' ? 'selected' : '' }}>
                Admin
            </option>
            <option value="Staff"
                {{ $petugas->posisi == 'Staff' ? 'selected' : '' }}>
                Staff
            </option>
        </select>

        <div class="form-actions">
            <button type="submit" class="btn btn--primary">Update</button>
            <button type="reset" class="btn btn--light">Reset</button>
        </div>
    </form>

</div>
</body>
