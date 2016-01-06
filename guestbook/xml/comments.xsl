<?xml version="1.0" encoding="ISO-8859-1"?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/">
  <html>
  <body>
    <h2>comments</h2>
    <table border="1">
    <tr bgcolor="#9acd32">
      <th align="left">email</th>
      <th align="left">name</th>
      <th align="left">message</th>
    </tr>
    <xsl:for-each select="xml/comment">
    <tr>
      <td><xsl:value-of select="email"/></td>
      <td><xsl:value-of select="name"/></td>
      <td><xsl:value-of select="message"/></td>
    </tr>
    </xsl:for-each>
    </table>
  </body>
  </html>
</xsl:template>

</xsl:stylesheet>