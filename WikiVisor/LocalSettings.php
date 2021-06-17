<?php
$egScssCacheType = CACHE_NONE;
$wgAllowSiteCSSOnRestrictedPages = true;
$wgRestrictDisplayTitle = false;
$wgNamespacesWithSubpages[NS_MAIN] = true;

$egChameleonAvailableLayoutFiles = [
	'standard'   => __DIR__ . '/skins/chameleon/layouts/standard.xml',
	'navhead'    => __DIR__ . '/skins/chameleon/layouts/navhead.xml',
	'fixedhead'  => __DIR__ . '/skins/chameleon/layouts/fixedhead.xml',
	'stickyhead' => __DIR__ . '/skins/chameleon/layouts/stickyhead.xml',
	'clean'      => __DIR__ . '/skins/chameleon/layouts/clean.xml',
];

$egChameleonLayoutFile= __DIR__ . '/skins/chameleon/layouts/custom.xml';

$egChameleonExternalStyleModules = [
	"$IP/extensions/wikivisor/skins/chameleon/custom.scss" => 'afterVariables',
];

$egChameleonExternalStyleVariables = [
	'body-color' => 'rgb(28, 44, 72)',
	'border-color' => '#445D7B',
	'headings-font-family' => 'ChaletBook, Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif',
	'border-radius' => '3px',
	'container-max-widths' => '(sm: 540px, md: 720px, lg: 960px, xl: 1440px)'
];

$wgLogos = [ '1x' => "$wgResourceBasePath/extensions/wikivisor/logo-placeholder.png" ];
