<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="rounded-xl bg-white shadow-sm">
    <div class="flex flex-col gap-3 border-b border-gray-100 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">
        <h3 class="font-semibold">Daftar User</h3>
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center">
            <form action="<?= site_url('users') ?>" method="get" class="flex gap-2">
                <input type="text" name="q" value="<?= esc($keyword) ?>" placeholder="Cari nama / email..."
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200 sm:w-56">
                <button type="submit" class="rounded-lg border border-gray-200 px-3 py-2 text-sm text-gray-600 hover:bg-gray-50">Cari</button>
            </form>
            <a href="<?= site_url('users/new') ?>"
                class="rounded-lg bg-indigo-600 px-4 py-2 text-center text-sm font-medium text-white hover:bg-indigo-700">
                + Tambah User
            </a>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 text-xs uppercase text-gray-500">
                <tr>
                    <th class="px-6 py-3">Nama</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">No. HP</th>
                    <th class="px-6 py-3">Role</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Login Terakhir</th>
                    <th class="px-6 py-3">Dibuat pada</th>
                    <th class="px-6 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php if (empty($users)): ?>
                    <tr>
                        <td colspan="7" class="px-6 py-6 text-center text-gray-400">Belum ada data user.</td>
                    </tr>
                <?php endif ?>
                <?php foreach ($users as $user): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-3 font-medium"><?= esc($user['nama']) ?></td>
                        <td class="px-6 py-3 text-gray-500"><?= esc($user['email']) ?></td>
                        <td class="px-6 py-3 text-gray-500"><?= esc($user['no_hp'] ?: '-') ?></td>
                        <td class="px-6 py-3">
                            <span class="rounded-full px-2.5 py-0.5 text-xs font-medium capitalize <?= $user['role'] === 'admin' ? 'bg-amber-100 text-amber-700' : 'bg-gray-100 text-gray-600' ?>">
                                <?= esc($user['role']) ?>
                            </span>
                        </td>
                        <td class="px-6 py-3">
                            <?php if ($user['is_active']): ?>
                                <span class="rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-700">Aktif</span>
                            <?php else: ?>
                                <span class="rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-700">Nonaktif</span>
                            <?php endif ?>
                        </td>
                        <td class="px-6 py-3 text-gray-500">
                            <?= $user['last_login'] ? esc(date('d M Y H:i', strtotime($user['last_login']))) : '-' ?>
                        </td>
                        <td class="px-6 py-3 text-gray-500">
                            <?= $user['created_at'] ? esc(date('d M Y H:i', strtotime($user['created_at']))) : '-' ?>
                        </td>
                        <td class="px-6 py-3">
                            <div class="flex justify-end gap-2">
                                <a href="<?= site_url('users/' . $user['id'] . '/edit') ?>"
                                    class="rounded-lg border border-gray-200 px-3 py-1.5 text-xs text-gray-600 hover:bg-indigo-50 hover:text-indigo-600">
                                    Edit
                                </a>
                                <?php if ((int) $user['id'] !== (int) session('user_id')): ?>
                                    <form action="<?= site_url('users/' . $user['id']) ?>" method="post"
                                        onsubmit="return confirm('Hapus user <?= esc($user['nama'], 'js') ?>?')">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit"
                                            class="rounded-lg border border-gray-200 px-3 py-1.5 text-xs text-gray-600 hover:bg-red-50 hover:text-red-600">
                                            Hapus
                                        </button>
                                    </form>
                                <?php endif ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

    <div class="border-t border-gray-100 px-6 py-4">
        <?= $pager->links('default', 'tailwind') ?>
    </div>
</div>
<?= $this->endSection() ?>