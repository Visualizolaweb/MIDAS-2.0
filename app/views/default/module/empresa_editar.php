<div id="main">
<?php
  //Gestionar_Breadcrumbs::breadcrumbs(base64_decode($pagid));

  require_once("../../conf.ini.php");
  require_once("../../model/class/empresa.class.php");

  if(isset($_GET["pid"])){
    $cod_empresa = base64_decode($_GET["pid"]);
  }else{
    $cod_empresa = $_emp_codigo;
  }

  $row = Gestion_Empresa::ReadbyID($cod_empresa);

?>

  <div id="content" class="page_module">
    <div class="row">

      <div class="col-lg-2"></div>

      <div class="col-lg-8">
        <div class="panel">
          <header class="panel-heading">
            <h3><?php echo $row_paginas[1];?></h3>
            <span><?php echo $row_paginas[2];?></span>
          </header>

          <div class="panel-body">
              <form name="frm_create" parsley-validate action="../../controller/crud_empresa.controller.php" method="post">

                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label">Código</label>
                          <input value="<?php echo $row[0];?>" name="txt_emp_codigo" type="text" class="form-control" readonly >
                        </div>

                        <div class="form-group">
                          <label class="control-label">Nit</label>
                          <input value="<?php echo $row[1];?>" name="txt_emp_nit"  type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                        </div>

                        <div class="form-group">
                          <label class="control-label">Razón Social</label>
                            <input value="<?php echo $row[2];?>" name="txt_emp_razon_social"  type="text" class="form-control"  parsley-trigger="change" parsley-required="true">
                        </div>

                        <div class="form-group">
                          <label class="control-label">Representante</label>
                            <input value="<?php echo $row[3];?>" name="txt_emp_representante"  type="text" class="form-control"  parsley-trigger="change">
                        </div>

                        <div class="form-group">
                          <label class="control-label">Pais</label>
                              <select name="txt_emp_pais" id="countries_states1" class="form-control bfh-countries" data-country="<?php echo $row[4];?>" data-filter="true"></select>
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
                                  if($row['emp_ciudad']==$ciudad[1]){
                                    $selected = "selected";
                                  }else{
                                    $selected = "";
                                  }
                                  echo "<option value='".$ciudad[1]."' $selected>".ucwords(strtolower($ciudad[2]))."</option>";
                                }
                              ?>
                            </select>
                           </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label">Teléfono </label>
                            <input value="<?php echo $row[6];?>" name="txt_emp_telefono"  type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                        </div>

                        <div class="form-group">
                          <label class="control-label">Dirección   </label>
                            <input value="<?php echo $row[7];?>" name="txt_emp_direccion"  type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                        </div>

                        <div class="form-group">
                          <label class="control-label">Correo Electronico</label>
                            <input value="<?php echo $row[8];?>" name="txt_emp_email"  type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                        </div>

                        <div class="form-group">

													<input type="hidden" name="pagid" value="<?php echo $_REQUEST['pagid'];?>">
                          <label class="control-label">Sitio Web </label><div class="input-group">
                          <span class="input-group-addon">http://</span>
                            <input value="<?php echo $row[9];?>" name="txt_emp_sitioweb" placeholder="www.ejemplo.com" type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                       </div>
                       </div>

                        <div class="form-group">
                          <label class="control-label">Moneda   </label>
                          <select name="txt_emp_moneda" class="form-control " >
                            <option <?php if($row[10]=="AED"){ echo "selected";} ?> value="AED">United Arab Emirates dirham</option>
                            <option <?php if($row[10]=="AFN"){ echo "selected";} ?> value="AFN">Afghan afghani</option>
                            <option <?php if($row[10]=="ALL"){ echo "selected";} ?> value="ALL">Albanian lek</option>
                            <option <?php if($row[10]=="AMD"){ echo "selected";} ?> value="AMD">Armenian dram</option>
                            <option <?php if($row[10]=="AOA"){ echo "selected";} ?> value="AOA">Angolan kwanza</option>
                            <option <?php if($row[10]=="ARS"){ echo "selected";} ?> value="ARS">Argentine peso</option>
                            <option <?php if($row[10]=="AUD"){ echo "selected";} ?> value="AUD">Australian dollar</option>
                            <option <?php if($row[10]=="AWG"){ echo "selected";} ?> value="AWG">Aruban florin</option>
                            <option <?php if($row[10]=="AZN"){ echo "selected";} ?> value="AZN">Azerbaijani manat</option>
                            <option <?php if($row[10]=="BAM"){ echo "selected";} ?> value="BAM">Bosnia and Herzegovina convertible mark</option>
                            <option <?php if($row[10]=="BBD"){ echo "selected";} ?> value="BBD">Barbadian dollar</option>
                            <option <?php if($row[10]=="BDT"){ echo "selected";} ?> value="BDT">Bangladeshi taka</option>
                            <option <?php if($row[10]=="BGN"){ echo "selected";} ?> value="BGN">Bulgarian lev</option>
                            <option <?php if($row[10]=="BHD"){ echo "selected";} ?> value="BHD">Bahraini dinar</option>
                            <option <?php if($row[10]=="BIF"){ echo "selected";} ?> value="BIF">Burundian franc</option>
                            <option <?php if($row[10]=="BMD"){ echo "selected";} ?> value="BMD">Bermudian dollar</option>
                            <option <?php if($row[10]=="BND"){ echo "selected";} ?> value="BND">Brunei dollar</option>
                            <option <?php if($row[10]=="BOB"){ echo "selected";} ?> value="BOB">Bolivian boliviano</option>
                            <option <?php if($row[10]=="BRL"){ echo "selected";} ?> value="BRL">Brazilian real</option>
                            <option <?php if($row[10]=="BSD"){ echo "selected";} ?> value="BSD">Bahamian dollar</option>
                            <option <?php if($row[10]=="BTN"){ echo "selected";} ?> value="BTN">Bhutanese ngultrum</option>
                            <option <?php if($row[10]=="BWP"){ echo "selected";} ?> value="BWP">Botswana pula</option>
                            <option <?php if($row[10]=="BYR"){ echo "selected";} ?> value="BYR">Belarusian ruble</option>
                            <option <?php if($row[10]=="BZD"){ echo "selected";} ?> value="BZD">Belize dollar</option>
                            <option <?php if($row[10]=="CAD"){ echo "selected";} ?> value="CAD">Canadian dollar</option>
                            <option <?php if($row[10]=="CDF"){ echo "selected";} ?> value="CDF">Congolese franc</option>
                            <option <?php if($row[10]=="CHF"){ echo "selected";} ?> value="CHF">Swiss franc</option>
                            <option <?php if($row[10]=="CLP"){ echo "selected";} ?> value="CLP">Chilean peso</option>
                            <option <?php if($row[10]=="CNY"){ echo "selected";} ?> value="CNY">Chinese yuan</option>
                            <option <?php if($row[10]=="COP"){ echo "selected";} ?> value="COP">Colombia peso</option>
                            <option <?php if($row[10]=="CRC"){ echo "selected";} ?> value="CRC">Costa Rican colón</option>
                            <option <?php if($row[10]=="CUP"){ echo "selected";} ?> value="CUP">Cuban convertible peso</option>
                            <option <?php if($row[10]=="CVE"){ echo "selected";} ?> value="CVE">Cape Verdean escudo</option>
                            <option <?php if($row[10]=="CZK"){ echo "selected";} ?> value="CZK">Czech koruna</option>
                            <option <?php if($row[10]=="DJF"){ echo "selected";} ?> value="DJF">Djiboutian franc</option>
                            <option <?php if($row[10]=="DKK"){ echo "selected";} ?> value="DKK">Danish krone</option>
                            <option <?php if($row[10]=="DOP"){ echo "selected";} ?> value="DOP">Dominican peso</option>
                            <option <?php if($row[10]=="DZD"){ echo "selected";} ?> value="DZD">Algerian dinar</option>
                            <option <?php if($row[10]=="EGP"){ echo "selected";} ?> value="EGP">Egyptian pound</option>
                            <option <?php if($row[10]=="ERN"){ echo "selected";} ?> value="ERN">Eritrean nakfa</option>
                            <option <?php if($row[10]=="ETB"){ echo "selected";} ?> value="ETB">Ethiopian birr</option>
                            <option <?php if($row[10]=="EUR"){ echo "selected";} ?> value="EUR">Euro</option>
                            <option <?php if($row[10]=="FJD"){ echo "selected";} ?> value="FJD">Fijian dollar</option>
                            <option <?php if($row[10]=="FKP"){ echo "selected";} ?> value="FKP">Falkland Islands pound</option>
                            <option <?php if($row[10]=="GBP"){ echo "selected";} ?> value="GBP">British pound</option>
                            <option <?php if($row[10]=="GEL"){ echo "selected";} ?> value="GEL">Georgian lari</option>
                            <option <?php if($row[10]=="GHS"){ echo "selected";} ?> value="GHS">Ghana cedi</option>
                            <option <?php if($row[10]=="GMD"){ echo "selected";} ?> value="GMD">Gambian dalasi</option>
                            <option <?php if($row[10]=="GNF"){ echo "selected";} ?> value="GNF">Guinean franc</option>
                            <option <?php if($row[10]=="GTQ"){ echo "selected";} ?> value="GTQ">Guatemalan quetzal</option>
                            <option <?php if($row[10]=="GYD"){ echo "selected";} ?> value="GYD">Guyanese dollar</option>
                            <option <?php if($row[10]=="HKD"){ echo "selected";} ?> value="HKD">Hong Kong dollar</option>
                            <option <?php if($row[10]=="HNL"){ echo "selected";} ?> value="HNL">Honduran lempira</option>
                            <option <?php if($row[10]=="HRK"){ echo "selected";} ?> value="HRK">Croatian kuna</option>
                            <option <?php if($row[10]=="HTG"){ echo "selected";} ?> value="HTG">Haitian gourde</option>
                            <option <?php if($row[10]=="HUF"){ echo "selected";} ?> value="HUF">Hungarian forint</option>
                            <option <?php if($row[10]=="IDR"){ echo "selected";} ?> value="IDR">Indonesian rupiah</option>
                            <option <?php if($row[10]=="ILS"){ echo "selected";} ?> value="ILS">Israeli new shekel</option>
                            <option <?php if($row[10]=="IMP"){ echo "selected";} ?> value="IMP">Manx pound</option>
                            <option <?php if($row[10]=="INR"){ echo "selected";} ?> value="INR">Indian rupee</option>
                            <option <?php if($row[10]=="IQD"){ echo "selected";} ?> value="IQD">Iraqi dinar</option>
                            <option <?php if($row[10]=="IRR"){ echo "selected";} ?> value="IRR">Iranian rial</option>
                            <option <?php if($row[10]=="ISK"){ echo "selected";} ?> value="ISK">Icelandic króna</option>
                            <option <?php if($row[10]=="JEP"){ echo "selected";} ?> value="JEP">Jersey pound</option>
                            <option <?php if($row[10]=="JMD"){ echo "selected";} ?> value="JMD">Jamaican dollar</option>
                            <option <?php if($row[10]=="JOD"){ echo "selected";} ?> value="JOD">Jordanian dinar</option>
                            <option <?php if($row[10]=="JPY"){ echo "selected";} ?> value="JPY">Japanese yen</option>
                            <option <?php if($row[10]=="KES"){ echo "selected";} ?> value="KES">Kenyan shilling</option>
                            <option <?php if($row[10]=="KGS"){ echo "selected";} ?> value="KGS">Kyrgyzstani som</option>
                            <option <?php if($row[10]=="KHR"){ echo "selected";} ?> value="KHR">Cambodian riel</option>
                            <option <?php if($row[10]=="KMF"){ echo "selected";} ?> value="KMF">Comorian franc</option>
                            <option <?php if($row[10]=="KPW"){ echo "selected";} ?> value="KPW">North Korean won</option>
                            <option <?php if($row[10]=="KRW"){ echo "selected";} ?> value="KRW">South Korean won</option>
                            <option <?php if($row[10]=="KWD"){ echo "selected";} ?> value="KWD">Kuwaiti dinar</option>
                            <option <?php if($row[10]=="KYD"){ echo "selected";} ?> value="KYD">Cayman Islands dollar</option>
                            <option <?php if($row[10]=="KZT"){ echo "selected";} ?> value="KZT">Kazakhstani tenge</option>
                            <option <?php if($row[10]=="LAK"){ echo "selected";} ?> value="LAK">Lao kip</option>
                            <option <?php if($row[10]=="LBP"){ echo "selected";} ?> value="LBP">Lebanese pound</option>
                            <option <?php if($row[10]=="LKR"){ echo "selected";} ?> value="LKR">Sri Lankan rupee</option>
                            <option <?php if($row[10]=="LRD"){ echo "selected";} ?> value="LRD">Liberian dollar</option>
                            <option <?php if($row[10]=="LSL"){ echo "selected";} ?> value="LSL">Lesotho loti</option>
                            <option <?php if($row[10]=="LTL"){ echo "selected";} ?> value="LTL">Lithuanian litas</option>
                            <option <?php if($row[10]=="LVL"){ echo "selected";} ?> value="LVL">Latvian lats</option>
                            <option <?php if($row[10]=="LYD"){ echo "selected";} ?> value="LYD">Libyan dinar</option>
                            <option <?php if($row[10]=="MAD"){ echo "selected";} ?> value="MAD">Moroccan dirham</option>
                            <option <?php if($row[10]=="MDL"){ echo "selected";} ?> value="MDL">Moldovan leu</option>
                            <option <?php if($row[10]=="MGA"){ echo "selected";} ?> value="MGA">Malagasy ariary</option>
                            <option <?php if($row[10]=="MKD"){ echo "selected";} ?> value="MKD">Macedonian denar</option>
                            <option <?php if($row[10]=="MMK"){ echo "selected";} ?> value="MMK">Burmese kyat</option>
                            <option <?php if($row[10]=="MNT"){ echo "selected";} ?> value="MNT">Mongolian tögrög</option>
                            <option <?php if($row[10]=="MOP"){ echo "selected";} ?> value="MOP">Macanese pataca</option>
                            <option <?php if($row[10]=="MRO"){ echo "selected";} ?> value="MRO">Mauritanian ouguiya</option>
                            <option <?php if($row[10]=="MUR"){ echo "selected";} ?> value="MUR">Mauritian rupee</option>
                            <option <?php if($row[10]=="MVR"){ echo "selected";} ?> value="MVR">Maldivian rufiyaa</option>
                            <option <?php if($row[10]=="MWK"){ echo "selected";} ?> value="MWK">Malawian kwacha</option>
                            <option <?php if($row[10]=="MXN"){ echo "selected";} ?> value="MXN">Mexican peso</option>
                            <option <?php if($row[10]=="MYR"){ echo "selected";} ?> value="MYR">Malaysian ringgit</option>
                            <option <?php if($row[10]=="MZN"){ echo "selected";} ?> value="MZN">Mozambican metical</option>
                            <option <?php if($row[10]=="NAD"){ echo "selected";} ?> value="NAD">Namibian dollar</option>
                            <option <?php if($row[10]=="NGN"){ echo "selected";} ?> value="NGN">Nigerian naira</option>
                            <option <?php if($row[10]=="NIO"){ echo "selected";} ?> value="NIO">Nicaraguan córdoba</option>
                            <option <?php if($row[10]=="NOK"){ echo "selected";} ?> value="NOK">Norwegian krone</option>
                            <option <?php if($row[10]=="NPR"){ echo "selected";} ?> value="NPR">Nepalese rupee</option>
                            <option <?php if($row[10]=="NZD"){ echo "selected";} ?> value="NZD">New Zealand dollar</option>
                            <option <?php if($row[10]=="OMR"){ echo "selected";} ?> value="OMR">Omani rial</option>
                            <option <?php if($row[10]=="PAB"){ echo "selected";} ?> value="PAB">Panamanian balboa</option>
                            <option <?php if($row[10]=="PEN"){ echo "selected";} ?> value="PEN">Peruvian nuevo sol</option>
                            <option <?php if($row[10]=="PGK"){ echo "selected";} ?> value="PGK">Papua New Guinean kina</option>
                            <option <?php if($row[10]=="PHP"){ echo "selected";} ?> value="PHP">Philippine peso</option>
                            <option <?php if($row[10]=="PKR"){ echo "selected";} ?> value="PKR">Pakistani rupee</option>
                            <option <?php if($row[10]=="PLN"){ echo "selected";} ?> value="PLN">Polish złoty</option>
                            <option <?php if($row[10]=="PRB"){ echo "selected";} ?> value="PRB">Transnistrian ruble</option>
                            <option <?php if($row[10]=="PYG"){ echo "selected";} ?> value="PYG">Paraguayan guaraní</option>
                            <option <?php if($row[10]=="QAR"){ echo "selected";} ?> value="QAR">Qatari riyal</option>
                            <option <?php if($row[10]=="RON"){ echo "selected";} ?> value="RON">Romanian leu</option>
                            <option <?php if($row[10]=="RSD"){ echo "selected";} ?> value="RSD">Serbian dinar</option>
                            <option <?php if($row[10]=="RUB"){ echo "selected";} ?> value="RUB">Russian ruble</option>
                            <option <?php if($row[10]=="RWF"){ echo "selected";} ?> value="RWF">Rwandan franc</option>
                            <option <?php if($row[10]=="SAR"){ echo "selected";} ?> value="SAR">Saudi riyal</option>
                            <option <?php if($row[10]=="SBD"){ echo "selected";} ?> value="SBD">Solomon Islands dollar</option>
                            <option <?php if($row[10]=="SCR"){ echo "selected";} ?> value="SCR">Seychellois rupee</option>
                            <option <?php if($row[10]=="SDG"){ echo "selected";} ?> value="SDG">Singapore dollar</option>
                            <option <?php if($row[10]=="SEK"){ echo "selected";} ?> value="SEK">Swedish krona</option>
                            <option <?php if($row[10]=="SGD"){ echo "selected";} ?> value="SGD">Singapore dollar</option>
                            <option <?php if($row[10]=="SHP"){ echo "selected";} ?> value="SHP">Saint Helena pound</option>
                            <option <?php if($row[10]=="SLL"){ echo "selected";} ?> value="SLL">Sierra Leonean leone</option>
                            <option <?php if($row[10]=="SOS"){ echo "selected";} ?> value="SOS">Somali shilling</option>
                            <option <?php if($row[10]=="SRD"){ echo "selected";} ?> value="SRD">Surinamese dollar</option>
                            <option <?php if($row[10]=="SSP"){ echo "selected";} ?> value="SSP">South Sudanese pound</option>
                            <option <?php if($row[10]=="STD"){ echo "selected";} ?> value="STD">São Tomé and Príncipe dobra</option>
                            <option <?php if($row[10]=="SVC"){ echo "selected";} ?> value="SVC">Salvadoran colón</option>
                            <option <?php if($row[10]=="SYP"){ echo "selected";} ?> value="SYP">Syrian pound</option>
                            <option <?php if($row[10]=="SZL"){ echo "selected";} ?> value="SZL">Swazi lilangeni</option>
                            <option <?php if($row[10]=="THB"){ echo "selected";} ?> value="THB">Thai baht</option>
                            <option <?php if($row[10]=="TJS"){ echo "selected";} ?> value="TJS">Tajikistani somoni</option>
                            <option <?php if($row[10]=="TMT"){ echo "selected";} ?> value="TMT">Turkmenistan manat</option>
                            <option <?php if($row[10]=="TND"){ echo "selected";} ?> value="TND">Tunisian dinar</option>
                            <option <?php if($row[10]=="TOP"){ echo "selected";} ?> value="TOP">Tongan paʻanga</option>
                            <option <?php if($row[10]=="TRY"){ echo "selected";} ?> value="TRY">Turkish lira</option>
                            <option <?php if($row[10]=="TTD"){ echo "selected";} ?> value="TTD">Trinidad and Tobago dollar</option>
                            <option <?php if($row[10]=="TWD"){ echo "selected";} ?> value="TWD">New Taiwan dollar</option>
                            <option <?php if($row[10]=="TZS"){ echo "selected";} ?> value="TZS">Tanzanian shilling</option>
                            <option <?php if($row[10]=="UAH"){ echo "selected";} ?> value="UAH">Ukrainian hryvnia</option>
                            <option <?php if($row[10]=="UGX"){ echo "selected";} ?> value="UGX">Ugandan shilling</option>
                            <option <?php if($row[10]=="USD"){ echo "selected";} ?> value="USD">United States dollar</option>
                            <option <?php if($row[10]=="UYU"){ echo "selected";} ?> value="UYU">Uruguayan peso</option>
                            <option <?php if($row[10]=="UZS"){ echo "selected";} ?> value="UZS">Uzbekistani som</option>
                            <option <?php if($row[10]=="VEF"){ echo "selected";} ?> value="VEF">Venezuelan bolívar</option>
                            <option <?php if($row[10]=="VND"){ echo "selected";} ?> value="VND">Vietnamese đồng</option>
                            <option <?php if($row[10]=="VUV"){ echo "selected";} ?> value="VUV">Vanuatu vatu</option>
                            <option <?php if($row[10]=="WST"){ echo "selected";} ?> value="WST">Samoan tālā</option>
                            <option <?php if($row[10]=="XAF"){ echo "selected";} ?> value="XAF">Central African CFA franc</option>
                            <option <?php if($row[10]=="XCD"){ echo "selected";} ?> value="XCD">East Caribbean dollar</option>
                            <option <?php if($row[10]=="XOF"){ echo "selected";} ?> value="XOF">West African CFA franc</option>
                            <option <?php if($row[10]=="XPF"){ echo "selected";} ?> value="XPF">CFP franc</option>
                            <option <?php if($row[10]=="YER"){ echo "selected";} ?> value="YER">Yemeni rial</option>
                            <option <?php if($row[10]=="ZAR"){ echo "selected";} ?> value="ZAR">South African rand</option>
                            <option <?php if($row[10]=="ZMW"){ echo "selected";} ?> value="ZMW">Zambian kwacha</option>
                            <option <?php if($row[10]=="ZWL"){ echo "selected";} ?> value="ZWL">Zimbabwean dollar</option>
                          </select>

                        </div>

                      </div>
                       <div class="form-group">
                          <button type="submit" class="btn btn-success btn-block" name="btn_continue" value="modificar">Modificar Empresa</button>

						   <?php
							if($row_permiso["pag_codigo"]=="PAG-10008"){
								echo '<a href="dashboard.php" class="btn btn-info btn-block ">Cancelar</a>' ;
							}else{
                          ?>
						  <a href="dashboard.php?m=<?php echo base64_encode("module/empresa.php"); ?>&pagid=<?php echo base64_encode("PAG-10009"); ?>" class="btn btn-info btn-block ">Cancelar</a>
						   <?php } ?>
                       </div>
                    </div>


              </form>
          </div>

        </div>
      </div>
      <div class="col-lg-2"></div>

    </div>
  </div>

</div>
