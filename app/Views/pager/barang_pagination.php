<?php $pager->setSurroundCount(2) ?>
<nav class="" aria-label="Page navigation example">
  <ul class="pagination justify-content-end">
    <li class="page-item">
      <?php if ($pager->hasPrevious()) : ?>
        <a class="" href="<?= $pager->getFirst() ?>" tabindex="-1" aria-disabled="true">First</a>
      <?php else : ?>
        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">First</a>
      <?php endif ?>
    </li>
    <li class="page-item">
      <?php if ($pager->hasPrevious()) : ?>
        <a class="page-link" href="<?= $pager->getPrevious() ?>" tabindex="-1" aria-disabled="true">Previous</a>
      <?php else : ?>
        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
      <?php endif ?>
    </li>
    <?php foreach ($pager->links() as $link) : ?>
      <li class="page-item <?= $link['active'] ?  'active' : '' ?>">
        <a class="page-link" href="<?= $link['uri'] ?>"><?= $link['title'] ?></a>
      </li>
    <?php endforeach ?>
    <li class="page-item">
      <?php if ($pager->hasNext()) : ?>
        <a class="page-link" href="<?= $pager->getNext() ?>">Next</a>
      <?php else : ?>
        <a class="page-link" href="#">Next</a>
      <?php endif ?>
    </li>
    <li class="page-item">
      <?php if ($pager->hasNext()) : ?>
        <a class="page-link" href="<?= $pager->getLast() ?>">Last</a>
      <?php else : ?>
        <a class="page-link" href="#">Last</a>
      <?php endif ?>
    </li>
  </ul>
</nav>
