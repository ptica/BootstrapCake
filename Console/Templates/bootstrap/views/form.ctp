<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Console.Templates.default.views
 * @since         CakePHP(tm) v 1.2.0.5234
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<?php
	include(dirname(dirname(__FILE__)) . DS .  'common_params.php');
	if (!$include_ord_field) {
		if (($key = array_search('ord', $fields)) !== false) {
			unset($fields[$key]);
		}
	}
?>
<div class="<?php echo $pluralVar; ?> form">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
<?php   		if ($top_row_actions) { ?>
				<ul class="nav nav-pills pull-right">
<?php   			if (strpos($action, 'add') === false): ?>
					<li><?php echo "<?php echo \$this->Form->postLink('<span class=\"glyphicon glyphicon-remove\"></span>&nbsp;&nbsp;' . __('Delete'), array('action'=>'delete', \$this->Form->value('{$modelClass}.{$primaryKey}')), array('escape'=>false), __('Are you sure you want to delete # %s?', \$this->Form->value('{$modelClass}.{$primaryKey}'))); ?>"; ?></li>
<?php   			endif; ?>
					<li><?php echo "<?php echo \$this->Html->link('<span class=\"glyphicon glyphicon-list\"></span>&nbsp;&nbsp;' . __('List " . $pluralHumanName . "'), array('action'=>'index'), array('escape'=>false)); ?>"; ?></li>
<?php
						$done = array();
						foreach ($associations as $type => $data) {
							foreach ($data as $alias => $details) {
								if ($details['controller'] != $this->name && !in_array($details['controller'], $done)) {
									if (0) echo "\t\t\t\t\t<li><?php echo \$this->Html->link('<span class=\"glyphicon glyphicon-list\"></span>&nbsp;&nbsp;' . __('List " . Inflector::humanize($details['controller']) . "'), array('controller'=>'{$details['controller']}', 'action'=>'index'), array('escape'=>false)); ?> </li>\n";
									if (0) echo "\t\t\t\t\t<li><?php echo \$this->Html->link('<span class=\"glyphicon glyphicon-plus\"></span>&nbsp;&nbsp;' . __('New " . Inflector::humanize(Inflector::underscore($alias)) . "'), array('controller'=>'{$details['controller']}', 'action'=>'add'), array('escape'=>false)); ?> </li>\n";
									$done[] = $details['controller'];
								}
							}
						}
					?>
				</ul>
<?php   		} ?>
				<h1><?php printf("<?php echo __('%s %s'); ?>", Inflector::humanize($action), $singularHumanName); ?></h1>
			</div>
		</div>
	</div>



	<div class="row">
		<div class="col-md-3">
			<?php echo "<?php echo \$this->element('admin_navigation'); ?>\n"; ?>
<?php   		if (!$top_row_actions) { ?>
				<div class="actions">
					<div class="panel panel-default">
						<div class="panel-heading">Actions</div>
						<div class="panel-body">
							<ul class="nav nav-pills nav-stacked">
<?php   						if (strpos($action, 'add') === false): ?>
									<li><?php echo "<?php echo \$this->Form->postLink('<span class=\"glyphicon glyphicon-remove\"></span>&nbsp;&nbsp;' . __('Delete'), array('action'=>'delete', \$this->Form->value('{$modelClass}.{$primaryKey}')), array('escape' => false), __('Are you sure you want to delete # %s?', \$this->Form->value('{$modelClass}.{$primaryKey}'))); ?>"; ?></li>
<?php   						endif; ?>
									<li><?php echo "<?php echo \$this->Html->link('<span class=\"glyphicon glyphicon-list\"></span>&nbsp;&nbsp;' . __('List " . $pluralHumanName . "'), array('action'=>'index'), array('escape'=>false)); ?>"; ?></li>
<?php
									$done = array();
									foreach ($associations as $type => $data) {
										foreach ($data as $alias => $details) {
											if ($details['controller'] != $this->name && !in_array($details['controller'], $done)) {
												echo "\t\t<li><?php echo \$this->Html->link('<span class=\"glyphicon glyphicon-list\"></span>&nbsp;&nbsp;' . __('List " . Inflector::humanize($details['controller']) . "'), array('controller'=>'{$details['controller']}', 'action'=>'index'), array('escape'=>false)); ?> </li>\n";
												echo "\t\t<li><?php echo \$this->Html->link('<span class=\"glyphicon glyphicon-plus\"></span>&nbsp;&nbsp;' . __('New " . Inflector::humanize(Inflector::underscore($alias)) . "'), array('controller'=>'{$details['controller']}', 'action'=>'add'), array('escape'=>false)); ?> </li>\n";
												$done[] = $details['controller'];
											}
										}
									}
							?>
							</ul>
						</div>
					</div>
				</div>
<?php   		} ?>
		</div><!-- end col md 3 -->
		<div class="col-md-9">
