<?php require_once("../../controller/validosession.controller.php");
      require_once("../../conf.ini.php");
      require_once("../../model/class/menu.class.php");
      require_once("../../model/class/breadcrumbs.class.php");
      require_once("../../model/class/paginas.class.php");
      require_once("../../model/class/empresa.class.php");
      require_once("../../model/class/sedes.class.php");
      require_once("../../model/class/home.class.php");
      require_once("../../model/class/numeracion.class.php");
      require_once("../../model/class/sedes.class.php");

      $row_paginas = Gestion_Paginas::ReadbyID(base64_decode($pagid));
      $empresa     = Gestion_Empresa::ReadbyID($_emp_codigo);
      $laboratorio = Gestion_Sedes::ReadbyEmpresa($_emp_codigo);

?>


<?php
	require_once("../../model/dbconn.model.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- Meta information -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<!-- Title-->
<title>Bienvenido a MIDAS</title>
<!-- Favicons -->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="assets/ico/favicon.ico">
<!-- CSS Stylesheet-->
<link type="text/css" rel="stylesheet" href="assets/css/bootstrap/bootstrap.min.css" />
<link type="text/css" rel="stylesheet" href="assets/css/bootstrap/bootstrap-themes.css" />
<link type="text/css" rel="stylesheet" href="assets/css/style.css" />
<!-- CSS Stylesheet-->

<!-- Styleswitch if  you don't chang theme , you can delete -->
<link type="text/css" rel="alternate stylesheet" media="screen" title="style1" href="assets/css/styleTheme1.css" />
<link type="text/css" rel="alternate stylesheet" media="screen" title="style2" href="assets/css/styleTheme2.css" />
<link type="text/css" rel="alternate stylesheet" media="screen" title="style3" href="assets/css/styleTheme3.css" />
<link type="text/css" rel="alternate stylesheet" media="screen" title="style4" href="assets/css/styleTheme4.css" />

<style>
#validate-wizard{
	margin:auto;
	}


  .modal-welcome{
    background-color: transparent;
    box-shadow: none;
    font-family: "code_light";
    font-size: 45px;
    color: white;
    text-align: center;
    letter-spacing: 2px;
    width: 900px;
    left: 35%;
  }

  .modal-welcome span{
    font-family: "Varela",sans-serif;
    font-weight: 100;
    font-size: 15px;
  }

  .modal-welcome .btns{
    font-family: "oswaldregular" !important;
    letter-spacing: 2px;
    font-size: 15px;}
</style>

</head>
<body class="full-lg">
<?php include("sections/section.welcome.php");?>
<header><?php require_once("sections/section.header.php");?></header>
<div id="wrapper">

<div id="loading-top">
		<div id="canvas_loading"></div>
		<span>Cargando elementos...</span>
</div>

