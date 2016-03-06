<nav style="font-size: 0.6em;font-weight: bold">
    <ul class="pagination">
        <li>
            <a href="<?= $pagination['page_url_begin'] ?>" aria-label="Previous">
                <span aria-hidden="true" class="glyphicon glyphicon-chevron-left"></span>
            </a>
        </li>                            
        <?php for ($i = 0; $i < $pagination['page_all']; $i++) { ?>
            <?php $index = ($i + 1) ?>
            <li class="<?= ($pagination['page_current'] == $index ? 'active' : '') ?>">
                <a href="<?=
                Yii::app()->createUrl('site/news', array(
                    'page' => $index,
                ))
                ?>"><?= $index ?>
                </a>
            </li>
        <?php } ?>
        <li>
            <a href="<?= $pagination['page_url_end'] ?>" aria-label="Next">
                <span aria-hidden="true" class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </li>

    </ul>
</nav>