<?php 		echo "\t\t\t<?php echo \$this->Form->create('{$modelClass}', array('role'=>'form', 'class'=>'form-horizontal')); ?>\n\n"; ?>
<?php
		foreach ($fields as $field) {
			if (strpos($action, 'add') !== false && $field == $primaryKey) {
				continue;
			} elseif (!in_array($field, array('created', 'modified', 'updated'))) {
				if ($schema[$field]['type'] == 'text') {
					echo "\t\t\t\t<div class=\"form-group\">\n";
					echo "\t\t\t\t\t<?php echo \$this->Form->input('{$field}', array('data-provide'=>'wysiwyg', 'class'=>'form-control', 'placeholder'=>__('".Inflector::humanize($field)."')));?>\n";
					echo "\t\t\t\t</div>\n";
				} elseif ($schema[$field]['type'] == 'datetime') {
					echo "\t\t\t\t<div class=\"form-group\">\n";
					echo "\t\t\t\t\t<?php echo \$this->Form->input('{$field}', array(\n";
					echo "\t\t\t\t\t\t'type' => 'text',\n";
					echo "\t\t\t\t\t\t'data-provide' => 'datepicker',\n";
					echo "\t\t\t\t\t\t'data-date-language' => Configure::read('Config.locale'),\n";
					echo "\t\t\t\t\t\t'class' => 'form-control',\n";
					echo "\t\t\t\t\t\t'label' => __('".Inflector::humanize($field)."'),\n";
					echo "\t\t\t\t\t\t'placeholder' => __('".Inflector::humanize($field)."'),\n";
					echo "\t\t\t\t\t\t'inputGroup' => array('append'=>'glyphicon-th'),\n";
					echo "\t\t\t\t\t\t//BEWARE: datepicker needs JS initialization\n";
					echo "\t\t\t\t\t));?>\n";
					echo "\t\t\t\t</div>\n";
				} else {
					echo "\t\t\t\t<div class=\"form-group\">\n";
					echo "\t\t\t\t\t<?php echo \$this->Form->input('{$field}', array('class'=>'form-control', 'placeholder'=>__('".Inflector::humanize($field)."')));?>\n";
					echo "\t\t\t\t</div>\n";
				}
			}
		}
		if (!empty($associations['hasAndBelongsToMany'])) {
			foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData) {
				echo "\t\t\t\t<div class=\"form-group\">\n";
				echo "\t\t\t\t\t<?php echo \$this->Form->input('{$assocName}', array('class'=>'form-control', 'placeholder'=>__('".Inflector::humanize($field)."')));?>\n";
				echo "\t\t\t\t</div>\n";
			}
		}
?>
<?php
				echo "\t\t\t\t<div class=\"form-group\">\n";
				echo "\t\t\t\t\t<div class=\"col-sm-offset-2 col-sm-8\">\n";
				echo "\t\t\t\t\t\t<?php echo \$this->Form->submit(__('Submit'), array('class'=>'btn btn-primary')); ?>\n";
				echo "\t\t\t\t\t</div>\n\n";
				echo "\t\t\t\t</div>\n\n";

			echo "\t\t\t<?php echo \$this->Form->end() ?>\n\n";

?>
		</div><!-- end col md 12 -->
	</div><!-- end row -->
</div>
