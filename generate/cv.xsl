<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/cv">

<html>
<head>
<title><xsl:value-of select="./informations_personnelles/nom"/></title>
<link rel="stylesheet" type="text/css" href="../css/cv.css" />
</head>
	<body>
	<div id="container">
		<h1 style="text-align:center;"><xsl:value-of select="poste"/></h1>
		
		<div id="me">
		 <xsl:for-each select="./informations_personnelles">
		 <h1><xsl:value-of select="./nom"/></h1>
		 <h1><xsl:value-of select="./prenom"/></h1>
		 <h2><xsl:value-of select="./date_naiss"/></h2>
		 </xsl:for-each>
		 </div>
		 
		 <div id="content">		 
		 
		<h2>Compétences</h2>
		
		<table summary="compet">
		
		 <xsl:for-each select="./competences">

			<xsl:for-each select="./competence">
			 <tr bgcolor="grey">
			  <td><xsl:value-of select="@typeCompet"/></td>
			  <td><xsl:value-of select="current()"/></td>
			  <td><xsl:value-of select="@niveau"/></td>
			</tr>
			</xsl:for-each>
		</xsl:for-each>

		</table>

		
		 <div id="sxscontainer">
		 
		 <div id="education">
		 <h2>Formations</h2>
		 <xsl:call-template name="showEducation"/>
		 </div>

		 <div id="employment">
			<h2>Expériences</h2>
			<xsl:call-template name="showEmployment"/>
		</div>
		
		<div class="page-break"/>

		<div id="hobbiesandinterests">
		<h2>Langues</h2>
		
		<table summary="langues">
		
		 <xsl:for-each select="./langues">

			<xsl:for-each select="./langue">
			 <tr bgcolor="grey">
			  <td><xsl:value-of select="current()"/></td>
			  <td><xsl:value-of select="@niveau"/></td>
			</tr>
			</xsl:for-each>
		</xsl:for-each>

		</table>
		</div>
		<div id="references">
		
		<h2>Activités</h2>
		
		<div class="contact">
		<xsl:for-each select="//centre_interets/activite">
		<h3><xsl:value-of select="current()"/></h3>
		</xsl:for-each>
		</div>

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

<xsl:template name="showEducation">
		 <xsl:for-each select=".//formations">
		 <xsl:for-each select="./formation">
		<h3 class="qualtype"><xsl:value-of select="./etablissement"/>, à <xsl:value-of select="./etablissement/@ville"/> </h3>
		<xsl:value-of select="./diplome/@periode"/>, <xsl:value-of select="./diplome"/>
		</xsl:for-each>
		</xsl:for-each>
</xsl:template>

<xsl:template name="showEmployment">
				 <xsl:for-each select="./experiences">

			<xsl:for-each select="./experience">
			<h3 class="jobtitle">
				<strong><xsl:value-of select="titre"/></strong>, <xsl:value-of select="@periode"/>
			</h3>
			<p class="jobdescription"><xsl:value-of select="mission"/></p>
			<ul class="jobachievementlist">
			<li class="jobachievementitem"><xsl:value-of select="entreprise"/></li>
			</ul>
		</xsl:for-each>
		</xsl:for-each>
</xsl:template>

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