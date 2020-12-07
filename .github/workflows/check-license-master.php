<?php
// Stuff we will ignore.
$ignoreFiles = array(
	'\.github/',
	'\.buildTools/',
);

$curDir = '.';
if (isset($_SERVER['argv'], $_SERVER['argv'][1]))
	$curDir = $_SERVER['argv'][1];

$foundBad = false;
foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($curDir, FilesystemIterator::UNIX_PATHS)) as $currentFile => $fileInfo)
{
	// Only check PHP
	if ($fileInfo->getExtension() !== 'php')
		continue;

	foreach ($ignoreFiles as $if)
		if (preg_match('~' . $if . '~i', $currentFile))
			continue 2;

	$result = trim(shell_exec('php buildTools/check-license.php ' . $currentFile));

	if (!preg_match('~Error:([^$]+)~', $result))
		continue;

	$foundBad = true;
	fwrite(STDERR, $result);
}

fwrite(STDERR, 'Found Bad:' . $foundBad ? '1' : '0');
exit(1);
exit($foundBad ? 1 : 0);