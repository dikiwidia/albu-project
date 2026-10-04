<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Albu Project') ?> | Albu Project</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside id="sidebar"
            class="fixed inset-y-0 left-0 z-30 w-64 -translate-x-full transform bg-slate-900 text-slate-300 transition-transform md:static md:translate-x-0">
            <div class="flex h-16 items-center gap-3 px-6 border-b border-slate-800">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-600 font-bold text-white">A</div>
                <span class="text-lg font-semibold text-white">Albu Project</span>
            </div>
            <nav class="mt-6 space-y-1 px-3">
                <a href="<?= site_url('/') ?>"
                    class="flex items-center gap-3 rounded-lg px-3 py-2 <?= url_is('/') ? 'bg-slate-800 text-white' : 'hover:bg-slate-800 hover:text-white' ?>">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l9-9 9 9M5 10v10h14V10" />
                    </svg>
                    Dashboard
                </a>
                <a href="#" class="flex items-center gap-3 rounded-lg px-3 py-2 hover:bg-slate-800 hover:text-white">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87m8-4.13a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Users
                </a>
                <a href="#" class="flex items-center gap-3 rounded-lg px-3 py-2 hover:bg-slate-800 hover:text-white">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.3 4.3c.4-1.7 2.9-1.7 3.4 0a1.7 1.7 0 002.6 1.1c1.5-.9 3.3.8 2.4 2.4a1.7 1.7 0 001 2.5c1.8.4 1.8 2.9 0 3.4a1.7 1.7 0 00-1 2.6c.9 1.5-.9 3.3-2.4 2.4a1.7 1.7 0 00-2.6 1c-.4 1.8-2.9 1.8-3.4 0a1.7 1.7 0 00-2.5-1c-1.6.9-3.3-.9-2.4-2.4a1.7 1.7 0 00-1.1-2.6c-1.7-.4-1.7-2.9 0-3.4a1.7 1.7 0 001.1-2.5c-.9-1.6.8-3.3 2.4-2.4a1.7 1.7 0 002.5-1.1z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                    Pengaturan
                </a>
            </nav>
        </aside>

        <!-- Overlay mobile -->
        <div id="overlay" class="fixed inset-0 z-20 hidden bg-black/40 md:hidden"></div>

        <div class="flex flex-1 flex-col min-w-0">
            <!-- Topbar -->
            <header class="flex h-16 items-center justify-between bg-white px-4 shadow-sm md:px-8">
                <div class="flex items-center gap-3">
                    <button id="menuBtn" class="rounded-lg p-2 hover:bg-gray-100 md:hidden" aria-label="Menu">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <h1 class="text-lg font-semibold"><?= esc($title ?? '') ?></h1>
                </div>
                <div class="flex items-center gap-4">
                    <div class="hidden text-right sm:block">
                        <p class="text-sm font-medium"><?= esc(session('nama')) ?></p>
                        <p class="text-xsp text-gray-500"><?= esc(session('email')) ?></p>
                    </div>
                    <div class="flex h-9 w-9 items-center justify-center rounded-full bg-indigo-100 font-semibold text-indigo-700">
                        <?= esc(strtoupper(mb_substr((string) session('nama'), 0, 1))) ?>
                    </div>
                    <form action="<?= site_url('logout') ?>" method="post">
                        <?= csrf_field() ?>
                        <button type="submit"
                            class="rounded-lg border border-gray-200 px-3 py-1.5 text-sm text-gray-600 hover:bg-red-50 hover:text-red-600">
                            Logout
                        </button>
                    </form>
                </div>
            </header>

            <main class="flex-1 p-4 md:p-8">
                <?= $this->include('partials/alerts') ?>
                <?= $this->renderSection('content') ?>
            </main>

            <footer class="px-8 py-4 text-center text-xs text-gray-400">
                &copy; <?= date('Y') ?> Albu Project
            </footer>
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const toggle = () => {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        };
        document.getElementById('menuBtn').addEventListener('click', toggle);
        overlay.addEventListener('click', toggle);
    </script>
</body>

</html>