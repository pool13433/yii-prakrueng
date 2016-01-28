<nav>
    <ul class="pagination">

        <li>
            <a href="<?= $pagination['page_url_begin'] ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>                            
        <?php for ($i = 0; $i < $pagination['page_all']; $i++) { ?>
            <?php $index = ($i + 1) ?>
            <li class="<?= ($pagination['page_current'] == $index ? 'active' : '') ?>">
                <a href="<?=
                Yii::app()->createUrl('site/index', array(                    
                    'typeId' => $pagination['page_type_id'],
                    'user' => $pagination['page_user_id'],
                    'page' => $index,
                ))
                ?>"><?= $index ?>
                </a>
            </li>
        <?php } ?>
        <li>
            <a href="<?= $pagination['page_url_end'] ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>

    </ul>
</nav>
