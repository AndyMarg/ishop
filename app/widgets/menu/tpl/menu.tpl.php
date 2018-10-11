<?php var_dump($category); ?>
<?php $parent = isset($category['childs']); ?>
<li>
    <a href="category/<?=$category['alias'];?>"><?=$category['title'];?></a>
    <?php if(isset($category['childs'])): ?>
        <?=$this->getMenuHtml($category['childs']);?>
    <?php endif; ?>
</li>