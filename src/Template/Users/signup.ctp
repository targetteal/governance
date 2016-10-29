<div class="large-4 medium-4 columns">
    &nbsp;
</div>
<div class="users form large-4 medium-4 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Signup') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('email');
            echo $this->Form->input('password');
            echo $this->Form->input('Organization.name', ['label'=>'Organization Name']);
            echo $this->Form->input('Organization.shortname', ['label'=>'Organization Short Name']);
            echo $this->Form->input('Organization.url', ['label'=>'Organization Website']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Signup')) ?>
    <?= $this->Form->end() ?>
</div>
<div class="large-4 medium-4 columns">
    &nbsp;
</div>