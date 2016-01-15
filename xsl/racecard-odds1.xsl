<?xml version="1.0"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:output method="html" encoding="ISO-8859-1" indent="no" />
	<xsl:variable name="lcase" select="'abcdefghijklmnopqrstuvwxyz'" />
	<xsl:variable name="ucase" select="'ABCDEFGHIJKLMNOPQRSTUVWXYZ '" />
	<xsl:variable name="Q">'</xsl:variable>

	<xsl:template match="/">
		<xsl:apply-templates select="event"/>
	</xsl:template>

	<xsl:template match="event">
		<xsl:text>var raceOdds = {</xsl:text>
		<xsl:for-each select="odds/selection[not(@odds0 = '')]">
			<xsl:text>'o_</xsl:text><xsl:value-of select="translate(translate(@name, $Q, ''), $ucase, $lcase)" /><xsl:text>':'</xsl:text>
			<xsl:if test="floor(@odds0) = @odds0"><xsl:value-of select="@odds0" /><xsl:text>/1</xsl:text></xsl:if>
			<xsl:if test="not(floor(@odds0) = @odds0)"><xsl:value-of select="@odds0" /></xsl:if>
			<xsl:text>', </xsl:text>
		</xsl:for-each>
	</xsl:template>
</xsl:stylesheet>