<?php
// Stuff we will ignore.
$ignoreFiles = array(
	'\./cache/',
	'\./other/',
	'\./tests/',
	'\./vendor/',

	// Minify Stuff.
	'\./Sources/minify/',

	// random_compat().
	'\./Sources/random_compat/',

	// ReCaptcha Stuff.
	'\./Sources/ReCaptcha/',

	// We will ignore Settings.php if this is a live dev site.
	'\./Settings\.php',
	'\./Settings_bak\.php',
	'\./db_last_error\.php',
);

$foundBad = false;
foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator('.', FilesystemIterator::UNIX_PATHS)) as $currentFile => $fileInfo)
{
	// Only check PHP
	if ($fileInfo->getExtension() !== 'php')
		continue;

	foreach ($ignoreFiles as $if)
		if (preg_match('~' . $if . '~i', $currentFile))
			continue 2;

	$result = trim(shell_exec('php -l ' . $currentFile));

	if (preg_match('~No syntax errors detected in ' . $currentFile . '~', $result))
		continue;

	$foundBad = true;
	fwrite(STDERR, $result);
}

exit($foundBad ? 1 : 0);