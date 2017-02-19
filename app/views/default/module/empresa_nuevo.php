<?php
  Gestion_Menu::View_submenu("inventario", $_usu_per_codigo, $row_paginas[0]);
  $icono = Gestion_Menu::Load_icon($row_paginas[0]);
?>

  <div id="content" class="page_module">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel">
          <header class="panel-heading">
            <h3><strong>CREAR</strong> UNA NUEVA EMPRESA </h3>
          </header>

          <div class="panel-body">
              <form name="frm_create" parsley-validate action="../../controller/crud_empresa.controller.php" method="post">

              <?php

                // Crear el código
                require_once("../../model/class/codigopk.class.php");

                $unique_code = Codigo_PK::GenerarCodigo("emp_codigo","ges_empresa","EMP");

              ?>




                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label">Código</label>
                          <input name="txt_emp_codigo" type="text" class="form-control" readonly value="<?php echo $unique_code;?>">
                        </div>

                        <div class="form-group">
                          <label class="control-label">Nit</label>
                          <input name="txt_emp_nit"  type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                        </div>

                        <div class="form-group">
                          <label class="control-label">Razón Social</label>
                            <input name="txt_emp_razon_social"  type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                        </div>

                        <div class="form-group">
                          <label class="control-label">Representante</label>
                            <input name="txt_emp_representante"  type="text" class="form-control"  parsley-trigger="change">
                        </div>

                        <div class="form-group">
                          <label class="control-label">Pais</label>
                            <input name="txt_emp_pais"  type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                        </div>

                        <div class="form-group">
                          <label class="control-label">Ciudad</label>
                            <input name="txt_emp_ciudad"  type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label">Teléfono </label>
                            <input name="txt_emp_telefono"  type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                        </div>

                        <div class="form-group">
                          <label class="control-label">Dirección   </label>
                            <input name="txt_emp_direccion"  type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                        </div>

                        <div class="form-group">
                          <label class="control-label">Correo Electronico</label>
                            <input name="txt_emp_email"  type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                        </div>

                        <div class="form-group">


                          <label class="control-label">Sitio Web </label><div class="input-group">
                          <span class="input-group-addon">http://</span>
                            <input name="txt_emp_sitioweb" placeholder="www.ejemplo.com" type="text" class="form-control" parsley-trigger="change" parsley-required="true">
                       </div>
                       </div>

                        <div class="form-group">
                          <label class="control-label">Moneda   </label>
                          <select name="txt_emp_moneda" class="form-control bfh-currencies" ><option value="AED">United Arab Emirates dirham</option><option value="AFN">Afghan afghani</option><option value="ALL">Albanian lek</option><option value="AMD">Armenian dram</option><option value="AOA">Angolan kwanza</option><option value="ARS">Argentine peso</option><option value="AUD">Australian dollar</option><option value="AWG">Aruban florin</option><option value="AZN">Azerbaijani manat</option><option value="BAM">Bosnia and Herzegovina convertible mark</option><option value="BBD">Barbadian dollar</option><option value="BDT">Bangladeshi taka</option><option value="BGN">Bulgarian lev</option><option value="BHD">Bahraini dinar</option><option value="BIF">Burundian franc</option><option value="BMD">Bermudian dollar</option><option value="BND">Brunei dollar</option><option value="BOB">Bolivian boliviano</option><option value="BRL">Brazilian real</option><option value="BSD">Bahamian dollar</option><option value="BTN">Bhutanese ngultrum</option><option value="BWP">Botswana pula</option><option value="BYR">Belarusian ruble</option><option value="BZD">Belize dollar</option><option value="CAD">Canadian dollar</option><option value="CDF">Congolese franc</option><option value="CHF">Swiss franc</option><option value="CLP">Chilean peso</option><option value="CNY">Chinese yuan</option><option selected value="COP">Colombian peso</option><option value="CRC">Costa Rican colón</option><option value="CUP">Cuban convertible peso</option><option value="CVE">Cape Verdean escudo</option><option value="CZK">Czech koruna</option><option value="DJF">Djiboutian franc</option><option value="DKK">Danish krone</option><option value="DOP">Dominican peso</option><option value="DZD">Algerian dinar</option><option value="EGP">Egyptian pound</option><option value="ERN">Eritrean nakfa</option><option value="ETB">Ethiopian birr</option><option value="EUR">Euro</option><option value="FJD">Fijian dollar</option><option value="FKP">Falkland Islands pound</option><option value="GBP">British pound</option><option value="GEL">Georgian lari</option><option value="GHS">Ghana cedi</option><option value="GMD">Gambian dalasi</option><option value="GNF">Guinean franc</option><option value="GTQ">Guatemalan quetzal</option><option value="GYD">Guyanese dollar</option><option value="HKD">Hong Kong dollar</option><option value="HNL">Honduran lempira</option><option value="HRK">Croatian kuna</option><option value="HTG">Haitian gourde</option><option value="HUF">Hungarian forint</option><option value="IDR">Indonesian rupiah</option><option value="ILS">Israeli new shekel</option><option value="IMP">Manx pound</option><option value="INR">Indian rupee</option><option value="IQD">Iraqi dinar</option><option value="IRR">Iranian rial</option><option value="ISK">Icelandic króna</option><option value="JEP">Jersey pound</option><option value="JMD">Jamaican dollar</option><option value="JOD">Jordanian dinar</option><option value="JPY">Japanese yen</option><option value="KES">Kenyan shilling</option><option value="KGS">Kyrgyzstani som</option><option value="KHR">Cambodian riel</option><option value="KMF">Comorian franc</option><option value="KPW">North Korean won</option><option value="KRW">South Korean won</option><option value="KWD">Kuwaiti dinar</option><option value="KYD">Cayman Islands dollar</option><option value="KZT">Kazakhstani tenge</option><option value="LAK">Lao kip</option><option value="LBP">Lebanese pound</option><option value="LKR">Sri Lankan rupee</option><option value="LRD">Liberian dollar</option><option value="LSL">Lesotho loti</option><option value="LTL">Lithuanian litas</option><option value="LVL">Latvian lats</option><option value="LYD">Libyan dinar</option><option value="MAD">Moroccan dirham</option><option value="MDL">Moldovan leu</option><option value="MGA">Malagasy ariary</option><option value="MKD">Macedonian denar</option><option value="MMK">Burmese kyat</option><option value="MNT">Mongolian tögrög</option><option value="MOP">Macanese pataca</option><option value="MRO">Mauritanian ouguiya</option><option value="MUR">Mauritian rupee</option><option value="MVR">Maldivian rufiyaa</option><option value="MWK">Malawian kwacha</option><option value="MXN">Mexican peso</option><option value="MYR">Malaysian ringgit</option><option value="MZN">Mozambican metical</option><option value="NAD">Namibian dollar</option><option value="NGN">Nigerian naira</option><option value="NIO">Nicaraguan córdoba</option><option value="NOK">Norwegian krone</option><option value="NPR">Nepalese rupee</option><option value="NZD">New Zealand dollar</option><option value="OMR">Omani rial</option><option value="PAB">Panamanian balboa</option><option value="PEN">Peruvian nuevo sol</option><option value="PGK">Papua New Guinean kina</option><option value="PHP">Philippine peso</option><option value="PKR">Pakistani rupee</option><option value="PLN">Polish złoty</option><option value="PRB">Transnistrian ruble</option><option value="PYG">Paraguayan guaraní</option><option value="QAR">Qatari riyal</option><option value="RON">Romanian leu</option><option value="RSD">Serbian dinar</option><option value="RUB">Russian ruble</option><option value="RWF">Rwandan franc</option><option value="SAR">Saudi riyal</option><option value="SBD">Solomon Islands dollar</option><option value="SCR">Seychellois rupee</option><option value="SDG">Singapore dollar</option><option value="SEK">Swedish krona</option><option value="SGD">Singapore dollar</option><option value="SHP">Saint Helena pound</option><option value="SLL">Sierra Leonean leone</option><option value="SOS">Somali shilling</option><option value="SRD">Surinamese dollar</option><option value="SSP">South Sudanese pound</option><option value="STD">São Tomé and Príncipe dobra</option><option value="SVC">Salvadoran colón</option><option value="SYP">Syrian pound</option><option value="SZL">Swazi lilangeni</option><option value="THB">Thai baht</option><option value="TJS">Tajikistani somoni</option><option value="TMT">Turkmenistan manat</option><option value="TND">Tunisian dinar</option><option value="TOP">Tongan paʻanga</option><option value="TRY">Turkish lira</option><option value="TTD">Trinidad and Tobago dollar</option><option value="TWD">New Taiwan dollar</option><option value="TZS">Tanzanian shilling</option><option value="UAH">Ukrainian hryvnia</option><option value="UGX">Ugandan shilling</option><option value="USD">United States dollar</option><option value="UYU">Uruguayan peso</option><option value="UZS">Uzbekistani som</option><option value="VEF">Venezuelan bolívar</option><option value="VND">Vietnamese đồng</option><option value="VUV">Vanuatu vatu</option><option value="WST">Samoan tālā</option><option value="XAF">Central African CFA franc</option><option value="XCD">East Caribbean dollar</option><option value="XOF">West African CFA franc</option><option value="XPF">CFP franc</option><option value="YER">Yemeni rial</option><option value="ZAR">South African rand</option><option value="ZMW">Zambian kwacha</option><option value="ZWL">Zimbabwean dollar</option></select>

                        </div>

                        <div class="form-group">
                          <div>El registro se va a guardar con la fecha: <span class="label bg-inverse"> <?php echo substr($hoy,0,10); ?></span></div>
                        </div>
                      </div>
                       <div class="form-group">
                          <button type="submit" class="btn btn-primary btn-block" name="btn_continue" value="guardar">Guardar Empresa</button>
                          <a href="dashboard.php?m=<?php echo base64_encode("module/empresa.php"); ?>&pagid=<?php echo base64_encode("PAG-10009"); ?>" class="btn btn-info btn-block ">Cancelar</a>
                       </div>

                  </div>

              </form>
          </div>

        </div>
      </div>


    </div>
  </div>

</div>
