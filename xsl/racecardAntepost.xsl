<?xml version="1.0"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:output method="html" encoding="ISO-8859-1" indent="no" />
	<xsl:variable name="lcase" select="'abcdefghijklmnopqrstuvwxyz'" />
	<xsl:variable name="ucase" select="'ABCDEFGHIJKLMNOPQRSTUVWXYZ '" />
	<xsl:variable name="Q">'</xsl:variable>

	<xsl:template match="/">
		<xsl:apply-templates select="Meeting"/>
	</xsl:template>

	<xsl:template match="Meeting">
		<xsl:for-each select="Race">
		<div id="raceinfo">
			<div class="card">
				<xsl:for-each select="Runner[not(@nonrunner)]">
					<table cellpadding="0" cellspacing="0" border="0" width="100%" class="racecard">
					<xsl:if test="position() = 1">
						<tr><th colspan="2">No.</th><th>Runner</th><th>Details</th><th>Rating</th><th>Odds</th></tr>
					</xsl:if>
					<tr>
						<td class="num"><xsl:value-of select="@saddle" /><!--<br /><small>(<xsl:value-of select="@draw" />)</small>--></td>
						<td class="silk"><img src="http://racing.betting-directory.com/images/silks/{@silkname}" alt="{@horsename}" /></td>
						<td class="runner"><strong><xsl:value-of select="@horsename" /></strong>
						<xsl:if test="not(@horsesuffix = 'GB')"><xsl:text> (</xsl:text><xsl:value-of select="@horsesuffix" />)</xsl:if>
						<br /><xsl:value-of select="@jockey" /><br /><i><xsl:value-of select="@trainer" /></i></td>
						<td class="details"><xsl:value-of select="@horse_age" /><xsl:text> yrs / </xsl:text><xsl:value-of select="@weight_lbs" /><xsl:text> lbs</xsl:text>
							<xsl:if test="@formfigs"><br /><strong><xsl:value-of select="@formfigs" /></strong></xsl:if>
						</td>
						<xsl:if test="@official_rating"><td class="rating"><span class="rating"><xsl:value-of select="@official_rating" /></span></td></xsl:if>
						<xsl:if test="not(@official_rating)"><td class="rating"><span class="rating">-</span></td></xsl:if>
						<td class="odds"><a href="/out.php?url=12" target="_new" class="oddsBtn"><xsl:attribute name="id">o_<xsl:value-of select="translate(translate(@horsename, $Q, ''), $ucase, $lcase)" /></xsl:attribute></a></td>
					</tr>
					</table>
				</xsl:for-each>
				<xsl:variable name="nonRunnerCnt" select="count(Runner[@nonrunner])" />
				<xsl:if test="$nonRunnerCnt &gt; 0">
					<div class="nonRunners"><p><strong>
					<xsl:value-of select="$nonRunnerCnt" /> Non Runners<xsl:text>: </xsl:text></strong>
					<xsl:for-each select="Runner[@nonrunner]">
						<xsl:sort select="@horsename" data-type="text" order="ascending" />
						<xsl:value-of select="@horsename" />
						<xsl:if test="not(position() = last())"><xsl:text>, </xsl:text></xsl:if>
					</xsl:for-each>
					</p></div>
				</xsl:if>
			</div>
		</div>
		<div class="clear"></div>
		</xsl:for-each>
	</xsl:template>
</xsl:stylesheet>