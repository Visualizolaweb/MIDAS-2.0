<?php
require_once 'model/comprobante.model.php';
require_once 'model/producto.model.php';
require_once 'model/cliente.model.php';
require_once 'model/remisiones.model.php';

class ComprobanteController{

    private $model;
    private $pmodel;
    private $cmodel;
    private $rmodel;

    public function __CONSTRUCT(){
        $this->model  = new ComprobanteModel();
        $this->pmodel = new ProductoModel();
        $this->cmodel = new ClienteModel();
        $this->rmodel = new RemisionModel();
    }

    public function Index(){
        require_once 'views/header.php';
        require_once 'views/comprobante/index.php';
        require_once 'views/footer.php';
    }

    public function Crud(){
        require_once 'views/header.php';
        require_once 'views/comprobante/editar.php';
        require_once 'views/footer.php';
    }

    public function facturaplan(){

         $plan    = $_GET["plan"];
         $cliente = $_GET["cliente"];

        require_once 'views/header.php';
        require_once 'views/comprobante/facturaplan.php';
        require_once 'views/footer.php';
    }

    public function Remision(){
        require_once 'views/header.php';
        require_once 'views/comprobante/remisiones.php';
        require_once 'views/footer.php';
    }

    public function Pago(){
        require_once 'views/header.php';
        require_once 'views/comprobante/add_pago.php';
        require_once 'views/footer.php';
    }

    public function Ver(){

        $comprobante = $this->model->Obtener($_REQUEST['id']);

        require_once 'views/header.php';
        require_once 'views/comprobante/ver.php';
        require_once 'views/footer.php';
    }


// METODOS DE ACCION


    public function Guardar(){
        print_r(json_encode( $this->model->Registrar( $_POST ) ));
    }

    public function GuardarFacturaPlan(){
        print_r(json_encode( $this->model->RegistrarfacturaPlan( $_POST ) ));
    }

    public function GuardarPago(){
        print_r(json_encode( $this->model->RegistrarPago( $_POST) ));
    }

    public function GuardarRemision(){
        print_r(json_encode( $this->rmodel->Registrar( $_POST ) ));   
    }











    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['id']);
        header('Location: index.php');
    }

    public function ClienteBuscar()
    {
        print_r(json_encode(
            $this->cmodel->Buscar($_REQUEST['criterio'])
        ));
    }

    public function ProductoBuscar()
    {
        print_r(json_encode(
            $this->pmodel->Buscar($_REQUEST['criterio'])
        ));
    }

    public function Listar()
    {
        print_r($this->model->Listar());
    }
}
