<?php
$connections = array (
		'development' => 'mysql://root:gkim@localhost/ratech'
);

// initialize ActiveRecord
ActiveRecord\Config::initialize ( function ($cfg) use($connections) {
	$cfg->set_model_directory ( __DIR__ . '/../models' );
	$cfg->set_connections ( $connections );
} );