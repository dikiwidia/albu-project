<?php

use CodeIgniter\Pager\PagerRenderer;

/**
 * Template pagination bergaya Tailwind (didaftarkan sebagai 'tailwind' di Config/Pager.php).
 *
 * @var PagerRenderer $pager
 */
$pager->setSurroundCount(2);

$base = 'rounded-lg border px-3 py-1.5 text-sm';
?>
<?php if ($pager->getPageCount() > 1): ?>
    <nav aria-label="Pagination" class="flex flex-wrap justify-end gap-1">
        <?php if ($pager->hasPrevious()): ?>
            <a href="<?= $pager->getFirst() ?>" class="<?= $base ?> border-gray-200 text-gray-600 hover:bg-gray-50">&laquo;</a>
            <a href="<?= $pager->getPrevious() ?>" class="<?= $base ?> border-gray-200 text-gray-600 hover:bg-gray-50">&lsaquo;</a>
        <?php endif ?>

        <?php foreach ($pager->links() as $link): ?>
            <a href="<?= $link['uri'] ?>"
                class="<?= $base ?> <?= $link['active'] ? 'border-indigo-600 bg-indigo-600 text-white' : 'border-gray-200 text-gray-600 hover:bg-gray-50' ?>">
                <?= $link['title'] ?>
            </a>
        <?php endforeach ?>

        <?php if ($pager->hasNext()): ?>
            <a href="<?= $pager->getNext() ?>" class="<?= $base ?> border-gray-200 text-gray-600 hover:bg-gray-50">&rsaquo;</a>
            <a href="<?= $pager->getLast() ?>" class="<?= $base ?> border-gray-200 text-gray-600 hover:bg-gray-50">&raquo;</a>
        <?php endif ?>
    </nav>
<?php endif ?>
