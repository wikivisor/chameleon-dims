<?php
# Disable reading by anonymous users
$wgGroupPermissions['*']['read'] = false;
$wgGroupPermissions['user']['read'] = true;
$wgGroupPermissions['editor']['read'] = true;
$wgGroupPermissions['sysop']['read'] = true;

$wgWhitelistRead = [
	"MediaWiki:Back-to-top.css", "MediaWiki:Chameleon-load.js", "MediaWiki:Back-to-top.js"
];

# Disable anonymous editing
$wgGroupPermissions['*']['edit'] = false;
$wgGroupPermissions['user']['edit'] = false;
$wgGroupPermissions['editor']['edit'] = true;
$wgGroupPermissions['sysop']['edit'] = true;

# Prevent new user registrations except by sysops
$wgGroupPermissions['*']['createaccount'] = false;
$wgGroupPermissions['user']['createaccount'] = false;
$wgGroupPermissions['editor']['createaccount'] = false;
$wgGroupPermissions['sysop']['createaccount'] = true;

# Allow file uploads
$wgEnableUploads = true;
$wgUseImageMagick = true;
$wgImageMagickConvertCommand = "/usr/bin/convert";
$wgFileExtensions = [ 'png', 'gif', 'jpg', 'jpeg', 'doc',
    'xls', 'mpp', 'pdf', 'ppt', 'tiff', 'bmp', 'docx', 'xlsx',
    'pptx', 'ps', 'odt', 'ods', 'odp', 'odg'
];

# Cache setup
$wgObjectCaches['redis'] = [
        'class'                => 'RedisBagOStuff',
        'servers'              => [ '127.0.0.1:6379' ],
//      'connectTimeout'    => 1,
//      'persistent'        => false,
//      'password'          => 'secret',
//      'automaticFailOver' => true,
];

$wgMainCacheType = CACHE_ACCEL;
$wgParserCacheType = 'redis';
$wgSessionCacheType = CACHE_DB;

$wgJobTypeConf['default'] = [
        'class'          => 'JobQueueRedis',
        'redisServer'    => '127.0.0.1:6379',
        'redisConfig'    => [],
        'claimTTL'       => 3600,
        'daemonized'     => true
];

# Skin setup
wfLoadExtension( 'Bootstrap' );
wfLoadSkin( 'chameleon' );
$wgDefaultSkin = "chameleon";

$egScssCacheType = CACHE_NONE;
$wgAllowSiteCSSOnRestrictedPages = true;
$wgRestrictDisplayTitle = false;
$wgNamespacesWithSubpages[NS_MAIN] = true;

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

// Estensions
wfLoadExtension( 'CodeEditor' );
wfLoadExtension( 'Cite' );
wfLoadExtension( 'MultimediaViewer' );
wfLoadExtension( 'PageImages' );
wfLoadExtension( 'ParserFunctions' );
wfLoadExtension( 'ReplaceText' );
wfLoadExtension( 'SecureLinkFixer' );
wfLoadExtension( 'SyntaxHighlight_GeSHi' );
wfLoadExtension( 'TextExtracts' );
wfLoadExtension( 'WikiEditor' );

wfLoadExtension( 'PageExchange' );
wfLoadExtension( 'MyVariables' );
wfLoadExtension( 'ShowMe' );

// PageExchange
# $wgPageExchangePackageFiles[] = 'https://raw.githubusercontent.com/wikivisor/chameleon-dims/master/page-exchange.json';

// ParserFunctions
$wgPFEnableStringFunctions = true;

// NetworkAuth
#require_once "$IP/extensions/NetworkAuth/NetworkAuth.php";
# Log-in unlogged users from these networks
$wgNetworkAuthUsers[] = [
	'iprange' => [
		'127.0.0.1',
		'172.31.17.14/255',
		'15.200.124.53/255',
		'77.26.189.183/32'
	],
	'user'    => 'NetworkAuthUser',
];

// VisualEditor
if ( !isset( $_SERVER['REMOTE_ADDR'] ) OR $_SERVER['REMOTE_ADDR'] == '127.0.0.1' OR $_SERVER['REMOTE_ADDR'] == '160.1.51.120') {
	$wgGroupPermissions['*']['read'] = true;
	$wgGroupPermissions['*']['edit'] = true;
}

$PARSOID_INSTALL_DIR = 'extensions/Parsoid';

if ( $PARSOID_INSTALL_DIR !== 'vendor/wikimedia/parsoid' ) {
    AutoLoader::$psr4Namespaces += [
        // Keep this in sync with the "autoload" clause in
        // $PARSOID_INSTALL_DIR/composer.json
        'Wikimedia\\Parsoid\\' => "$PARSOID_INSTALL_DIR/src",
    ];
}

wfLoadExtension( 'Parsoid', "$PARSOID_INSTALL_DIR/extension.json" );
wfLoadExtension( 'VisualEditor' );

# Manually configure Parsoid
$wgVisualEditorParsoidAutoConfig = false;
# $wgVisualEditorParsoidURL = 'http://127.0.0.1:8000';
$wgParsoidSettings = [
    'useSelser' => true,
    'rtTestMode' => false,
    'linting' => false,
];
$wgVirtualRestConfig['modules']['parsoid']['forwardCookies'] = true;
