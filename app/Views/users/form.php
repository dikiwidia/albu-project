<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<?php
// $user null = mode tambah, berisi data = mode edit
$isEdit   = $user !== null;
$isSelf   = $isEdit && (int) $user['id'] === (int) session('user_id');
$role     = old('role', $user['role'] ?? 'user');
$isActive = old('is_active', $isEdit ? $user['is_active'] : 1);
$input    = 'mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200 disabled:bg-gray-100';
?>
<div class="max-w-2xl rounded-xl bg-white shadow-sm">
    <div class="border-b border-gray-100 px-6 py-4">
        <h3 class="font-semibold"><?= esc($title) ?></h3>
    </div>

    <form action="<?= site_url($isEdit ? 'users/' . $user['id'] : 'users') ?>" method="post" class="space-y-4 p-6">
        <?= csrf_field() ?>
        <?php if ($isEdit): ?>
            <input type="hidden" name="_method" value="PUT">
        <?php endif ?>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" value="<?= esc(old('nama', $user['nama'] ?? '')) ?>" required class="<?= $input ?>">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" value="<?= esc(old('email', $user['email'] ?? '')) ?>" required class="<?= $input ?>">
            </div>

            <div>
                <label for="no_hp" class="block text-sm font-medium text-gray-700">No. HP</label>
                <input type="text" id="no_hp" name="no_hp" value="<?= esc(old('no_hp', $user['no_hp'] ?? '')) ?>" class="<?= $input ?>">
            </div>

            <div>
                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                <select id="role" name="role" class="<?= $input ?>" <?= $isSelf ? 'disabled' : '' ?>>
                    <option value="user" <?= $role === 'user' ? 'selected' : '' ?>>User</option>
                    <option value="admin" <?= $role === 'admin' ? 'selected' : '' ?>>Admin</option>
                </select>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" minlength="8" <?= $isEdit ? '' : 'required' ?> class="<?= $input ?>">
                <p class="mt-1 text-xs text-gray-400">
                    <?= $isEdit ? 'Kosongkan jika tidak ingin mengubah password.' : 'Minimal 8 karakter.' ?>
                </p>
            </div>

            <div>
                <label for="password_confirm" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <input type="password" id="password_confirm" name="password_confirm" <?= $isEdit ? '' : 'required' ?> class="<?= $input ?>">
            </div>
        </div>

        <label class="flex items-center gap-2 text-sm text-gray-700">
            <input type="checkbox" name="is_active" value="1" <?= $isActive ? 'checked' : '' ?> <?= $isSelf ? 'disabled' : '' ?>
                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
            Akun aktif
        </label>

        <?php if ($isSelf): ?>
            <p class="text-xs text-gray-400">Role dan status akun Anda sendiri tidak dapat diubah.</p>
        <?php endif ?>

        <div class="flex justify-end gap-2 pt-2">
            <a href="<?= site_url('users') ?>" class="rounded-lg border border-gray-200 px-4 py-2 text-sm text-gray-600 hover:bg-gray-50">Batal</a>
            <button type="submit" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">
                <?= $isEdit ? 'Simpan Perubahan' : 'Simpan' ?>
            </button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>