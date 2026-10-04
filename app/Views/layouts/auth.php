<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Albu Project') ?> | Albu Project</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-sky-50 flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <div class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-600 text-white text-xl font-bold shadow-lg">A</div>
            <h1 class="mt-4 text-2xl font-bold text-gray-800">Albu Project</h1>
        </div>

        <div class="bg-white rounded-2xl shadow-xl p-8">
            <?= $this->include('partials/alerts') ?>
            <?= $this->renderSection('content') ?>
        </div>
    </div>
</body>
</html>
