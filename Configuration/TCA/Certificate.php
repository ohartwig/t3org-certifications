<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_certifications_domain_model_certificate'] = array(
	'ctrl' => $TCA['tx_certifications_domain_model_certificate']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, certification_date, expiration_date, allow_listing, expired, certificate_type',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, certification_date, expiration_date, allow_listing, expired, certificate_type,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_certifications_domain_model_certificate',
				'foreign_table_where' => 'AND tx_certifications_domain_model_certificate.pid=###CURRENT_PID### AND tx_certifications_domain_model_certificate.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'certification_date' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:certifications/Resources/Private/Language/locallang_db.xml:tx_certifications_domain_model_certificate.certification_date',
			'config' => array(
				'type' => 'input',
				'size' => 7,
				'eval' => 'date,required',
				'checkbox' => 1,
				'default' => time()
			),
		),
        'expiration_date' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:certifications/Resources/Private/Language/locallang_db.xml:tx_certifications_domain_model_certificate.expiration_date',
            'config' => array(
                'type' => 'input',
                'size' => 7,
                'eval' => 'date',
                'checkbox' => 1,
                'default' => 0
            )
        ),
		'allow_listing' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:certifications/Resources/Private/Language/locallang_db.xml:tx_certifications_domain_model_certificate.allow_listing',
			'config' => array(
				'type' => 'check',
				'default' => 0
			),
		),
		'expired' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:certifications/Resources/Private/Language/locallang_db.xml:tx_certifications_domain_model_certificate.expired',
			'config' => array(
				'type' => 'check',
				'default' => 0
			),
		),
		'certificate_type' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:certifications/Resources/Private/Language/locallang_db.xml:tx_certifications_domain_model_certificate.certificate_type',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_certifications_domain_model_certificatetype',
				'minitems' => 0,
				'maxitems' => 1,
                'wizards' => array(
                    '_PADDING' => 5,
                    '_VERTICAL' => 0,
                    'suggest' => array(
                        'type' => 'suggest'
                    ),
                )
			),
		),
		'feusers' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
	),
);

?>