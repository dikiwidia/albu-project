<?= $this->extend('layouts/auth') ?>

<?= $this->section('content') ?>
<h2 class="text-xl font-semibold text-gray-800">Buat akun baru</h2>
<p class="mt-1 text-sm text-gray-500">Isi data berikut untuk mendaftar.</p>

<form action="<?= site_url('register') ?>" method="post" class="mt-6 space-y-4">
    <?= csrf_field() ?>

    <div>
        <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
        <input type="text" id="nama" name="nama" value="<?= old('nama') ?>" required autofocus
               class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200">
    </div>

    <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" id="email" name="email" value="<?= old('email') ?>" required
               class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200">
    </div>

    <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" id="password" name="password" required minlength="8"
               class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200">
        <p class="mt-1 text-xs text-gray-400">Minimal 8 karakter.</p>
    </div>

    <div>
        <label for="password_confirm" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
        <input type="password" id="password_confirm" name="password_confirm" required
               class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200">
    </div>

    <button type="submit"
            class="w-full rounded-lg bg-indigo-600 px-4 py-2.5 font-medium text-white hover:bg-indigo-700 transition">
        Daftar
    </button>
</form>

<p class="mt-6 text-center text-sm text-gray-500">
    Sudah punya akun?
    <a href="<?= site_url('login') ?>" class="font-medium text-indigo-600 hover:underline">Login</a>
</p>
<?= $this->endSection() ?>