<div id="main">
		<div class="container">
				<div class="row">
						<div class="col-lg-12">

								<div class="account-wall">
										<section class="align-lg-center">
										<h1 class="login-title"><span> CONFIGURA TU MIDAS </span><small> Pedimos unos minutos para la configuración de tu cuenta MIDAS, solo se realiza una vez</small></h1>
										<br>
										</section>
										<form id="validate-wizard" action="../../controller/crud_updatedata.controller.php" class="wizard-step shadow" method="POST">
												<ul class="align-lg-right" >
														<li><a href="#step1" data-toggle="tab">1</a></li>
														<li><a href="#step2" data-toggle="tab">2</a></li>
														<li><a href="#step3" data-toggle="tab">3</a></li>
														<li><a href="#step4" data-toggle="tab">FIN</a></li>
												</ul>

												<div class="progress progress-stripes progress-sm" style="margin:0">
														<div class="progress-bar" data-color="theme"></div>
												</div>
												<div class="tab-content">
														<div class="tab-pane fade" id="step1" parsley-validate parsley-bind>

                              <h3>PASO 1: CONFIGURAR NUMERACIONES</h3>
															<span>Ingresa los consecutivos desde el cual quieren comenzar a generar las facturas, notas débito y notas crédito</span><br><br>
                                <div class="row">
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label class="control-label">Consecutivo Inicial Facturas</label>
                                      <input name="num_factura" type="number" class="form-control" parsley-trigger="keyup" parsley-required="true" >
                                    </div>
                                  </div>

                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label class="control-label">Consecutivo Inicial Notas Débito</label>
                                      <input name="num_comprobantepago" type="number" class="form-control" parsley-trigger="keyup" parsley-required="true" >
                                    </div>
                                  </div>

                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label class="control-label">Consecutivo Inicial Notas Crédito</label>
                                      <input name="num_notacredito" type="number" class="form-control" parsley-trigger="keyup" parsley-required="true" >
                                    </div>
                                  </div>
                                </div>
														</div>

														<div class="tab-pane fade" id="step2" parsley-validate parsley-bind>
															<h3>PASO 2: COMPLETAR LA INFORMACIÓN DE <?php echo $empresa["emp_razon_social"] ?> </h3>
														<span>Ingresa todos los datos de <?php echo $empresa["emp_razon_social"] ?> y así podremos configurar mejor los datos de tus facturas </span><br><br>

                            <div class="row">
                               <div class="col-md-6">
                                    <input value="<?php echo $empresa[0];?>" name="txt_emp_codigo" type="hidden" class="form-control" readonly >
                                   <div class="form-group">
                                    <label class="control-label">Nit</label>
                                    <input value="<?php echo $empresa[1];?>" name="txt_emp_nit"  type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                                  </div>

                                  <div class="form-group">
                                    <label class="control-label">Razón Social</label>
                                      <input value="<?php echo $empresa[2];?>" name="txt_emp_razon_social"  type="text" class="form-control"  parsley-trigger="change" parsley-required="true">
                                  </div>

                                  <div class="form-group">
                                    <label class="control-label">Representante</label>
                                      <input value="<?php echo $empresa[3];?>" name="txt_emp_representante"  type="text" class="form-control"  parsley-trigger="change">
                                  </div>

                                  <div class="form-group">
                                    <label class="control-label">Teléfono </label>
                                      <input value="<?php echo $empresa[6];?>" name="txt_emp_telefono"  type="text" class="form-control" parsley-trigger="change" >
                                  </div>

                                  <div class="form-group">
                                    <label class="control-label">Dirección   </label>
                                      <input value="<?php echo $empresa[7];?>" name="txt_emp_direccion"  type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                                  </div>
                              </div>

                              <div class="col-md-6">

                                  <div class="form-group">
                                    <label class="control-label">Correo Electronico</label>
                                      <input value="<?php echo $empresa[8];?>" name="txt_emp_email"  type="email" class="form-control" parsley-trigger="change" parsley-required="true">
                                  </div>

                                  <div class="form-group">
                                      <label class="control-label">Pais de origen</label>
                                      <select name="txt_emp_pais" id="countries_states1" class="form-control bfh-countries" data-country="CO" data-filter="true"></select>
                                  </div>

                                  <div class="form-group">
                                      <label class="control-label">Ciudad</label>
                                      <div id="drop-city">
                                        <?php
                                        require_once("../../model/class/localizacion.class.php");

                                        $ciudades = Gestion_Localidad::Read_City();
                                        ?>

                                        <select class="form-control" id="txt-ciudad" name="txt_emp_ciudad" >
                                          <?php
                                            foreach($ciudades as $ciudad){
                                              echo "<option value='".$ciudad[1]."'>".ucwords(strtolower($ciudad[2]))."</option>";
                                            }
                                          ?>
                                        </select>
                                       </div>
                                  </div>

                                  <div class="form-group">
                                    <label class="control-label">Moneda </label>
                                    <select name="txt_emp_moneda" class="form-control  " >
                                      <option <?php  if($empresa[10]=="COP"){ echo "selected";} ?> value="COP">Colombia peso</option>
                                      <option <?php if($empresa[10]=="USD"){ echo "selected";} ?> value="USD">United States dollar</option>
                                      <option <?php if($empresa[10]=="EUR"){ echo "selected";} ?> value="EUR">Euro</option>
                                      <option <?php if($empresa[10]=="AED"){ echo "selected";} ?> value="AED">United Arab Emirates dirham</option>
                                      <option <?php if($empresa[10]=="AFN"){ echo "selected";} ?> value="AFN">Afghan afghani</option>
                                      <option <?php if($empresa[10]=="ALL"){ echo "selected";} ?> value="ALL">Albanian lek</option>
                                      <option <?php if($empresa[10]=="AMD"){ echo "selected";} ?> value="AMD">Armenian dram</option>
                                      <option <?php if($empresa[10]=="AOA"){ echo "selected";} ?> value="AOA">Angolan kwanza</option>
                                      <option <?php if($empresa[10]=="ARS"){ echo "selected";} ?> value="ARS">Argentine peso</option>
                                      <option <?php if($empresa[10]=="AUD"){ echo "selected";} ?> value="AUD">Australian dollar</option>
                                      <option <?php if($empresa[10]=="AWG"){ echo "selected";} ?> value="AWG">Aruban florin</option>
                                      <option <?php if($empresa[10]=="AZN"){ echo "selected";} ?> value="AZN">Azerbaijani manat</option>
                                      <option <?php if($empresa[10]=="BAM"){ echo "selected";} ?> value="BAM">Bosnia and Herzegovina convertible mark</option>
                                      <option <?php if($empresa[10]=="BBD"){ echo "selected";} ?> value="BBD">Barbadian dollar</option>
                                      <option <?php if($empresa[10]=="BDT"){ echo "selected";} ?> value="BDT">Bangladeshi taka</option>
                                      <option <?php if($empresa[10]=="BGN"){ echo "selected";} ?> value="BGN">Bulgarian lev</option>
                                      <option <?php if($empresa[10]=="BHD"){ echo "selected";} ?> value="BHD">Bahraini dinar</option>
                                      <option <?php if($empresa[10]=="BIF"){ echo "selected";} ?> value="BIF">Burundian franc</option>
                                      <option <?php if($empresa[10]=="BMD"){ echo "selected";} ?> value="BMD">Bermudian dollar</option>
                                      <option <?php if($empresa[10]=="BND"){ echo "selected";} ?> value="BND">Brunei dollar</option>
                                      <option <?php if($empresa[10]=="BOB"){ echo "selected";} ?> value="BOB">Bolivian boliviano</option>
                                      <option <?php if($empresa[10]=="BRL"){ echo "selected";} ?> value="BRL">Brazilian real</option>
                                      <option <?php if($empresa[10]=="BSD"){ echo "selected";} ?> value="BSD">Bahamian dollar</option>
                                      <option <?php if($empresa[10]=="BTN"){ echo "selected";} ?> value="BTN">Bhutanese ngultrum</option>
                                      <option <?php if($empresa[10]=="BWP"){ echo "selected";} ?> value="BWP">Botswana pula</option>
                                      <option <?php if($empresa[10]=="BYR"){ echo "selected";} ?> value="BYR">Belarusian ruble</option>
                                      <option <?php if($empresa[10]=="BZD"){ echo "selected";} ?> value="BZD">Belize dollar</option>
                                      <option <?php if($empresa[10]=="CAD"){ echo "selected";} ?> value="CAD">Canadian dollar</option>
                                      <option <?php if($empresa[10]=="CDF"){ echo "selected";} ?> value="CDF">Congolese franc</option>
                                      <option <?php if($empresa[10]=="CHF"){ echo "selected";} ?> value="CHF">Swiss franc</option>
                                      <option <?php if($empresa[10]=="CLP"){ echo "selected";} ?> value="CLP">Chilean peso</option>
                                      <option <?php if($empresa[10]=="CNY"){ echo "selected";} ?> value="CNY">Chinese yuan</option>
                                      <option <?php if($empresa[10]=="CRC"){ echo "selected";} ?> value="CRC">Costa Rican colón</option>
                                      <option <?php if($empresa[10]=="CUP"){ echo "selected";} ?> value="CUP">Cuban convertible peso</option>
                                      <option <?php if($empresa[10]=="CVE"){ echo "selected";} ?> value="CVE">Cape Verdean escudo</option>
                                      <option <?php if($empresa[10]=="CZK"){ echo "selected";} ?> value="CZK">Czech koruna</option>
                                      <option <?php if($empresa[10]=="DJF"){ echo "selected";} ?> value="DJF">Djiboutian franc</option>
                                      <option <?php if($empresa[10]=="DKK"){ echo "selected";} ?> value="DKK">Danish krone</option>
                                      <option <?php if($empresa[10]=="DOP"){ echo "selected";} ?> value="DOP">Dominican peso</option>
                                      <option <?php if($empresa[10]=="DZD"){ echo "selected";} ?> value="DZD">Algerian dinar</option>
                                      <option <?php if($empresa[10]=="EGP"){ echo "selected";} ?> value="EGP">Egyptian pound</option>
                                      <option <?php if($empresa[10]=="ERN"){ echo "selected";} ?> value="ERN">Eritrean nakfa</option>
                                      <option <?php if($empresa[10]=="ETB"){ echo "selected";} ?> value="ETB">Ethiopian birr</option>
                                      <option <?php if($empresa[10]=="FJD"){ echo "selected";} ?> value="FJD">Fijian dollar</option>
                                      <option <?php if($empresa[10]=="FKP"){ echo "selected";} ?> value="FKP">Falkland Islands pound</option>
                                      <option <?php if($empresa[10]=="GBP"){ echo "selected";} ?> value="GBP">British pound</option>
                                      <option <?php if($empresa[10]=="GEL"){ echo "selected";} ?> value="GEL">Georgian lari</option>
                                      <option <?php if($empresa[10]=="GHS"){ echo "selected";} ?> value="GHS">Ghana cedi</option>
                                      <option <?php if($empresa[10]=="GMD"){ echo "selected";} ?> value="GMD">Gambian dalasi</option>
                                      <option <?php if($empresa[10]=="GNF"){ echo "selected";} ?> value="GNF">Guinean franc</option>
                                      <option <?php if($empresa[10]=="GTQ"){ echo "selected";} ?> value="GTQ">Guatemalan quetzal</option>
                                      <option <?php if($empresa[10]=="GYD"){ echo "selected";} ?> value="GYD">Guyanese dollar</option>
                                      <option <?php if($empresa[10]=="HKD"){ echo "selected";} ?> value="HKD">Hong Kong dollar</option>
                                      <option <?php if($empresa[10]=="HNL"){ echo "selected";} ?> value="HNL">Honduran lempira</option>
                                      <option <?php if($empresa[10]=="HRK"){ echo "selected";} ?> value="HRK">Croatian kuna</option>
                                      <option <?php if($empresa[10]=="HTG"){ echo "selected";} ?> value="HTG">Haitian gourde</option>
                                      <option <?php if($empresa[10]=="HUF"){ echo "selected";} ?> value="HUF">Hungarian forint</option>
                                      <option <?php if($empresa[10]=="IDR"){ echo "selected";} ?> value="IDR">Indonesian rupiah</option>
                                      <option <?php if($empresa[10]=="ILS"){ echo "selected";} ?> value="ILS">Israeli new shekel</option>
                                      <option <?php if($empresa[10]=="IMP"){ echo "selected";} ?> value="IMP">Manx pound</option>
                                      <option <?php if($empresa[10]=="INR"){ echo "selected";} ?> value="INR">Indian rupee</option>
                                      <option <?php if($empresa[10]=="IQD"){ echo "selected";} ?> value="IQD">Iraqi dinar</option>
                                      <option <?php if($empresa[10]=="IRR"){ echo "selected";} ?> value="IRR">Iranian rial</option>
                                      <option <?php if($empresa[10]=="ISK"){ echo "selected";} ?> value="ISK">Icelandic króna</option>
                                      <option <?php if($empresa[10]=="JEP"){ echo "selected";} ?> value="JEP">Jersey pound</option>
                                      <option <?php if($empresa[10]=="JMD"){ echo "selected";} ?> value="JMD">Jamaican dollar</option>
                                      <option <?php if($empresa[10]=="JOD"){ echo "selected";} ?> value="JOD">Jordanian dinar</option>
                                      <option <?php if($empresa[10]=="JPY"){ echo "selected";} ?> value="JPY">Japanese yen</option>
                                      <option <?php if($empresa[10]=="KES"){ echo "selected";} ?> value="KES">Kenyan shilling</option>
                                      <option <?php if($empresa[10]=="KGS"){ echo "selected";} ?> value="KGS">Kyrgyzstani som</option>
                                      <option <?php if($empresa[10]=="KHR"){ echo "selected";} ?> value="KHR">Cambodian riel</option>
                                      <option <?php if($empresa[10]=="KMF"){ echo "selected";} ?> value="KMF">Comorian franc</option>
                                      <option <?php if($empresa[10]=="KPW"){ echo "selected";} ?> value="KPW">North Korean won</option>
                                      <option <?php if($empresa[10]=="KRW"){ echo "selected";} ?> value="KRW">South Korean won</option>
                                      <option <?php if($empresa[10]=="KWD"){ echo "selected";} ?> value="KWD">Kuwaiti dinar</option>
                                      <option <?php if($empresa[10]=="KYD"){ echo "selected";} ?> value="KYD">Cayman Islands dollar</option>
                                      <option <?php if($empresa[10]=="KZT"){ echo "selected";} ?> value="KZT">Kazakhstani tenge</option>
                                      <option <?php if($empresa[10]=="LAK"){ echo "selected";} ?> value="LAK">Lao kip</option>
                                      <option <?php if($empresa[10]=="LBP"){ echo "selected";} ?> value="LBP">Lebanese pound</option>
                                      <option <?php if($empresa[10]=="LKR"){ echo "selected";} ?> value="LKR">Sri Lankan rupee</option>
                                      <option <?php if($empresa[10]=="LRD"){ echo "selected";} ?> value="LRD">Liberian dollar</option>
                                      <option <?php if($empresa[10]=="LSL"){ echo "selected";} ?> value="LSL">Lesotho loti</option>
                                      <option <?php if($empresa[10]=="LTL"){ echo "selected";} ?> value="LTL">Lithuanian litas</option>
                                      <option <?php if($empresa[10]=="LVL"){ echo "selected";} ?> value="LVL">Latvian lats</option>
                                      <option <?php if($empresa[10]=="LYD"){ echo "selected";} ?> value="LYD">Libyan dinar</option>
                                      <option <?php if($empresa[10]=="MAD"){ echo "selected";} ?> value="MAD">Moroccan dirham</option>
                                      <option <?php if($empresa[10]=="MDL"){ echo "selected";} ?> value="MDL">Moldovan leu</option>
                                      <option <?php if($empresa[10]=="MGA"){ echo "selected";} ?> value="MGA">Malagasy ariary</option>
                                      <option <?php if($empresa[10]=="MKD"){ echo "selected";} ?> value="MKD">Macedonian denar</option>
                                      <option <?php if($empresa[10]=="MMK"){ echo "selected";} ?> value="MMK">Burmese kyat</option>
                                      <option <?php if($empresa[10]=="MNT"){ echo "selected";} ?> value="MNT">Mongolian tögrög</option>
                                      <option <?php if($empresa[10]=="MOP"){ echo "selected";} ?> value="MOP">Macanese pataca</option>
                                      <option <?php if($empresa[10]=="MRO"){ echo "selected";} ?> value="MRO">Mauritanian ouguiya</option>
                                      <option <?php if($empresa[10]=="MUR"){ echo "selected";} ?> value="MUR">Mauritian rupee</option>
                                      <option <?php if($empresa[10]=="MVR"){ echo "selected";} ?> value="MVR">Maldivian rufiyaa</option>
                                      <option <?php if($empresa[10]=="MWK"){ echo "selected";} ?> value="MWK">Malawian kwacha</option>
                                      <option <?php if($empresa[10]=="MXN"){ echo "selected";} ?> value="MXN">Mexican peso</option>
                                      <option <?php if($empresa[10]=="MYR"){ echo "selected";} ?> value="MYR">Malaysian ringgit</option>
                                      <option <?php if($empresa[10]=="MZN"){ echo "selected";} ?> value="MZN">Mozambican metical</option>
                                      <option <?php if($empresa[10]=="NAD"){ echo "selected";} ?> value="NAD">Namibian dollar</option>
                                      <option <?php if($empresa[10]=="NGN"){ echo "selected";} ?> value="NGN">Nigerian naira</option>
                                      <option <?php if($empresa[10]=="NIO"){ echo "selected";} ?> value="NIO">Nicaraguan córdoba</option>
                                      <option <?php if($empresa[10]=="NOK"){ echo "selected";} ?> value="NOK">Norwegian krone</option>
                                      <option <?php if($empresa[10]=="NPR"){ echo "selected";} ?> value="NPR">Nepalese rupee</option>
                                      <option <?php if($empresa[10]=="NZD"){ echo "selected";} ?> value="NZD">New Zealand dollar</option>
                                      <option <?php if($empresa[10]=="OMR"){ echo "selected";} ?> value="OMR">Omani rial</option>
                                      <option <?php if($empresa[10]=="PAB"){ echo "selected";} ?> value="PAB">Panamanian balboa</option>
                                      <option <?php if($empresa[10]=="PEN"){ echo "selected";} ?> value="PEN">Peruvian nuevo sol</option>
                                      <option <?php if($empresa[10]=="PGK"){ echo "selected";} ?> value="PGK">Papua New Guinean kina</option>
                                      <option <?php if($empresa[10]=="PHP"){ echo "selected";} ?> value="PHP">Philippine peso</option>
                                      <option <?php if($empresa[10]=="PKR"){ echo "selected";} ?> value="PKR">Pakistani rupee</option>
                                      <option <?php if($empresa[10]=="PLN"){ echo "selected";} ?> value="PLN">Polish złoty</option>
                                      <option <?php if($empresa[10]=="PRB"){ echo "selected";} ?> value="PRB">Transnistrian ruble</option>
                                      <option <?php if($empresa[10]=="PYG"){ echo "selected";} ?> value="PYG">Paraguayan guaraní</option>
                                      <option <?php if($empresa[10]=="QAR"){ echo "selected";} ?> value="QAR">Qatari riyal</option>
                                      <option <?php if($empresa[10]=="RON"){ echo "selected";} ?> value="RON">Romanian leu</option>
                                      <option <?php if($empresa[10]=="RSD"){ echo "selected";} ?> value="RSD">Serbian dinar</option>
                                      <option <?php if($empresa[10]=="RUB"){ echo "selected";} ?> value="RUB">Russian ruble</option>
                                      <option <?php if($empresa[10]=="RWF"){ echo "selected";} ?> value="RWF">Rwandan franc</option>
                                      <option <?php if($empresa[10]=="SAR"){ echo "selected";} ?> value="SAR">Saudi riyal</option>
                                      <option <?php if($empresa[10]=="SBD"){ echo "selected";} ?> value="SBD">Solomon Islands dollar</option>
                                      <option <?php if($empresa[10]=="SCR"){ echo "selected";} ?> value="SCR">Seychellois rupee</option>
                                      <option <?php if($empresa[10]=="SDG"){ echo "selected";} ?> value="SDG">Singapore dollar</option>
                                      <option <?php if($empresa[10]=="SEK"){ echo "selected";} ?> value="SEK">Swedish krona</option>
                                      <option <?php if($empresa[10]=="SGD"){ echo "selected";} ?> value="SGD">Singapore dollar</option>
                                      <option <?php if($empresa[10]=="SHP"){ echo "selected";} ?> value="SHP">Saint Helena pound</option>
                                      <option <?php if($empresa[10]=="SLL"){ echo "selected";} ?> value="SLL">Sierra Leonean leone</option>
                                      <option <?php if($empresa[10]=="SOS"){ echo "selected";} ?> value="SOS">Somali shilling</option>
                                      <option <?php if($empresa[10]=="SRD"){ echo "selected";} ?> value="SRD">Surinamese dollar</option>
                                      <option <?php if($empresa[10]=="SSP"){ echo "selected";} ?> value="SSP">South Sudanese pound</option>
                                      <option <?php if($empresa[10]=="STD"){ echo "selected";} ?> value="STD">São Tomé and Príncipe dobra</option>
                                      <option <?php if($empresa[10]=="SVC"){ echo "selected";} ?> value="SVC">Salvadoran colón</option>
                                      <option <?php if($empresa[10]=="SYP"){ echo "selected";} ?> value="SYP">Syrian pound</option>
                                      <option <?php if($empresa[10]=="SZL"){ echo "selected";} ?> value="SZL">Swazi lilangeni</option>
                                      <option <?php if($empresa[10]=="THB"){ echo "selected";} ?> value="THB">Thai baht</option>
                                      <option <?php if($empresa[10]=="TJS"){ echo "selected";} ?> value="TJS">Tajikistani somoni</option>
                                      <option <?php if($empresa[10]=="TMT"){ echo "selected";} ?> value="TMT">Turkmenistan manat</option>
                                      <option <?php if($empresa[10]=="TND"){ echo "selected";} ?> value="TND">Tunisian dinar</option>
                                      <option <?php if($empresa[10]=="TOP"){ echo "selected";} ?> value="TOP">Tongan paʻanga</option>
                                      <option <?php if($empresa[10]=="TRY"){ echo "selected";} ?> value="TRY">Turkish lira</option>
                                      <option <?php if($empresa[10]=="TTD"){ echo "selected";} ?> value="TTD">Trinidad and Tobago dollar</option>
                                      <option <?php if($empresa[10]=="TWD"){ echo "selected";} ?> value="TWD">New Taiwan dollar</option>
                                      <option <?php if($empresa[10]=="TZS"){ echo "selected";} ?> value="TZS">Tanzanian shilling</option>
                                      <option <?php if($empresa[10]=="UAH"){ echo "selected";} ?> value="UAH">Ukrainian hryvnia</option>
                                      <option <?php if($empresa[10]=="UGX"){ echo "selected";} ?> value="UGX">Ugandan shilling</option>
                                      <option <?php if($empresa[10]=="UYU"){ echo "selected";} ?> value="UYU">Uruguayan peso</option>
                                      <option <?php if($empresa[10]=="UZS"){ echo "selected";} ?> value="UZS">Uzbekistani som</option>
                                      <option <?php if($empresa[10]=="VEF"){ echo "selected";} ?> value="VEF">Venezuelan bolívar</option>
                                      <option <?php if($empresa[10]=="VND"){ echo "selected";} ?> value="VND">Vietnamese đồng</option>
                                      <option <?php if($empresa[10]=="VUV"){ echo "selected";} ?> value="VUV">Vanuatu vatu</option>
                                      <option <?php if($empresa[10]=="WST"){ echo "selected";} ?> value="WST">Samoan tālā</option>
                                      <option <?php if($empresa[10]=="XAF"){ echo "selected";} ?> value="XAF">Central African CFA franc</option>
                                      <option <?php if($empresa[10]=="XCD"){ echo "selected";} ?> value="XCD">East Caribbean dollar</option>
                                      <option <?php if($empresa[10]=="XOF"){ echo "selected";} ?> value="XOF">West African CFA franc</option>
                                      <option <?php if($empresa[10]=="XPF"){ echo "selected";} ?> value="XPF">CFP franc</option>
                                      <option <?php if($empresa[10]=="YER"){ echo "selected";} ?> value="YER">Yemeni rial</option>
                                      <option <?php if($empresa[10]=="ZAR"){ echo "selected";} ?> value="ZAR">South African rand</option>
                                      <option <?php if($empresa[10]=="ZMW"){ echo "selected";} ?> value="ZMW">Zambian kwacha</option>
                                      <option <?php if($empresa[10]=="ZWL"){ echo "selected";} ?> value="ZWL">Zimbabwean dollar</option>
                                    </select>

                                  </div>

                                </div>
                              </div>

														</div>

													<div class="tab-pane fade" id="step3" parsley-validate parsley-bind>
														<h3>PASO 3: COMPLETA LA INFORMACIÓN DEL LABORATORIO <?php ?></h3>
														<span>Nuestro último formulario! inscribe una cuenta bancaria de alguno de los laboratorios de la franquicia</span><br><br>

                            <div class="row">
                               <div class="col-md-6">
                                    <input name="txt_sed_codigo" type="hidden" class="form-control" readonly value="<?php echo $laboratorio[0];?>">


                                  <div class="form-group">
                                    <label class="control-label">Nombre de la Sede</label>
                                    <input name="txt_sed_nombre"  type="text" class="form-control" parsley-trigger="change" parsley-required="true" value="<?php echo $laboratorio['sed_nombre'];?>">
                                  </div>

                                  <div class="form-group">
                                    <label class="control-label">Teléfono</label>
                                      <?php
                                        if($laboratorio[3] == 0){
                                          $telefono = "";
                                        }else{
                                          $telefono = $laboratorio[3];
                                        }
                                      ?>
                                      <input name="txt_sed_telefono"  type="text" class="form-control" parsley-trigger="change" parsley-required="true" value="<?php echo $telefono;?>">
                                  </div>

                                  <div class="form-group">
                                    <label class="control-label">Email </label>
                                      <input name="txt_sed_email"  type="email" class="form-control"   parsley-required="true"  parsley-trigger="change" value="<?php echo $laboratorio[4];?>">
                                  </div>

                                  <div class="form-group">
                                    <label class="control-label">Dirección</label>
                                      <input name="txt_sed_direccion"  type="text" class="form-control" parsley-trigger="change" parsley-required="true" value="<?php echo $laboratorio[5];?>">
                                  </div>


                                  <div class="form-group">
            													<label class="control-label">Pais de origen</label>
            													<select name="txt_sed_pais" id="countries_states1" class="form-control bfh-countries" data-country="CO" data-filter="true"></select>
            											</div>
                                </div>
                                <div class="col-md-6">


                                  <div class="form-group">
            													<label class="control-label">Departamento</label>
            													<select id="countries_states2" name="txt_sed_departamento" class="form-control bfh-states" data-country="countries_states1" data-state="05"> </select>
            								 			</div>

            										 	<div class="form-group">
            													<label class="control-label">Ciudad</label>
            													<div id="drop-city">
            														<?php
            														require_once("../../model/class/localizacion.class.php");

            														$ciudades = Gestion_Localidad::Read_City_byState("05");
            														?>

            														<select class="form-control" id="txt-ciudad" name="txt_sed_ciudad" >
            															<?php
            																foreach($ciudades as $ciudad){
            																	echo "<option value='".$ciudad[1]."'>".ucwords(strtolower($ciudad[2]))."</option>";
            																}
            															?>
            														</select>
            													 </div>
            											</div>

                                  <div class="form-group">
                                    <label class="control-label">Abierto desde: </label>
                                      <input name="txt_sed_horainicio"  type="time" class="form-control" parsley-trigger="change" parsley-required="true"  value="<?php echo $laboratorio[12];?>">
                                  </div>

                                  <div class="form-group">
                                    <label class="control-label">Hasta:   </label>
                                    <input name="txt_sed_horacierre"  type="time" class="form-control" parsley-trigger="change" parsley-required="true"  value="<?php echo $laboratorio[13];?>">
                                  </div>
                                </div>
														      </div>
																</div>



														<div class="tab-pane fade align-lg-center" id="step5">
																<br><h3>Hemos terminado<span>muchas gracias por completar cada uno de los campos de los formularios, espere mientras lo redireccionamos al dashboard de MIDAS...</span></h3><br>
														</div>

														<footer class="row">
															<div class="col-sm-12">
																	<section class="wizard">
																			<button type="button"  class="btn  btn-default previous pull-left"> <i class="fa fa-chevron-left"></i> Anterior</button>
																			<button type="button"  class="btn btn-primary next pull-right">Siguiente <i class="fa fa-chevron-right"></i></button>
																	</section>
															</div>
														</footer>
												</div>
										</form>
										<section class="clearfix align-lg-center">
										</section>

								</div>
								<!-- //account-wall-->

						</div>
						<!-- //col-sm-6 col-md-4 col-md-offset-4-->
				</div>
				<!-- //row-->
		</div>
		<!-- //container-->

