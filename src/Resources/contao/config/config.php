<?php
use Oveleon\ContaoPropstackApiBundle\Model\PropstackAuthModel;

// Back end modules
array_insert($GLOBALS['BE_MOD'], 1, array
(
    'propstack' => array
    (
        'propstack_auth' => array
        (
            'tables'      => array('tl_propstack_auth')
        ),
        'propstack_settings' => array
        (
            'tables'      => array('tl_propstack_settings')
        )
    )
));

// Models
$GLOBALS['TL_MODELS']['tl_propstack_auth'] = PropstackAuthModel::class;

// Style sheet
if (TL_MODE == 'BE')
{
    $GLOBALS['TL_CSS'][] = 'bundles/contaopropstackapi/style.css|static';
}
