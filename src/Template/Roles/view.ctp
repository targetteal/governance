<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Role'), ['action' => 'edit', $role->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Role'), ['action' => 'delete', $role->id], ['confirm' => __('Are you sure you want to delete # {0}?', $role->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Roles'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Role'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Organizations'), ['controller' => 'Organizations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Organization'), ['controller' => 'Organizations', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="roles view large-9 medium-8 columns content">
    <h3><?= h($role->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($role->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Organization') ?></th>
            <td><?= $role->has('organization') ? $this->Html->link($role->organization->name, ['controller' => 'Organizations', 'action' => 'view', $role->organization->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($role->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Role Id Parent') ?></th>
            <td><?= $this->Number->format($role->role_id_parent) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Circle') ?></th>
            <td><?= $role->is_circle ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Purpose') ?></h4>
        <?= $this->Text->autoParagraph(h($role->purpose)); ?>
    </div>
    <div class="row">
        <h4><?= __('Domains') ?></h4>
        <?= $this->Text->autoParagraph(h($role->domains)); ?>
    </div>
    <div class="row">
        <h4><?= __('Accountabilities') ?></h4>
        <?= $this->Text->autoParagraph(h($role->accountabilities)); ?>
    </div>
</div>
