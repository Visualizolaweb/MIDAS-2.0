<?php

  require_once("../conf.ini.php");
  require_once("../model/class/clientes.class.php");
  require_once("../model/class/agenda.class.php");
  require_once("../model/class/planes.class.php");
  require_once("validosession.controller.php");

  $accion = $_REQUEST["btn_continue"];

  switch($accion){

    case "react":

    $cli_codigo      = $_REQUEST["uid"];

    try{
      Gestion_Clientes::Reactivar($cli_codigo);

      $alert_type = base64_encode("alert-success");
      $alert_msn  = base64_encode("<strong>Perfecto!</strong> la cuenta se ha activado nuevamente ".$pcon_fechafin);

    }catch(Exception $e){

      require_once("exceptions.controller.php");

      $alert_type = base64_encode("alert-danger");
      $alert_msn  = $exception_e;

      //Almacenamos el error en el log del sistema

      error($e->getMessage(),$e->getFile(),$e->getLine());
    }

        $pagina = "UEFHLTEwMDAy&cli=".base64_encode($cli_codigo);
        $pagina2 = base64_encode("module/clientes_editar.php");

    break;


    case "cancelar_plan":

    $cli_codigo      = $_REQUEST["txt_cli_codigo"];
    $pcan_motivo     = $_REQUEST["txt_motivos"];
    $tra_fechacre    = $hoy;
    $tra_autor       = $_usu_nombre." ".$_usu_apellido_1;

    try{
      Gestion_Clientes::Cancelar($cli_codigo, $pcan_motivo, $tra_fechacre, $tra_autor);

      $alert_type = base64_encode("alert-success");
      $alert_msn  = base64_encode("<strong>Perfecto!</strong> el plan se cancelo correctamente ".$pcon_fechafin);

    }catch(Exception $e){

      require_once("exceptions.controller.php");

      $alert_type = base64_encode("alert-danger");
      $alert_msn  = $exception_e;

      //Almacenamos el error en el log del sistema

      error($e->getMessage(),$e->getFile(),$e->getLine());
    }

        $pagina = "UEFHLTEwMDAy&cli=".base64_encode($cli_codigo);
        $pagina2 = base64_encode("module/clientes_editar.php");

    break;

    case "traslado":

    $cli_codigo      = $_REQUEST["txt_cli_codigo"];
    $tra_laborigen   = $_REQUEST["misede"];
    $tra_labdestino  = $_REQUEST["nuevasede"];
    $tra_motivos     = $_REQUEST["txt_motivos"];
    $tra_estado      = "SIN APROBAR";
    $tra_autor       = $_usu_nombre." ".$_usu_apellido_1;
    $tra_fechacre    = $hoy;

    try{
      Gestion_Clientes::Traslado($cli_codigo, $tra_laborigen, $tra_labdestino, $tra_motivos, $tra_estado, $tra_autor, $tra_fechacre);

      $alert_type = base64_encode("alert-success");
      $alert_msn  = base64_encode("<strong>Perfecto!</strong> el traslado se ha solicitado, cuando este aprobado se enviará un correo al cliente ");

    }catch(Exception $e){

      require_once("exceptions.controller.php");

      $alert_type = base64_encode("alert-danger");
      $alert_msn  = $exception_e;

      //Almacenamos el error en el log del sistema

      error($e->getMessage(),$e->getFile(),$e->getLine());
    }

    $pagina = "UEFHLTEwMDAy&cli=".base64_encode($cli_codigo);
    $pagina2 = base64_encode("module/clientes_editar.php");

    break;

    case "congelar_plan":
    $cli_codigo     = $_REQUEST["txt_cli_codigo"];
    $pcon_fechaini  = $_REQUEST["txt_fech_ini"];
    $pcon_fechafin  = $_REQUEST["txt_fech_fin"];
    $pcon_motivos   = $_REQUEST["txt_motivos"];
    $pcon_autor     = $_usu_nombre." ".$_usu_apellido_1;
    $pcon_fechacre  = $hoy;

    try{
      Gestion_Clientes::Congelar($cli_codigo, $pcon_fechaini, $pcon_fechafin, $pcon_motivos, $pcon_autor, $pcon_fechacre);

      $alert_type = base64_encode("alert-success");
      $alert_msn  = base64_encode("<strong>Perfecto!</strong> tu cuenta se congelo hasta la fecha ".$pcon_fechafin);

    }catch(Exception $e){

      require_once("exceptions.controller.php");

      $alert_type = base64_encode("alert-danger");
      $alert_msn  = $exception_e;

      //Almacenamos el error en el log del sistema

      error($e->getMessage(),$e->getFile(),$e->getLine());
    }

    $pagina = "UEFHLTEwMDAy&cli=".base64_encode($cli_codigo);
    $pagina2 = base64_encode("module/clientes_editar.php");

    break;

    case "guardar":

    $cli_codigo                 = $_REQUEST["txt_cli_codigo"];
    $cli_tipo_identificacion    = $_REQUEST["txt_cli_tipo_identificacion"];
    $cli_identificacion         = $_REQUEST["txt_cli_identificacion"];
    $cli_nombre                 = $_REQUEST["txt_cli_nombre"];
    $cli_apellido               = $_REQUEST["txt_cli_apellido"];
    $cli_sexo                   = $_REQUEST["txt_cli_sexo"];
    $cli_fecha_nac              = $_REQUEST["txt_cli_fecha_nac"];
    $cli_telefono               = $_REQUEST["txt_cli_telefono"];
    $cli_celular                = $_REQUEST["txt_cli_celular"];
    $cli_email                  = $_REQUEST["txt_cli_email"];
    $cli_direccion              = $_REQUEST["txt_cli_direccion"];
    $cli_ciudad                 = $_REQUEST["txt_cli_ciudad"];
    $cli_pais                   = $_REQUEST["txt_cli_pais"];
    $cli_departamento           = $_REQUEST["txt_cli_dpto"];
    $cli_sede                   = $_usu_sed_codigo;
    $cli_referido               = $_REQUEST["txt_cli_referido"];
    $autor                      = $_usu_nombre." ".$_usu_apellido_1;
    $cli_foto                   =  "../FotoCliente/".$cli_identificacion.".jpg";
    $cli_eps                    = $_REQUEST["txt_cli_eps"];
    $cli_tipousuario            = "Fijo";
    @$cli_historia              = $_REQUEST["historia"];


    $img = $_REQUEST['mifoto'];

    if(($img != null) || ($img != "")){
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $success = file_put_contents($cli_foto, $data);
    }else{
        $cli_foto = "../FotoCliente/no-foto.jpg";
    }


    if(!isset($cli_plan)){
      $cli_plan = "PLA-06146";
      $colorcita = "#94d60a";
    }


      $planes = Gestion_Planes::ReadbyID($cli_plan);
        try{
          Gestion_Clientes::Create($cli_codigo, $cli_tipo_identificacion, $cli_identificacion, $cli_nombre, $cli_apellido, $cli_sexo, $cli_fecha_nac, $cli_telefono, $cli_celular, $cli_email, $cli_direccion, $cli_ciudad, $cli_sede, $cli_plan, $cli_foto, $cli_referido, $autor, $hoy, $cli_pais, $cli_departamento,  $cli_eps, $cli_historia,$cli_tipousuario,$planes["pla_cupo"]);

          $alert_type = base64_encode("success");
          $alert_msn  = base64_encode("Perfecto! la afiliación se ha guardado correctamente. ");

        }catch(Exception $e){

               require_once("exceptions.controller.php");

               $alert_type = base64_encode("error");
               $alert_msn  = base64_encode($e->getMessage());

               //Almacenamos el error en el log del sistema

               error($e->getMessage(),$e->getFile(),$e->getLine());
        }

        header("location: ../views/default/dashboard.php?m=".base64_encode("module/agenda_reserva.php")."&pagid=".base64_encode("PAG-10003")."&alert=true&alty=$alert_type&almsn=$alert_msn&typ=".base64_encode($cli_plan)."&CID=".base64_encode($cli_codigo)."&NAF=si");
        die();

    break;

    case "modificar":

      $cli_codigo                 = $_REQUEST["txt_cli_codigo"];
      $cli_tipo_identificacion    = $_REQUEST["txt_cli_tipo_identificacion"];
      $cli_identificacion         = $_REQUEST["txt_cli_identificacion"];
      $cli_nombre                 = $_REQUEST["txt_cli_nombre"];
      $cli_apellido               = $_REQUEST["txt_cli_apellido"];
      $cli_sexo                   = $_REQUEST["txt_cli_sexo"];
      $cli_fecha_nac              = $_REQUEST["txt_cli_fecha_nac"];
      $cli_telefono               = $_REQUEST["txt_cli_telefono"];
      $cli_celular                = $_REQUEST["txt_cli_celular"];
      $cli_email                  = $_REQUEST["txt_cli_email"];
      $cli_direccion              = $_REQUEST["txt_cli_direccion"];
      $cli_ciudad                 = $_REQUEST["txt_cli_ciudad"];
      $cli_pais                   = $_REQUEST["txt_cli_pais"];
      $cli_departamento           = $_REQUEST["txt_cli_dpto"];
      $cli_sede                   = $_usu_sed_codigo;
      $cli_referido               = $_REQUEST["txt_cli_referido"];
      $autor                      = $_usu_nombre." ".$_usu_apellido_1;
      $cli_foto                   =  "../FotoCliente/".$cli_identificacion.".jpg";
      $cli_eps                    = $_REQUEST["txt_cli_eps"];
      $cli_tipousuario            = "Fijo";
      @$cli_historia              = $_REQUEST["historia"];


      $img = $_REQUEST['mifoto'];

      $img = str_replace('data:image/png;base64,', '', $img);
      $img = str_replace(' ', '+', $img);
      $data = base64_decode($img);
      $success = file_put_contents($cli_foto, $data);

      if(!isset($cli_plan)){
        $cli_plan = "PLA-06146";
        $colorcita = "#94d60a";
      }


        $planes = Gestion_Planes::ReadbyID($cli_plan);
          try{
            Gestion_Clientes::Update($cli_codigo, $cli_tipo_identificacion, $cli_identificacion, $cli_nombre, $cli_apellido, $cli_sexo, $cli_fecha_nac, $cli_telefono, $cli_celular, $cli_email, $cli_direccion, $cli_ciudad,  $cli_pais, $cli_departamento, $cli_eps, $cli_historia);


            $alert_type = base64_encode("success");
            $alert_msn  = base64_encode("Perfecto! la afiliación se ha modificado correctamente. ");

          }catch(Exception $e){

                 require_once("exceptions.controller.php");

                 $alert_type = base64_encode("error");
                 $alert_msn  = base64_encode($e->getMessage());

                 //Almacenamos el error en el log del sistema

                 error($e->getMessage(),$e->getFile(),$e->getLine());
          }

          header("location: ../views/default/dashboard.php?m=".base64_encode("module/pagina_gestion.php")."&pagid=".base64_encode("PAG-10001")."&alert=true&alty=$alert_type&almsn=$alert_msn&typ=".base64_encode($cli_plan)."&CID=".base64_encode($cli_codigo));
          die();

      break;
    case "consultar":
          try{
          $result = Gestion_Clientes::ReadbyID($cli_codigo);


        }catch(Exception $e){

               require_once("exceptions.controller.php");

               $alert_type = base64_encode("alert-danger");
               $alert_msn  = $exception_e;

               //Almacenamos el error en el log del sistema

               error($e->getMessage(),$e->getFile(),$e->getLine());
        }


    break;

  }

// header("location: ../views/default/dashboard.php?m=".base64_encode("module/pagina_gestion.php")."&pagid=".base64_encode("PAG-100011")."&alert=true&alty=$alert_type&almsn=$alert_msn");
?>
