<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.0 Transitional//EN'>
<HTML>
<HEAD>
<TITLE>TITULO BOLETO</TITLE>
<META http-equiv=Content-Type content=text/html charset=ISO-8859-1>
<meta name="Generator" content="Projeto BoletoPHP - www.boletophp.com.br - Licença GPL" />
</head>

<BODY text=#000000 bgColor=#ffffff topMargin=0 rightMargin=0><table width="540" border="1" cellpadding="2" cellspacing="0">
  <tr>
    <td colspan="4"><font size="10">Administra&ccedil;&atilde;o Transparente - Cobran&ccedil;a Banc&aacute;ria </font></td>
    <td colspan="3"  valign="middle"><strong><font size="10">Recibo do Pagador</font></strong></td>
  </tr>
  <tr><td width="307" colspan="5" ><font size="7">Benefici&aacute;rio / Condom&iacute;nio</font><br><font size="9"><?= h($dadosboleto["cedente"]) ?></font></td><td width="95" ><font size="7">CNPJ/CPF: </font><br><font size="9"><?= h($dadosboleto["cpf_cnpj"]) ?></font></td>
    <td width="138" ><font size="7">Ag&ecirc;ncia/C&oacute;digo do Cedente</font><br><font size="9"><?= h($dadosboleto["agencia_codigo"]) ?></font></td></tr>
  <tr>
    <td colspan="5" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><font size="7">Endere&ccedil;o do Benefici&aacute;rio</font></td>
      </tr>
      <tr>
        <td><font size="9"><?= h($dadosboleto["endereco"]." / ".$dadosboleto["cidade"]) ?></font></td>
      </tr>
    </table></td>
    <td ><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><font size="7">UF</font></td>
      </tr>
      <tr>
        <td><font size="9"><?= h($dadosboleto["uf"]) ?></font></td>
      </tr>
    </table></td>
    <td ><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><font size="10">CEP</font></td>
      </tr>
      <tr>
        <td><font size="9"><?= h($dadosboleto["cep"]) ?></font></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td width="100" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><font size="7">Data do Documento </font></td>
      </tr><tr>
        <td><font size="9"><?= h($dadosboleto["data_documento"]) ?></font></td>
    </tr></table>    </td>
    <td width="100" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><font size="7">Num. do Documento </font></td>
      </tr>
      <tr>
        <td><font size="9"><?= h($dadosboleto["numero_documento"]) ?></font></td>
      </tr>
    </table>    </td>
    <td width="63" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><font size="7">Esp&eacute;cie Moeda </font></td>
      </tr>
      <tr>
        <td><font size="9"><?= h($dadosboleto["especie"]) ?></font></td>
      </tr>
    </table>    </td>
    <td width="44" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><font size="7">Carteira</font></td>
      </tr>
      <tr>
        <td><font size="9"><?= h($dadosboleto["carteira"]) ?></font></td>
      </tr>
    </table></td>
    <td width="95" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><font size="7">Data do Processamento </font></td>
      </tr>
      <tr>
        <td><font size="9"><?= h($dadosboleto["data_processamento"]) ?></font></td>
      </tr>
    </table></td>
    <td width="138" colspan="2" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><font size="7">Nosso N&uacute;mero </font></td>
      </tr>
      <tr>
        <td><font size="9"><?= h($dadosboleto["nosso_numero"]) ?></font></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="5" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><font size="7">Pagador</font></td>
      </tr>
      <tr>
        <td><font size="9"><?= h($dadosboleto["pagador"]) ?></font></td>
      </tr>
    </table></td>
    <td colspan="2" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><font size="7">CPF / CNPJ </font></td>
      </tr>
      <tr>
        <td><font size="9"><?= h($dadosboleto["pagador_cpf"]) ?></font></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="5" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><font size="7">Endere&ccedil;o do Pagador </font></td>
      </tr>
      <tr>
        <td><font size="9"><?= h($dadosboleto["pagador_endereço"]) ?></font></td>
      </tr>
    </table></td>
    <td ><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><font size="7">UF</font></td>
      </tr>
      <tr>
        <td><font size="9"><?= h($dadosboleto["pagador_uf"]) ?></font></td>
      </tr>
    </table></td>
    <td ><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><font size="7">CEP</font></td>
      </tr>
      <tr>
        <td><font size="9"><?= h($dadosboleto["pagador_cep"]) ?></font></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="5" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><font size="7">Pagador / Avalista </font></td>
      </tr>
      <tr>
        <td><font size="9">&nbsp;</font></td>
      </tr>
    </table></td>
    <td colspan="2" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><font size="7">CPF / CNPJ </font></td>
      </tr>
      <tr>
        <td><font size="9">&nbsp;</font></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="7" ><font size="9">TEXTO DE RESPONSABILIDADE DO CEDENTE:<br />
      PROTESTAR COM 30 DIAS<br />
      JUROS: ??? REAIS AO DIA<br />
      MULTA: ????REAIS A PARTIR DE 06/06/2016<br />
    TAXA CONDOMINIO ??? 06/2016</font></td>
  </tr>
