<?= $this->element('lateral_menu')?>
<div class="roles form large-9 medium-8 columns content">
    <?= $this->Form->create($role) ?>
    <fieldset>
        <legend><?= __('Edit Role') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('is_circle');
            echo $this->Form->input('parent_id', ['options' => $roles, 'empty' => '-']);
            echo $this->Form->input('purpose');
            echo $this->Form->input('domains');
            echo $this->Form->input('accountabilities');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
