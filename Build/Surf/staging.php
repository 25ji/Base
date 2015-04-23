<?php

use \TYPO3\Surf\Domain\Model\Node;
use \TYPO3\Surf\Domain\Model\SimpleWorkflow;
use \TYPO3\Surf\Application\TYPO3\Flow;

$node = new Node('development.25-jahre-internet.de (78.47.156.213)');
$node->setHostname('78.47.156.213');
$node->setOption('username', 'root');

$application = new Flow();
$application->setVersion('3.0');
$application->addNode($node);
$application->setOption('repositoryUrl', 'git@github.com:25ji/Base.git');
$application->setDeploymentPath('/var/www/development.25-jahre-internet.de');
$application->setOption('keepReleases', 10);
$application->setContext('Production');
$application->setOption('packageMethod', 'git');
$application->setOption('transferMethod', 'rsync');
$application->setOption('updateMethod', NULL);

if (file_exists('/opt/local/bin/composer')) {
	$application->setOption('composerCommandPath', '/opt/local/bin/composer');
} else {
	// this is just a guess...
	$application->setOption('composerCommandPath', 'composer');
}

$workflow = new SimpleWorkflow();
$workflow->setEnableRollback(FALSE);

/** @var \TYPO3\Surf\Domain\Model\Deployment $deployment */
$deployment->addApplication($application);
$deployment->setWorkflow($workflow);

$deployment->onInitialize(function() use ($workflow, $application) {
//	$workflow->removeTask('typo3.surf:typo3:flow:copyconfiguration');
});
