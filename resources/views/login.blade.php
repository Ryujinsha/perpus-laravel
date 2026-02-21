<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<body class="page page--auth">
    <div class="auth">
        <form action="/login" method="POST" class="auth__form">
            @csrf
            
            <h2 class="auth__title">Login Dulu Cuy</h2>

            <div class="form-control">
                <label class="form-control__label">Username</label>
                <input type="text" name="username" class="form-control__input" placeholder="Enter your username">
            </div>

            <div class="form-control">
                <label class="form-control__label">Password</label>
                <input type="password" name="password" class="form-control__input" placeholder="Enter your password">
            </div>

            <button type="submit" class="btn btn--primary btn--block">Login</button>
        </form>
    </div>
</body>
