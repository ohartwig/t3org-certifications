<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'Certlist',
	'Certification List'
);

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Certifications');

t3lib_div::loadTCA('fe_users');
if (!isset($TCA['fe_users']['ctrl']['type'])) {
	// no type field defined, so we define it here. This will only happen the first time the extension is installed!!
	$TCA['fe_users']['ctrl']['type'] = 'tx_extbase_type';
	$tempColumns = array();
	$tempColumns[$TCA['fe_users']['ctrl']['type']] = array(
		'exclude' => 1,
		'label'   => 'LLL:EXT:certifications/Resources/Private/Language/locallang_db.xml:tx_certifications_domain_model_feusers.tx_extbase_type',
		'config' => array(
			'type' => 'select',
			'items' => array(
				array('LLL:EXT:certifications/Resources/Private/Language/locallang_db.xml:tx_certifications_domain_model_feusers.tx_extbase_type.0','0'),
			),
			'size' => 1,
			'maxitems' => 1,
			'default' => 'Tx_Certifications_FeUsers'
		)
	);
	t3lib_extMgm::addTCAcolumns('fe_users', $tempColumns, 1);
}

$TCA['fe_users']['types']['Tx_Certifications_FeUsers']['showitem'] = $TCA['fe_users']['types']['Tx_Extbase_Domain_Model_FrontendUser']['showitem'];
$TCA['fe_users']['columns'][$TCA['fe_users']['ctrl']['type']]['config']['items'][] = array('LLL:EXT:certifications/Resources/Private/Language/locallang_db.xml:tx_certifications_domain_model_feusers','Tx_Certifications_FeUsers');
t3lib_extMgm::addToAllTCAtypes('fe_users', $TCA['fe_users']['ctrl']['type'],'','after:hidden');

$tmp_certifications_columns = array(
    'cert_reason' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:certifications/Resources/Private/Language/locallang_db.xml:tx_certifications_domain_model_feusers.cert_reason',
		'config' => array(
			'type' => 'input',
			'size' => 50,
			'eval' => 'trim'
		),
	),
	'public_email_address' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:certifications/Resources/Private/Language/locallang_db.xml:tx_certifications_domain_model_feusers.public_email_address',
		'config' => array(
			'type' => 'check',
			'default' => 0
		),
	),
	'certificates' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:certifications/Resources/Private/Language/locallang_db.xml:tx_certifications_domain_model_feusers.certificates',
		'config' => array(
			'type' => 'inline',
			'foreign_table' => 'tx_certifications_domain_model_certificate',
			'foreign_field' => 'feusers',
            'foreign_default_sortby' => 'certification_date',
			'maxitems'      => 9999,
			'appearance' => array(
				'collapseAll' => 1,
				'levelLinksPosition' => 'top',
				'showSynchronizationLink' => 0,
				'showPossibleLocalizationRecords' => 0,
				'showAllLocalizationLink' => 0
			),
		),
	),
);

t3lib_extMgm::addTCAcolumns('fe_users',$tmp_certifications_columns);

$TCA['fe_users']['columns'][$TCA['fe_users']['ctrl']['type']]['config']['items'][] = array('LLL:EXT:certifications/Resources/Private/Language/locallang_db.xml:fe_users.tx_extbase_type.Tx_Certifications_FeUsers','Tx_Certifications_FeUsers');

$TCA['fe_users']['types']['Tx_Certifications_FeUsers']['showitem'] = $TCA['fe_users']['types']['Tx_Extbase_Domain_Model_FrontendUser']['showitem'];
$TCA['fe_users']['types']['Tx_Certifications_FeUsers']['showitem'] .= ',--div--;LLL:EXT:certifications/Resources/Private/Language/locallang_db.xml:tx_certifications_domain_model_feusers,';
$TCA['fe_users']['types']['Tx_Certifications_FeUsers']['showitem'] .= 'cert_reason, public_email_address, certificates';

t3lib_extMgm::addLLrefForTCAdescr('tx_certifications_domain_model_certificate', 'EXT:certifications/Resources/Private/Language/locallang_csh_tx_certifications_domain_model_certificate.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_certifications_domain_model_certificate');
$TCA['tx_certifications_domain_model_certificate'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:certifications/Resources/Private/Language/locallang_db.xml:tx_certifications_domain_model_certificate',
		'label' => 'certification_date',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'certification_date,allow_listing,expired,certificate_type,',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Certificate.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_certifications_domain_model_certificate.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_certifications_domain_model_certificatetype', 'EXT:certifications/Resources/Private/Language/locallang_csh_tx_certifications_domain_model_certificatetype.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_certifications_domain_model_certificatetype');
$TCA['tx_certifications_domain_model_certificatetype'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:certifications/Resources/Private/Language/locallang_db.xml:tx_certifications_domain_model_certificatetype',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'title,',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/CertificateType.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_certifications_domain_model_certificatetype.gif'
	),
);

?>