</table>
<table width="532" border="1" cellspacing="0" cellpadding="1">
  <tr>
    <td width="39"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><font size="7">Moeda</font></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>
    <td width="48"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><font size="7">Quantidade</font></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>
    <td width="90"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><font size="7">Valor</font></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>
    <td width="100"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><font size="7">Vencimento</font></td>
      </tr>
      <tr>
        <td><font size="9"><?= h($dadosboleto["data_vencimento"]) ?></font></td>
      </tr>
    </table></td>
    <td width="110"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><font size="7">Valor do documento</font></td>
      </tr>
      <tr>
        <td><font size="9">R$ <?= h($dadosboleto["data_vencimento"]) ?></font></td>
      </tr>
    </table></td>
    <td width="153"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><font size="7">Autentica&ccedil;&atilde;o Mec&atilde;nica - Recibo do Sacado</font></td>
      </tr>
      <tr>
        <td><font size="9">&nbsp;</font></td>
      </tr>
    </table></td>
  </tr>
</table>
<br />- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -<br />
<table width="540" border="1" cellspacing="0" cellpadding="1">
  <tr>
    <td width="100"><img src="../plugins/boletophp/imagens/logocaixa.jpg" width="150" height="40" /></td>
    <td width="50" valign="middle" ><font size="18"><?= h($dadosboleto["codigo_banco_com_dv"]) ?></font> </td>
    <td width="390" align="rigth"   valign="middle" ><table width="100%" border="0" cellspacing="7" cellpadding="0">
      <tr>
        <td><font ><?= h($dadosboleto["linha_digitavel"]) ?></font></td>
      </tr>
    </table></td>
  </tr>
</table>

