<style>
	ul.tree {
		padding: 0;
		margin: 0;
		list-style-type: none;
		position: relative;
	}
	ul.tree li {
		list-style-type: none;
		border-left: 2px solid #000;
		margin-left: 1em;
	}
	ul.tree li div {
		padding-left: 1em;
		position: relative;
	}
	ul.tree li div::before {
		content:'';
		position: absolute;
		top: 0;
		left: -2px;
		bottom: 50%;
		width: 0.75em;
		border: 2px solid #000;
		border-top: 0 none transparent;
		border-right: 0 none transparent;
	}
	ul.tree > li:last-child {
		border-left: 2px solid transparent;
	}
</style>
<?
function printRoles ($that, $array, $level = 1) {
	echo '<ul class="tree">';
	foreach ($array as $id => $element) {
		echo '<li><div>';
		echo $that->Html->link($element['name'], ['action' => 'view', $id]);
		echo '</div>';
		if (isset($element['children']) and count($element['children']) > 0) {
			printRoles($that, $element['children'], $level + 1);
		}
		echo "</li>";
	}
	echo '</ul>';
}
?>
<?= $this->element('lateral_menu') ?>
<div class="roles form large-9 medium-8 columns content">
    <h3><?= __('Roles Holarchy') ?></h3>
   	<? if (empty($tree)): ?>
    	<p>There are no roles to show.</p>
    <? else : ?>
  	 	<? printRoles($this, $tree); ?>
    <? endif;?>
</div>
