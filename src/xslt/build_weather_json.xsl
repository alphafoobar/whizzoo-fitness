<?xml version="1.0"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<!--
  - This script can be used to extract the desired weather data from the
  - archived Weather station XML files. We may use this to deliver a JSON
  - Web service.
  -
  -
  - Author: James Little
  - Version: $Id: build_weather_json.xsl 33 2009-03-12 04:34:24Z alphafoobar $
  -->
	<xsl:output method = "text" encoding="utf-8" />
	
	
	<xsl:template match="/current_observation">
		{
			"location":{<xsl:apply-templates select = "*" />}
		}
	</xsl:template>
	
	<xsl:template match="location">
		<xsl:apply-templates select="full" />
	</xsl:template>
	
	<xsl:template match="full">
		"name": "<xsl:value-of select="."/>",
	</xsl:template>
	
	<xsl:template match="@*|node()"/>
	
	
</xsl:stylesheet>