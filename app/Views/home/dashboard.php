<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Sambutan -->
<div class="mb-8 rounded-2xl bg-gradient-to-r from-indigo-600 to-sky-500 p-6 text-white shadow">
    <h2 class="text-2xl font-bold">Halo, <?= esc(session('nama')) ?> 👋</h2>
    <p class="mt-1 text-indigo-100">Selamat datang kembali di dashboard Albu Project.</p>
</div>

<!-- Statistik -->
<?php
$cards = [
    ['label' => 'Total User',       'value' => $stats['total'],    'color' => 'bg-indigo-100 text-indigo-600'],
    ['label' => 'User Aktif',       'value' => $stats['aktif'],    'color' => 'bg-green-100 text-green-600'],
    ['label' => 'Admin',            'value' => $stats['admin'],    'color' => 'bg-amber-100 text-amber-600'],
    ['label' => 'Daftar Bulan Ini', 'value' => $stats['bulanIni'], 'color' => 'bg-sky-100 text-sky-600'],
];
?>
<div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
    <?php foreach ($cards as $card): ?>
        <div class="flex items-center gap-4 rounded-xl bg-white p-5 shadow-sm">
            <div class="flex h-12 w-12 items-center justify-center rounded-lg <?= $card['color'] ?>">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87m8-4.13a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500"><?= esc($card['label']) ?></p>
                <p class="text-2xl font-bold"><?= number_format($card['value']) ?></p>
            </div>
        </div>
    <?php endforeach ?>
</div>

<!-- User terbaru -->
<div class="mt-8 rounded-xl bg-white shadow-sm">
    <div class="border-b border-gray-100 px-6 py-4">
        <h3 class="font-semibold">User Terbaru</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 text-xs uppercase text-gray-500">
                <tr>
                    <th class="px-6 py-3">Nama</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Role</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Terdaftar</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php if (empty($recentUsers)): ?>
                    <tr>
                        <td colspan="5" class="px-6 py-6 text-center text-gray-400">Belum ada data user.</td>
                    </tr>
                <?php endif ?>
                <?php foreach ($recentUsers as $user): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-3 font-medium"><?= esc($user['nama']) ?></td>
                        <td class="px-6 py-3 text-gray-500"><?= esc($user['email']) ?></td>
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
                        <td class="px-6 py-3 text-gray-500"><?= esc(date('d M Y', strtotime($user['created_at']))) ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<div class="mt-8 rounded-xl bg-white shadow-sm">
    <div class="border-b border-gray-100 px-6 py-4">
        <h3 class="font-semibold">Isi Session</h3>
    </div>
    <pre class="overflow-x-auto p-6 text-sm"><?= esc(print_r(session()->get(), true)) ?></pre>
</div>
<?= $this->endSection() ?>