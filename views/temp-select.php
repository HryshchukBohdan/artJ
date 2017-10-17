<?php foreach ($territory as $ter): ?>
    <option class="del" value="<?= $ter['ter_id']; ?>"><?= $ter['ter_name']; ?></option>
<?php endforeach; ?>