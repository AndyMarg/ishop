<option value="" class="label"><?= $currency['code']; ?></option>
<?php foreach($currencies as $key => $value): ?>
    <?php if($key !== $currency['code']): ?>
        <option value="<?= $key; ?>"><?= $key; ?></option>
    <?php endif; ?>
<?php endforeach; ?>

        


        