<table width="540" border="1" cellspacing="0" cellpadding="1">
  <tr>
    <td width="420" colspan="6"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td ><font size="7">Local de Pagamento </font></td>
      </tr>
      <tr>
        <td><font size="10">PREFERENCIALMENTO NAS CASA LOTERIAS AT&Eacute; O VALOR LIMITE </font></td>
      </tr>
    </table></td>
    <td width="120"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><font size="7">Vencimento</font></td>
      </tr>
      <tr>
        <td><font size="10"><?= h($dadosboleto["data_vencimento"]) ?></font></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td width="320" colspan="5"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><font size="7">Benefici&aacute;rio / Condom&iacute;nio</font></td>
      </tr>
      <tr>
        <td><font size="10"><?= h($dadosboleto["cedente"]) ?></font></td>
      </tr>
    </table></td>
    <td width="100"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td ><font size="7">CNPJ/CPF: </font></td>
      </tr>
      <tr>
        <td><font size="10"><?= h($dadosboleto["cpf_cnpj"]) ?></font></td>
      </tr>
    </table></td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><font size="7">Ag&ecirc;ncia/C&oacute;digo do Cedente</font></td>
      </tr>
      <tr>
        <td><font size="10"><?= h($dadosboleto["agencia"]." / ".$dadosboleto["conta_cedente"]) ?></font></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td width="115" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><font size="7">Data do Documento </font></td>
      </tr>
      <tr>
        <td><font size="10"><?= h($dadosboleto["data_documento"]) ?></font></td>
      </tr>
    </table></td>
    <td width="115" colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><font size="7">Num. do Documento </font></td>
      </tr>
      <tr>
        <td><font size="10"><?= h($dadosboleto["numero_documento"] ) ?></font></td>
      </tr>
    </table></td>
    <td width="45"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td ><font size="7">Esp&eacute;cie  </font></td>
      </tr>
      <tr>
        <td><font size="10"><?= h($dadosboleto["especie_doc"]) ?></font></td>
      </tr>
    </table></td>
    <td width="45"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><font size="7">Aceite</font></td>
      </tr>
      <tr>
        <td><font size="10"><?= h($dadosboleto["aceite"]) ?></font></td>
      </tr>
    </table></td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><font size="7">Data do Processamento </font></td>
      </tr>
      <tr>
        <td><font size="10"><?= h($dadosboleto["data_processamento"] ) ?></font></td>
      </tr>
    </table></td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><font size="7">Nosso N&uacute;mero </font></td>
      </tr>
      <tr>
        <td><font size="10"><?= h($dadosboleto["nosso_numero"]) ?></font></td>
      </tr>
    </table></td>
  </tr>

 <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><font size="7">Uso do banco </font></td>
      </tr>
      <tr>
        <td><font size="10"> </font></td>
      </tr>
    </table></td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><font size="7">Carteira </font></td>
      </tr>
      <tr>
        <td><font size="10"><?= h($dadosboleto["carteira"]) ?></font></td>
      </tr>
    </table></td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><font size="7">Moeda </font></td>
      </tr>
      <tr>
        <td><font size="10"><?= h($dadosboleto["moeda"]) ?></font></td>
      </tr>
    </table></td>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><font size="7">Quantidade </font></td>
      </tr>
      <tr>
        <td><font size="10">&nbsp;</font></td>
      </tr>
    </table></td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><font size="7">Valor </font></td>
      </tr>
      <tr>
        <td><font size="10">&nbsp;</font></td>
      </tr>
    </table></td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><font size="7">(=) Valor do documento</font></td>
      </tr>
      <tr>
        <td><font size="10">R$ <?= h($dadosboleto["valor_boleto"]) ?></font></td>
      </tr>
    </table></td>
  </tr>



  <tr>
    <td colspan="6" rowspan="5">&nbsp;</td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><font size="7">(-) Desconto </font></td>
      </tr>
      <tr>
        <td><font size="10">R$ </font></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><font size="7">(-) Outros Dedu&ccedil;&otilde;es / Abatimento </font></td>
      </tr>
      <tr>
        <td><font size="10">R$ </font></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><font size="7">(+) Mora/Multa/Juros</font></td>
      </tr>
      <tr>
        <td><font size="10">R$ </font></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><font size="7">(=) Outros Acr&eacute;cimos </font></td>
      </tr>
      <tr>
        <td><font size="10">R$ </font></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><font size="7">(=) Valor Cobrado </font></td>
      </tr>
      <tr>
        <td><font size="10">R$ </font></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="7">
    </td>
  </tr>
</table>

<table width="540" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td width="420"><?php echo $dadosboleto["codigo_barras"]; ?></td>
    <td width="120"><font size="7">Ficha de Compensa&ccedil;&atilde;o<br />
    Autentica&ccedil;&atilde;o no verso</font></td>
  </tr>
</table>

</BODY></HTML>
