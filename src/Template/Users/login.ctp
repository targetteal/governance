<div class="large-4 medium-4 columns">
	&nbsp;
</div>
<div class="users form large-4 medium-4 columns content">
	<?= $this->Flash->render('auth') ?>
	<?= $this->Form->create() ?>
	    <fieldset>
	        <legend><?= __('Por favor informe seu usuário e senha') ?></legend>
	        <?= $this->Form->input('email') ?>
	        <?= $this->Form->input('password') ?>
	    </fieldset>
	<?= $this->Form->button(__('Login')); ?>
	<?= $this->Form->end() ?>
</div>
<div class="large-4 medium-4 columns">
</div>
