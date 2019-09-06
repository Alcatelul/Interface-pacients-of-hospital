<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">
<html> 
<body>
  <h2>Tabel medici</h2>
  <table border="1">
    <tr bgcolor="#9acd32">
      <th style="text-align:left">Nume</th>
      <th style="text-align:left">Prenume</th>
      <th style="text-align:left">Data nasterii</th>
      <th style="text-align:left">Telefon</th>
      <th style="text-align:left">Program lucru</th>
    </tr>
    <xsl:for-each select="spital/sectie/doctor">
    <tr>
      <td><xsl:value-of select="nume_doctor"/></td>
      <td><xsl:value-of select="prenume_doctor"/></td>
      <td><xsl:value-of select="data_nasterii_doctor"/></td>
      <td><xsl:value-of select="telefon_doctor"/></td>
      <td><xsl:value-of select="program_lucru"/></td>
    </tr>
    </xsl:for-each>
  </table>
  <h2>Tabel pacienti</h2>
  <table border="1">
    <tr bgcolor="#9acd32">
      <th style="text-align:left">Nume</th>
      <th style="text-align:left">Prenume</th>
      <th style="text-align:left">Data nasterii</th>
      <th style="text-align:left">Sex</th>
      <th style="text-align:left">Telefon</th>
      <th style="text-align:left">Data inscrierii</th>
    </tr>
    <xsl:for-each select="spital/sectie/doctor/lista_pacienti/pacient">
    <tr>
      <td><xsl:value-of select="nume_pacient"/></td>
      <td><xsl:value-of select="prenume_pacient"/></td>
      <td><xsl:value-of select="data_nasterii_pacient"/></td>
      <td><xsl:value-of select="sex_pacient"/></td>
      <td><xsl:value-of select="telefon_pacient"/></td>
      <td><xsl:value-of select="data_inscrierii"/></td>
    </tr>
    </xsl:for-each>
  </table>
</body>
</html>
</xsl:template>
</xsl:stylesheet>
