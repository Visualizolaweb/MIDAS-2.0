<div id="main">

  <ol class="breadcrumb">
    <li><a href="dashboard.php">Inicio</a></li>
    <li><a href="dashboard.php?m=bW9kdWxlL3RpZW5kYS5waHA=&pagid=UEFHLTEwMDAxNw==">Gestionar tienda</a></li>
    <li class="active">Renovar plan</li>
  </ol>


  <div id="content" class="page_module">
    <div class="row">
      <div class="col-lg-8 col-lg-offset-2">
        <div class="panel">
          <header class="panel-heading">
            <h3><strong>RENOVAR</strong> PLAN</h3>
          </header>

          <div class="panel-body">
            <form id="frm_create" class="frmcliente"   name="frm_create" parsley-validate  method="post" autocomplete="off" enctype="multipart/form-data">

              <div id="step1">
                   <div class="row">
                     <div class="col-md-6">

                        <div class="form-group">
                          <label class="control-label">Cédula del Afiliado</label>
                          <input name="txt_cli_identificacion" id="nuevo_cli_id"  type="number" class="form-control" parsley-trigger="change" required >

                        </div>


                    </div>

                   <div class="row">
                     <div class="col-md-6">

                       <div class="form-group"><br>
                          <button type="button" class="btn btn-primary btn-block btn-lg" name="btn_continue" id="btn_renuevo1" value="guardar">Continuar <i class="fa fa-arrow-circle-o-right"></i></button>
                       </div>

                     </div>
                  </div>

                  </div>

              </div>

              </form>
              <div id="step2">

              </div>
          </div>

        </div>
      </div>


    </div>
  </div>

</div>
