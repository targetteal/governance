<?= $this->element('lateral_menu') ?>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User to your Organization') ?></legend>
        <?php
            echo $this->Form->input('name', ['autocomplete' => 'off']);
            echo $this->Form->input('email', ['autocomplete' => 'off']);
            echo $this->Form->input('password', ['autocomplete' => 'off']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Save')) ?>
    <?= $this->Form->end() ?>
</div>
