<?php if (session()->getFlashdata('success')): ?>
    <div class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
        <?= esc(session()->getFlashdata('success')) ?>
    </div>
<?php endif ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
        <?= esc(session()->getFlashdata('error')) ?>
    </div>
<?php endif ?>

<?php if (session()->getFlashdata('errors')): ?>
    <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
        <ul class="list-disc list-inside space-y-1">
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif ?>
