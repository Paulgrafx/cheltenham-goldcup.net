<?xml version="1.0"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:output method="html"/>

	<xsl:template match="/">
		<xsl:apply-templates select="event"/>
	</xsl:template>

	<xsl:template match="event">
		<table cellpadding="0" cellspacing="0" border="0" id="oddsTable">
			<tr>
				<th>
					<xsl:text disable-output-escaping="yes">&amp;nbsp;</xsl:text>
				</th>
				<xsl:for-each select="bookmakers/bookie">
					<th>
						<a>
							<xsl:attribute name="href">
								<xsl:value-of select="@link"/>
							</xsl:attribute>
							<img>
								<xsl:attribute name="src">
									<xsl:value-of select="@img"/>
								</xsl:attribute>
								<xsl:attribute name="alt">
									<xsl:value-of select="@name"/>
								</xsl:attribute>
							</img>
						</a>
					</th>
				</xsl:for-each>
			</tr>
			<xsl:for-each select="odds/selection">
				<tr>
					<xsl:for-each select="@*">
						<xsl:variable name="pos" select="position() - 1"/>
						<xsl:if test="$pos = '0'">
							<td class="selection"><xsl:value-of select="."/></td>
						</xsl:if>
						<xsl:if test="not($pos = '0')">
						<td>
							<xsl:if test="not(.='')">
							<a>
								<xsl:attribute name="href">
									<xsl:text>/out.php?url=</xsl:text>
									<xsl:value-of select="substring-after(//event/bookmakers/bookie[$pos]/@link, '=')"/>
								</xsl:attribute>
								<xsl:attribute name="target"><xsl:text>_new</xsl:text></xsl:attribute>
								<xsl:value-of select="."/>
							</a>
							</xsl:if>
							<xsl:if test=".=''">
								<xsl:text>-</xsl:text>
							</xsl:if>
						</td>
						</xsl:if>
					</xsl:for-each>
				</tr>
				
			</xsl:for-each>
		</table>
	</xsl:template>
</xsl:stylesheet>