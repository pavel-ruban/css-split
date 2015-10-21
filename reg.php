#!/usr/bin/php
<?php

if (empty($argv[1]))
{
	echo <<<EOF
	usage: cpycss input_filename\n
	help: gets data from input file & place it to separate file
EOF;

	exit(1);
}

$input = $argv[1];
$output = "$input.matched";
$clean_output = "$input.cleaned";

$pattern = "/@media(?!\s*print)[^{]*?\{[^{]*?([^{}]*?\{[^{}]*?\}[^{}]*?)*[^}]*?\}/m";
$matches = array();

$filedata = file_get_contents($input);
preg_match_all($pattern, $filedata, $matches);
$txt = '';

var_dump($matches[0]);
foreach ($matches[0] as $match)
{
	$txt .= $match . "\n\n";
}

echo <<<EOF
	saving file $output ...\n\r
EOF;

file_put_contents($output, $txt);
echo <<<EOF
	done!\n\r
EOF;

echo <<<EOF
	saving file $clean_output ...\n\r
EOF;

$txt = preg_replace($pattern, '', $filedata);
file_put_contents($clean_output, $txt);
echo <<<EOF
	done!\n\r
EOF;

//var_dump($matches);
//var_dump($txt);

