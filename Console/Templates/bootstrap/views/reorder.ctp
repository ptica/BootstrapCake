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
?>
<div class="<?php echo $pluralVar; ?> index">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
<?php 			if ($top_row_actions) { ?>
					<ul class="nav nav-pills pull-right">
						<li><?php echo "<?php echo \$this->Html->link('<span class=\"glyphicon glyphicon-plus\"></span>&nbsp;&nbsp;' . __('New " . $singularHumanName . "'), array('action' => 'add'), array('escape' => false)); ?>"; ?></li>
<?php
					if (!empty($schema['ord'])) { ?>
						<li><?php echo "<?php echo \$this->Html->link('<span class=\"glyphicon glyphicon-sort\"></span>&nbsp;&nbsp;' . __('Reorder'), array('action' => 'reorder'), array('escape' => false)); ?>"; ?></li>
<?php				}
					$done = array();
					foreach ($associations as $type => $data) {
						foreach ($data as $alias => $details) {
							if ($details['controller'] != $this->name && !in_array($details['controller'], $done)) {
								if (0) echo "\t\t\t\t\t\t\t<li><?php echo \$this->Html->link('<span class=\"glyphicon glyphicon-list\"></span>&nbsp;&nbsp;' . __('List " . Inflector::humanize($details['controller']) . "'), array('controller' => '{$details['controller']}', 'action' => 'index'), array('escape' => false)); ?> </li>\n";
								if (0) echo "\t\t\t\t\t\t\t<li><?php echo \$this->Html->link('<span class=\"glyphicon glyphicon-plus\"></span>&nbsp;&nbsp;' . __('New " . Inflector::humanize(Inflector::underscore($alias)) . "'), array('controller' => '{$details['controller']}', 'action' => 'add'), array('escape' => false)); ?> </li>\n";
								$done[] = $details['controller'];
							}
						}
					}
?>					</ul>
				<?php } ?>
				<h1><?php echo "<?php echo __('{$pluralHumanName}'); ?>"; ?></h1>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-3">
			<?php echo "<?php echo \$this->element('admin_navigation'); ?>\n"; ?>
			<?php if (!$top_row_actions) { ?>
				<div class="actions">
					<div class="panel panel-default">
						<div class="panel-heading"><?php echo "<?php echo __('Actions'); ?>"; ?></div>
							<div class="panel-body">
								<ul class="nav nav-pills nav-stacked">
									<li><?php echo "<?php echo \$this->Html->link('<span class=\"glyphicon glyphicon-plus\"></span>&nbsp;&nbsp;' . __('New " . $singularHumanName . "'), array('action' => 'add'), array('escape' => false)); ?>"; ?></li>
	<?php
								$done = array();
								foreach ($associations as $type => $data) {
									foreach ($data as $alias => $details) {
										if ($details['controller'] != $this->name && !in_array($details['controller'], $done)) {
											echo "\t\t<li><?php echo \$this->Html->link(__('<span class=\"glyphicon glyphicon-list\"></span>&nbsp;&nbsp;List " . Inflector::humanize($details['controller']) . "'), array('controller' => '{$details['controller']}', 'action' => 'index'), array('escape' => false)); ?> </li>\n";
											echo "\t\t<li><?php echo \$this->Html->link(__('<span class=\"glyphicon glyphicon-plus\"></span>&nbsp;&nbsp;New " . Inflector::humanize(Inflector::underscore($alias)) . "'), array('controller' => '{$details['controller']}', 'action' => 'add'), array('escape' => false)); ?> </li>\n";
											$done[] = $details['controller'];
										}
									}
								}
	?>							</ul>
							</div><!-- end body -->
					</div><!-- end panel -->
				</div><!-- end actions -->
			<?php } ?>
		</div><!-- end col md 3 -->

		<div class="col-md-9">
			<div id="sortable<?php echo ucfirst($pluralVar) ?>" class="list-group" data-reorder-url="<?php echo Router::url(array('controller'=>$pluralVar, 'action'=>'reorder', 'admin'=>true)) ?>">
				<?php echo "<?php foreach ($".$pluralVar." as \$item) {?>\n" ?>
					<div class="list-group-item" data-item-id="<?php echo "<?php echo h(\$item['".$modelClass."']['id']); ?>" ?>">
						<span class="glyphicon glyphicon-move" aria-hidden="true"></span>
						<?php echo "<?php echo \$this->Html->link(\$item['".$modelClass."']['name'], array('action' => 'index', \$item['$modelClass']['id'])); ?>" ?>
					</div>
				<?php echo "<?php } ?>\n" ?>
			</div>
		</div> <!-- end col md 9 -->
	</div><!-- end row -->

</div>
