<?php
/*
 * This file is part of Oveleon ContaoPropstackApiBundle.
 *
 * (c) https://www.oveleon.de/
 */

$GLOBALS['TL_DCA']['tl_propstack_settings'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'File',
		'closed'                      => true
	),

	// Palettes
	'palettes' => array
	(
		'default'                     => '{api_authentication_legend},propstackApiKey;'
	),

	// Fields
	'fields' => array
	(
		'propstackApiKey' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_propstack_settings']['propstackApiKey'],
			'inputType'               => 'text',
			'eval'                    => array('tl_class'=>'w50')
		)
	)
);
