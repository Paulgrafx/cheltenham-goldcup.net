<?xml version="1.0"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:output method="html" encoding="ISO-8859-1" indent="no" />
	<xsl:variable name="lcase" select="'abcdefghijklmnopqrstuvwxyz'" />
	<xsl:variable name="ucase" select="'ABCDEFGHIJKLMNOPQRSTUVWXYZ '" />
	<xsl:variable name="Q">'</xsl:variable>

	<xsl:template match="/">
		<xsl:apply-templates select="Race"/>
	</xsl:template>

	<xsl:template match="Race">
    	<table class="rows" style="border:1px solid #1b341f;">
				<thead>
					<tr>
						<th id="no">No.</th>
						<th id="runner">Runner</th>
						<th id="details">Details</th>
						<th id="rating">Rating</th>
						<th id="odds">Odds</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td headers="no">1<br /><img class="img-responsive" src="http://racing.betting-directory.com/images/silks/130349.gif"></td>
						<td headers="runner"><strong>Bobs Worth (IRE)</strong><br />
B J Geraghty<br />
N Henderson</td>
						<td headers="details">10 yrs / 164 lbs
/615-8</td>
						<td headers="rating">166</td>
						<td headers="odds"><a href="#">Odds SP</a></td>
					</tr>
                    <tr class="hidden-sm-down">
                    	<td colspan="5" class="column-full-width">
                        
                        <p><strong>COMMENT</strong> Bobs Worth
Won this in 2013 but doesn't seem as good nowadays</p>
                        
                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample1">Show Form</button>
                
                    <div class="collapse col=sm-12" id="collapseExample1">
                          <div class="cards card-blocks">
                            <div class="formbox" id="f764650">
                                                <table cellpadding="0" cellspacing="0" border="0" width="100%" class="runnerform">
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Race Conditions</th>
                                                        <th>Weight</th>
                                                        <th>Jockey</th>
                                                        <th>Race Outcome</th>
                                                    </tr>
                                                    <tr class="alt">
                                                        <td class="dt">24/01/15</td>
                                                        <td class="cond">CHL 25Sft Cl1 G2Ch,57K</td>
                                                        <td class="weight">156 lbs</td>
                                                        <td class="jockey">Wayne Hutchinson</td>
                                                        <td class="outcome">2/6 1 1/4l, Many Clouds[11/4]11-10</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="dt">29/11/14</td>
                                                        <td class="cond">NBY 26Sft Cl1 G3ChHc,100K</td>
                                                        <td class="weight">164 lbs</td>
                                                        <td class="jockey">Denis O'Regan</td>
                                                        <td class="outcome">5/19 20l, Many Clouds[6/1]11-6</td>
                                                    </tr>
                                                    <tr class="alt">
                                                        <td class="dt">12/03/14</td>
                                                        <td class="cond">CHL 24Gd Cl1 G1Ch,85K</td>
                                                        <td class="weight">158 lbs</td>
                                                        <td class="jockey">Robert Thornton</td>
                                                        <td class="outcome">2/15 1/4l, O'Faolains Boy[13/2J]11-4</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="dt">08/02/14</td>
                                                        <td class="cond">NBY 24Hy Cl3 NvCh,8K</td>
                                                        <td class="weight">159 lbs</td>
                                                        <td class="jockey">Robert Thornton</td>
                                                        <td class="outcome">1/4 2l, Sam Winner[9/4]11-8</td>
                                                    </tr>
                                                    <tr class="alt">
                                                        <td class="dt">13/11/13</td>
                                                        <td class="cond">EXE 24GS Cl3 NvCh,6K</td>
                                                        <td class="weight">157 lbs</td>
                                                        <td class="jockey">Robert Thornton</td>
                                                        <td class="outcome">1/6 7l, Ardkilly Witness[4/11F]11-3</td>
                                                    </tr>
                                                </table>
		<div id="raceinfo">
			<div class="card">
				<xsl:for-each select="Runner[not(@nonrunner)]">
					<table cellpadding="0" cellspacing="0" border="0" width="100%" class="racecard">
					<xsl:if test="position() = 1">
						<tr><th colspan="2">No.</th><th>Runner</th><th>Details</th><th>Rating</th><th>Odds</th></tr>
					</xsl:if>
					<tr>
						<td class="num"><xsl:value-of select="@saddle" /><!--<br /><small>(<xsl:value-of select="@draw" />)</small>--></td>
						<td class="silk"><img>
							<xsl:attribute name="src"><xsl:text>http://racing.betting-directory.com/images/silks/</xsl:text><xsl:value-of select="@silkname" /></xsl:attribute>
							<xsl:attribute name="alt"><xsl:value-of select="@horsename" /></xsl:attribute>
						</img></td>
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
					<xsl:if test="Details/DiomedComment">
						<div class="spotlight"><img src="/images/racecard-arrow.gif" alt=" " class="racecard-arrow" /><p><span class="verdictbox">Comment</span><strong><xsl:value-of select="@horsename" /></strong></p><p><xsl:value-of select="Details/DiomedComment" /></p></div>
					</xsl:if>
					<xsl:if test="Recentform/Form">
						<div class="formbox">
							<xsl:attribute name="id">f<xsl:value-of select="@horseid" /></xsl:attribute>
							<table cellpadding="0" cellspacing="0" border="0" width="100%" class="runnerform">
							<tr><th>Date</th><th>Race Conditions</th><th>Weight</th><th>Jockey</th><th>Race Outcome</th></tr>
							<xsl:for-each select="Recentform/Form">
							<tr>
								<xsl:if test="position() mod 2 = 1">
									<xsl:attribute name="class">alt</xsl:attribute>
								</xsl:if>
								<td class="dt"><xsl:value-of select="substring(@date,9,2)" />/<xsl:value-of select="substring(@date,6,2)" />/<xsl:value-of select="substring(@date,3,2)" /></td>
								<td class="cond"><xsl:value-of select="@conditions" /></td>
								<td class="weight"><xsl:value-of select="@weight_lbs" /> lbs</td>
								<td class="jockey"><xsl:value-of select="@jockey" /></td>
								<td class="outcome"><xsl:value-of select="@race_outcome" /></td>
							</tr>
							</xsl:for-each>
							</table>
						</div>
						<div class="viewhidebox">
							<div class="viewhideform">
								<div class="viewhidebtn"><a href="javascript:;" class="showform"><xsl:attribute name="rel">f<xsl:value-of select="@horseid" /></xsl:attribute><xsl:text>Show Form</xsl:text></a></div>
								<div class="viewhidepromo"><p>&amp;nbsp;</p></div>
								<div class="clear"></div>
							</div>
						</div>
					</xsl:if>
					<!--<xsl:if test="not(Details/Recentform/Form)">
						<div class="viewhidebox">
							<div class="viewhideform">
								<div class="viewhidepromo"><p><a href="javascript:;">View Odds Comparison Table</a></p></div>
								<div class="clear"></div>
							</div>
						</div>
					</xsl:if>-->
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
	</xsl:template>
</xsl:stylesheet>