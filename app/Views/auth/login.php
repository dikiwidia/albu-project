<?= $this->extend('layouts/auth') ?>

<?= $this->section('content') ?>
<h2 class="text-xl font-semibold text-gray-800">Masuk ke akun Anda</h2>
<p class="mt-1 text-sm text-gray-500">Silakan masukkan email dan password.</p>

<form action="<?= site_url('login') ?>" method="post" class="mt-6 space-y-4">
    <?= csrf_field() ?>

    <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" id="email" name="email" value="<?= old('email') ?>" required autofocus
               class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200">
    </div>

    <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" id="password" name="password" required
               class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200">
    </div>

    <button type="submit"
            class="w-full rounded-lg bg-indigo-600 px-4 py-2.5 font-medium text-white hover:bg-indigo-700 transition">
        Login
    </button>
</form>

<p class="mt-6 text-center text-sm text-gray-500">
    Belum punya akun?
    <a href="<?= site_url('register') ?>" class="font-medium text-indigo-600 hover:underline">Daftar sekarang</a>
</p>
<?= $this->endSection() ?>
