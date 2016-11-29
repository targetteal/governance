<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Roles') ?></li>
        <li><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Roles Holarchy'), ['controller' => 'Roles', 'action' => 'nested']) ?></li>
        <? if (isset($role) and $role->id): ?>
	        <li><?= $this->Html->link(__('Edit Role'), ['controller' => 'Roles', 'action' => 'edit', $role->id]) ?> </li>
	        <li><?= $this->Form->postLink(
	                __('Delete'),
	                ['controller' => 'Roles', 'action' => 'delete', $role->id],
	                ['confirm' => __('Are you sure you want to delete # {0}?', $role->id)]
	            )
	        ?></li>
        <?endif;?>
        <li class="heading"><?= __('Users') ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <? if (isset($user) and $user->id): ?>
            <li><?= $this->Html->link(__('Edit User'), ['controller' => 'Users', 'action' => 'edit', $user->id]) ?> </li>
            <li><?= $this->Form->postLink(
                    __('Delete'),
                    ['controller' => 'Users', 'action' => 'delete', $user->id],
                    ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]
                )
            ?></li>
        <?endif;?>
        <li class="heading"><?= __('Assignments') ?></li>
        <li><?= $this->Html->link(__('New Assignment'), ['controller' => 'Assignments', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Assignments'), ['controller' => 'Assignments', 'action' => 'index']) ?></li>
        <? if (isset($user) and $user->id): ?>
            <li><?= $this->Html->link(__('Edit User'), ['controller' => 'Assignments', 'action' => 'edit', $user->id]) ?> </li>
            <li><?= $this->Form->postLink(
                    __('Delete'),
                    ['controller' => 'Assignments', 'action' => 'delete', $user->id],
                    ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]
                )
            ?></li>
        <?endif;?>    </ul>
</nav>
