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
            <th scope="row"><?= __('Type') ?></th>
            <td><?= $role->is_circle ? __('Circle') : __('Role'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Organization') ?></th>
            <td><?= $role->has('organization') ? $this->Html->link($role->organization->name, ['controller' => 'Organizations', 'action' => 'view', $role->organization->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Parent') ?></th>
            <td><?= $role->has('parent') ? $this->Html->link($role->parent->name, ['controller' => 'Roles', 'action' => 'view', $role->parent->id]) : '' ?></td>
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
    <br/>
    <? if ($role->is_circle and !empty($role->subroles)): ?>
        <h3><?= __('Roles and Subcircles') ?></h4>
        <table>
            <tr>
                <th>Name</th>
                <th>Type</th>
            </tr>
            <? foreach ($role->subroles as $subrole): ?>
                <tr>
                    <td><?= $this->Html->link($subrole->name, ['controller' => 'Roles', 'action' => 'view', $subrole->id]); ?></td>
                    <td><?= $subrole->is_circle ? __('Circle') : __('Role'); ?></td>
                </tr>
            <? endforeach ;?>
        </table>
    <?endif;?>
</div>
