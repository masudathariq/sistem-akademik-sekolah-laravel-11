<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SIAKAD - Mobile Login</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f8fafc;
            /* Mencegah scroll mental pada mobile */
            overscroll-behavior-y: contain;
        }
        .blue-gradient {
            background: linear-gradient(135deg, #020659 0%, #070db3 100%);
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }

/* ════════════════════════════════
   SPLASH LOADING SCREEN
════════════════════════════════ */
#page-loader {
    position: fixed;
    inset: 0;
    background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 100%);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    transition: opacity .5s ease, visibility .5s ease;
}

#page-loader.hide {
    opacity: 0;
    visibility: hidden;
}

/* Logo circle */
.loader-logo {
    width: 82px;
    height: 82px;
    background: rgba(255,255,255,.15);
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1rem;
    animation: pulse 1.8s ease-in-out infinite;
}

.loader-logo img {
    width: 54px;
    height: 54px;
    object-fit: contain;
}

/* Spinner ring */
.loader-ring {
    width: 42px;
    height: 42px;
    border: 3px solid rgba(255,255,255,.35);
    border-top-color: #fff;
    border-radius: 50%;
    animation: spin .9s linear infinite;
    margin-bottom: .9rem;
}

/* Text */
.loader-title {
    color: #fff;
    font-size: .95rem;
    font-weight: 700;
    letter-spacing: .02em;
    margin-bottom: .2rem;
    text-align: center;
}

.loader-sub {
    color: rgba(255,255,255,.75);
    font-size: .75rem;
    text-align: center;
}

/* Animations */
@keyframes spin {
    to { transform: rotate(360deg); }
}
@keyframes pulse {
    0%,100% { transform: scale(1); opacity: 1; }
    50% { transform: scale(1.06); opacity: .85; }
}


    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-slate-50 px-4">

<!-- LOADING SCREEN -->
<!-- SPLASH LOADING -->
<div id="page-loader">
    <div class="loader-logo">
        <img src="{{ asset('images/logo.png') }}" alt="Logo">
    </div>

    <div class="loader-ring"></div>

    <div class="loader-title">SIAKAD MTs Muhammadiyah 1 Natar</div>
    <div class="loader-sub">Menyiapkan sistem...</div>
</div>


    <div class="w-full max-w-md">

        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <img src="{{ asset('images/logo.png') }}" 
                 alt="Logo" 
                 class="w-20 h-20 object-contain">
        </div>

        <!-- Card -->
        <div class="bg-white shadow-sm border border-slate-200 rounded-2xl p-8">

            <!-- Title -->
            <div class="text-center mb-6">
                <h1 class="text-2xl font-bold text-slate-900">Masuk</h1>
                <p class="text-sm text-slate-500 mt-1">
                    Selamat datang di SIAKAD MTs Muhammadiyah 1 Natar
                </p>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Email
                    </label>
                    <input type="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required autofocus
                           placeholder="nama@email.com"
                           class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none text-sm transition">
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Password
                    </label>
                    <div class="relative">
                        <input id="password"
                               type="password"
                               name="password"
                               required
                               placeholder="Masukkan password"
                               class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none text-sm pr-12 transition">

                        <button type="button"
                                onclick="togglePassword()"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-blue-600">
                            👁
                        </button>
                    </div>
                </div>

                <!-- Link Bantuan -->
                <div class="text-right">
                    <a href="#" class="text-sm text-blue-600 hover:underline">
                        Lupa password?
                    </a>
                </div>

                <!-- Submit -->
                <button type="submit"
                        class="w-full bg-blue-700 hover:bg-blue-800 text-white font-semibold py-3 rounded-xl transition">
                    Masuk
                </button>
            </form>

        </div>

        <!-- Footer -->
        <div class="text-center mt-6 text-xs text-slate-400">
            © {{ date('Y') }} MTs Muhammadiyah 1 Natar
        </div>

    </div>

<script>
    function togglePassword() {
        const input = document.getElementById("password");
        input.type = input.type === "password" ? "text" : "password";
    }

    // Splash loading
    window.addEventListener("load", function () {
        setTimeout(() => {
            document.getElementById("page-loader").classList.add("hide");
        }, 1800); // durasi loading
    });
</script>



</body>




</html>