</div>
<!-- //main-->


</div>
<!-- //wrapper-->


<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->

<!-- Jquery Library -->
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.ui.min.js"></script>
<script type="text/javascript" src="assets/plugins/bootstrap/bootstrap.min.js"></script>
<!-- Modernizr Library For HTML5 And CSS3 -->
<script type="text/javascript" src="assets/js/modernizr/modernizr.js"></script>
<script type="text/javascript" src="assets/plugins/mmenu/jquery.mmenu.js"></script>
<script type="text/javascript" src="assets/js/styleswitch.js"></script>
<!-- Library 10+ Form plugins-->
<script type="text/javascript" src="assets/plugins/form/form.js"></script>
<!-- Datetime plugins -->
<script type="text/javascript" src="assets/plugins/datetime/datetime.js"></script>
<!-- Library Chart-->
<script type="text/javascript" src="assets/plugins/chart/chart.js"></script>
<!-- Library  5+ plugins for bootstrap -->
<script type="text/javascript" src="assets/plugins/pluginsForBS/pluginsForBS.js"></script>
<!-- Library 10+ miscellaneous plugins -->
<script type="text/javascript" src="assets/plugins/miscellaneous/miscellaneous.js"></script>
<!-- Library Themes Customize-->
<script type="text/javascript" src="assets/js/caplet.custom.js"></script>
<script type="text/javascript" src="assets/plugins/BootstrapFormHelpers-master/dist/js/bootstrap-formhelpers.js"></script>
<link rel="stylesheet" type="text/css" href="assets/plugins/sweetalert-master/sweetalert.css">
<script src="assets/plugins/sweetalert-master/sweetalert.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
  if($("#nuevoingreso").val() == 0){
     $('#saludo').modal('show');
  }


  $("#no-take-tour").click(function() {
    $('#saludo').modal("hide");
    $("#dd" ).load( "../../controller/take_tour.php?taketour=0" );
  });
		   //Login animation to center
			function toCenter(){
					var mainH=$("#main").outerHeight();
					var accountH=$(".account-wall").outerHeight();
					var marginT=(mainH-accountH)/2;
						   if(marginT>30){
							   $(".account-wall").css("margin-top",marginT-15);
							}else{
								$(".account-wall").css("margin-top",30);
							}
				}
				var toResize;
				$(window).resize(function(e) {
					clearTimeout(toResize);
					toResize = setTimeout(toCenter(), 500);
				});

			//Canvas Loading
			  var throbber = new Throbber({  size: 32, padding: 17,  strokewidth: 2.8,  lines: 12, rotationspeed: 0, fps: 15 });
			  throbber.appendTo(document.getElementById('canvas_loading'));
			  throbber.start();

			$('#validate-wizard').bootstrapWizard({
					tabClass:"nav-wizard",
					onNext: function(tab, navigation, index) {
									var content=$('#step'+index);
									if(typeof  content.attr("parsley-validate") != 'undefined'){
													var $valid = content.parsley( 'validate' );
													if(!$valid){
																	return false;
													}
									};

					// Set the name for the next tab
					$('#step3 h3').find("span").html($('#fullname').val());
					},
					 onTabClick: function(tab, navigation, index) {
									$.notific8('Para navegar entre los pasos hacerlos a traves de los botones <strong>siguiente</strong> y <strong>anterior</strong> ',{ life:5000, theme:"danger" ,heading:" MIDAS Tip :)  "});
									return false;
					},
					onTabShow: function(tab, navigation, index) {
									tab.prevAll().addClass('completed');
									tab.nextAll().removeClass('completed');
									if(tab.hasClass("active")){
													tab.removeClass('completed');
									}
									var $total = navigation.find('li').length;
									var $current = index+1;
									var $percent = ($current/$total) * 100;
									$('#validate-wizard').find('.progress-bar').css({width:$percent+'%'});
									$('#validate-wizard').find('.wizard-status span').html($current+" / "+$total);

									toCenter();

									var main=$("#main");
									//scroll to top
									main.animate({
										scrollTop: 0
									}, 500);
									if($percent==100){
									  $( "#validate-wizard" ).submit();
									}

					}
			});


});
</script>
</body>
</html>
