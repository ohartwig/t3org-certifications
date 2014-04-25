<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Certlist',
	array(
		'FeUsers' => 'list, listSorted, show',

	),
	// non-cacheable actions
	array(
		'FeUsers' => '',

	)
);

//Hook for save generatet Username and Password
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] = 'EXT:certifications/Classes/Hooks/Tcemain.php:Tx_Certifications_Hooks_Tcemain';

?>