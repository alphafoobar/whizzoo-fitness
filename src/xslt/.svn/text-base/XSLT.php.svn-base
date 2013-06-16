<?php
/**
 * xslt/XSLT.php
 * [utility]
 * 
 * Provides an engine to render text from an XML file using XSL.
 * 
 * Created 12/03/2009
 * Copyright © 2009 James Little
 * $Id: Location.php 32 2009-03-12 02:07:49Z alphafoobar $
 */
$proc = new XSLTProcessor();

if (!$proc->hasExsltSupport()) 
{
   die('EXSLT support not available');
} 
// Load the XML source
$xml = new DOMDocument;
$xml->load('test.xml');

$xsl = new DOMDocument;
$xsl->load('build_weather_json.xsl');

// Configure the transformer
$proc->importStyleSheet($xsl); // attach the xsl rules

if(isset($_GET["callback"])) echo $_GET["callback"]."(";
echo $proc->transformToDoc($xml)->firstChild->wholeText;
if(isset($_GET["callback"])) echo ")";
?>
