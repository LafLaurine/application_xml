<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/cv">

<html>
<head>
<title><xsl:value-of select="./info_entreprise/nom"/></title>
<link rel="stylesheet" type="text/css" href="../css/cv.css" />
</head>
	<body>
	<div id="container">
		<h1 style="text-align:center;"><xsl:value-of select="poste"/><xsl:value-of select="poste/@typeContrat"/></h1>
		
		<div id="me">
		 <xsl:for-each select="./info_entreprise">
		 <h1><xsl:value-of select="./nom"/></h1>
		 <h1><xsl:value-of select="./adresse/ville"/>, <xsl:value-of select="./adresse/ville/@codePostal"/></h1>
		 <h2><xsl:value-of select="./description"/>
		 </xsl:for-each>
		 </div>
		 
		 <div id="content">		 
		 
		<h2>Compétences</h2>
		
		<table summary="compet">
		
		 <xsl:for-each select="./profil_recherche/competence">

			<xsl:for-each select="./profil_recherche/competence">
			 <tr bgcolor="grey">
			  <td><xsl:value-of select="@typeCompet"/></td>
			  <td><xsl:value-of select="current()"/></td>
			</tr>
			</xsl:for-each>
		</xsl:for-each>

		</table>

		
		 <div id="sxscontainer">
		 
		 <div id="employment">
			<h2>Missions</h2>
			<xsl:call-template name="showEmployment"/>
		</div>
		
		<div class="page-break"/>

		<div id="references">
		
		<h2>Activités</h2>
		
		<xsl:call-template name="showReferences"/>

		</div>
		</div>

	</div>
	</div>

	</body>
</html>

</xsl:template>

<xsl:template name="useThisElseThat">
		<xsl:param name="this"/>
		<xsl:param name="that"/>
		<xsl:choose>
			<xsl:when test="$this!=''">
				<xsl:value-of select="$this"/>
			</xsl:when>
			<xsl:otherwise>
				<xsl:value-of select="$that"/>
			</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
	<!-- showDateRange: standardise the way date ranges are shown across the document -->
	<xsl:template name="showDateRange">
		<xsl:param name="fromDate"/>
		<xsl:param name="toDate"/>
		<xsl:param name="noToDate"/>
		(<xsl:value-of select="$fromDate"/> - 
		<xsl:call-template name="useThisElseThat">
			<xsl:with-param name="this" select="$toDate"/>
			<xsl:with-param name="that" select="$noToDate"/>
		</xsl:call-template>)
</xsl:template>

<xsl:template name="showEmployment">
				 <xsl:for-each select="./profil_recherche/mission">

			<xsl:for-each select="./profil_recherche/mission">
			<p class="jobdescription"><xsl:value-of select="mission"/></p>
		</xsl:for-each>
		</xsl:for-each>
</xsl:template>

<xsl:template name="showReferences">
		<xsl:choose>
			<xsl:when test="not(//cv/contact)"><p>Aucun contact</p></xsl:when>
			<xsl:otherwise>
				<xsl:for-each select="//cv/contact">
					<div class="contact">
						<h3><xsl:value-of select="."/></h3>
						<ul>
							<li><xsl:value-of select="nomContact"/></li>
							<li><xsl:value-of select="email"/></li>
							<li><xsl:value-of select="telephone"/></li>
						</ul>
					</div>
				</xsl:for-each>
			</xsl:otherwise>
</xsl:choose>

<xsl:template name="text" match="text()">
		<xsl:param name="text" select="."/>
		<xsl:choose>
			<xsl:when test="contains($text, '&#xA;')">
				<xsl:value-of select="substring-before($text, '&#xA;')"/>
				<br/>
				<xsl:call-template name="text">
					<xsl:with-param name="text" select="substring-after($text,'&#xA;')"/>
				</xsl:call-template>
			</xsl:when>
			<xsl:otherwise>
				<xsl:value-of select="$text"/>
			</xsl:otherwise>
		</xsl:choose>
</xsl:template>

</xsl:stylesheet>