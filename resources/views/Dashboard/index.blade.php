<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<body class="page page--dashboard">
    <div class="dashboard">

        <header class="dashboard__header">
            <h2 class="dashboard__title">
                Welcome, {{ session('admin')['name'] ?? 'Admin' }}

            </h2>
            <p class="dashboard__subtitle">
                Selamat datang di Admin Panel
            </p>
        </header>

        <div class="dashboard__stats">
            <div class="card">
                <p class="card__label">Total Buku</p>
                <p class="card__value">{{ $totalBuku }}</p>
            </div>

            <div class="card">
                <p class="card__label">Total Petugas</p>
                <p class="card__value">{{ $totalPetugas }}</p>
            </div>
        </div>

        <div class="dashboard__grid">

            <div class="panel">
                <h3 class="panel__title">Buku Terbaru</h3>
                <ul class="panel__list">
                    @forelse($bukuTerbaru as $buku)
                        <li class="panel__item">
                            <span>{{ $buku->judul }}</span>
                            <small>{{ $buku->created_at->format('d M Y') }}</small>
                        </li>
                    @empty
                        <li class="panel__empty">Belum ada data</li>
                    @endforelse
                </ul>
            </div>

            <div class="panel">
                <h3 class="panel__title">Petugas Terbaru</h3>
                <ul class="panel__list">
                    @forelse($petugasTerbaru as $petugas)
                        <li class="panel__item">
                            <span>{{ $petugas->nama }}</span>
                            <small>{{ $petugas->created_at->format('d M Y') }}</small>
                        </li>
                    @empty
                        <li class="panel__empty">Belum ada data</li>
                    @endforelse
                </ul>
            </div>

        </div>

        <div class="dashboard__actions">
            <a href="/buku" class="btn btn--secondary">Kelola Buku</a>
            <a href="/petugas" class="btn btn--secondary">Kelola Petugas</a>
        </div>

        <form action="/logout" method="POST" class="dashboard__logout">
            @csrf
            <button class="btn btn--danger">Logout</button>
        </form>

    </div>
</body>
