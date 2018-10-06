<?php

class Route {

    public static $urls = array();

    public static function SET_URL($fn) {
        $_url = explode("/", filter_input(INPUT_GET, "url"));
        if (filter_input(INPUT_SERVER, "REQUEST_METHOD") == "GET") {
            // aqui puede aver un error ocasionado por el usuario
            // cuando coloque algo como: Home/
            // asi que lo estamos validando desde Routes.php
            foreach ($_url as $url) {
                if (in_array($url, self::$urls)) {
                    $fn->__invoke(filter_input(INPUT_GET, "url"));
                    exit();
                } else {
                    require_once "./App/Views/_shared/start_html.php";
                    require_once "./App/Views/_shared/_error/404.php";
                    require_once "./App/Views/_shared/end_html.php";
                    exit();
                }
            }
        } else if (filter_input(INPUT_SERVER, "REQUEST_METHOD") == "POST") {
            // Uso Input get dentr de POST, solo para recuperar la url que se envia.
            // Se puede usar $_REQUEST pero, quiero evitar las alvertencias
            if (count($_url) > 1) {
                $count = count($_url) - 1;
                self::REQUEST_API_METHOD_POST($_url[$count]);
            } else {
                self::REQUEST_API_METHOD_POST(filter_input(INPUT_GET, "url"));
            }
        }
    }

    private static function REQUEST_API_METHOD_POST($url) {
        switch ($url) {
            case "IniciarSesion":
                self::IniciarSesion();
                break;
            case "CerrarSesion":
                self::CerrarSesion();
                break;
            case "MiInformacionView":
                self::MiInformacionView();
                break;
            case "CambiarMiClaveView":
                self::CambiarMiClaveView();
                break;
            case "CambiarMiClave":
                self::CambiarMiClave();
                break;
            case "OrdenPedidoView":
                self::OrdenPedidoView();
                break;
            case "CarteleraTipoPedido":
                self::CarteleraTipoPedido();
                break;
            // CLIENTE
            case "NuevoCliente":
                self::NuevoCliente();
                break;
            case "CargarClientes":
                self::CargarClientes();
                break;
            case "EditarClienteView":
                self::EditarClienteView();
                break;
            case "EditarCliente":
                self::EditarCliente();
                break;
            case "FiltrarClientes":
                self::FiltrarClientes();
                break;
            // EMPLEADO
            case "NuevoEmpleado":
                self::NuevoEmpleado();
                break;
            case "CargarEmpleados":
                self::CargarEmpleados();
                break;
            case "EditarEmpleadoView":
                self::EditarEmpleadoView();
                break;
            case "EditarEmpleado":
                self::EditarEmpleado();
                break;
            case "FiltrarEmpleados":
                self::FiltrarEmpleados();
                break;
            // PROVEEDOR
            case "NuevoProveedor":
                self::NuevoProveedor();
                break;
            case "CargarProveedores":
                self::CargarProveedores();
                break;
            case "EditarProveedorView":
                self::EditarProveedorView();
                break;
            case "EditarProveedor":
                self::EditarProveedor();
                break;
            case "FiltrarProveedores":
                self::FiltrarProveedores();
                break;

            // PRODUCTO 
            case "NuevoProducto":
                self::NuevoProducto();
                break;
            case "CargarProductos":
                self::CargarProductos();
                break;
            case "EditarProductoView":
                self::EditarProductoView();
                break;
            case "EditarProducto":
                self::EditarProducto();
                break;
            case "FiltrarProductos":
                self::FiltrarProductos();
                break;

            default:
                require_once "./App/Views/_shared/start_html.php";
                require_once "./App/Views/_shared/_error/404.php";
                require_once "./App/Views/_shared/end_html.php";
                break;
        }
    }

    private static function IniciarSesion() {
        $dni = trim(filter_input(INPUT_POST, "dni"));
        $clave = trim(filter_input(INPUT_POST, "clave"));
        EmpleadoController::INICIAR_SESION($dni, $clave);
    }

    private static function CerrarSesion() {
        session_start();
        session_unset();
        session_destroy();
        echo "Se ha cerrado todas las sesiones disponibles.";
    }

    private function MiInformacionView() {
        session_start();
        $cod_empleado = $_SESSION["cod_empleado"];
        $obj = EmpleadoController::BUSCAR_EMPLEADO($cod_empleado, "return");
        require_once './App/Views/Dashboard/Empleado/modal/informacion.php';
    }

    private function CambiarMiClaveView() {
        require_once './App/Views/Dashboard/Empleado/modal/cambiarclave.php';
    }

    private function CambiarMiClave() {
        $clave = filter_input(INPUT_POST, "clave");
        $nueva_clave = filter_input(INPUT_POST, "nueva_clave");
        EmpleadoController::CAMBIAR_CLAVE($clave, $nueva_clave);
    }

    // OrdenPedido by cod_lista_pedido
    private static function OrdenPedidoView() {
        require_once './App/Views/Dashboard/PuntoVenta/modal/ordenPedido.php';
    }

    // Tipo de pago

    private static function CarteleraTipoPedido() {
        require_once './App/Views/Dashboard/TipoPago/modal/cartelera.php';
    }

    // métodos para CLIENTE
    private static function NuevoCliente() {
        $cliente = new Cliente();
        $cliente->setNombre(filter_input(INPUT_POST, "nombre"));
        $cliente->setDireccion(filter_input(INPUT_POST, "direccion"));
        $cliente->setTelefono(filter_input(INPUT_POST, "telefono"));
        ClienteController::CREAR_CLIENTE($cliente);
    }

    private static function CargarClientes() {
        ClienteController::LISTAR_CLIENTES("json");
    }

    private static function EditarClienteView() {
        $cod_cliente = filter_input(INPUT_POST, "cod_cliente");
        ClienteController::BUSCAR_CLIENTE($cod_cliente);
    }

    private static function EditarCliente() {
        $cliente = new Cliente();
        $cliente->setCod_cliente(filter_input(INPUT_POST, "cod_cliente"));
        $cliente->setNombre(filter_input(INPUT_POST, "nombre"));
        $cliente->setDireccion(filter_input(INPUT_POST, "direccion"));
        $cliente->setTelefono(filter_input(INPUT_POST, "telefono"));
        ClienteController::EDITAR_CLIENTE($cliente);
    }

    private static function FiltrarClientes() {
        $nombre = filter_input(INPUT_POST, "nombre");
        ClienteController::FILTRAR_CLIENTES($nombre);
    }

    // métodos para EMPLEADO
    private static function NuevoEmpleado() {
        $empleado = new Empleado();
        $empleado->setNombre(filter_input(INPUT_POST, "nombre"));
        $empleado->setDni(filter_input(INPUT_POST, "dni"));
        $empleado->setClave(filter_input(INPUT_POST, "clave"));
        $empleado->setNivel_usuario(filter_input(INPUT_POST, "nivel_usuario"));
        $empleado->setDireccion(filter_input(INPUT_POST, "direccion"));
        $empleado->setTelefono(filter_input(INPUT_POST, "telefono"));
        $empleado->setSueldo_base(filter_input(INPUT_POST, "sueldo_base"));
        EmpleadoController::CREAR_EMPLEADO($empleado);
    }

    private static function CargarEmpleados() {
        EmpleadoController::LISTAR_EMPLEADOS("json");
    }

    private static function EditarEmpleadoView() {
        $cod_empleado = filter_input(INPUT_POST, "cod_empleado");
        EmpleadoController::BUSCAR_EMPLEADO($cod_empleado);
    }

    private static function EditarEmpleado() {
        $empleado = new Empleado();
        $empleado->setCod_empleado(filter_input(INPUT_POST, "cod_empleado"));
        $empleado->setNombre(filter_input(INPUT_POST, "nombre"));
        $empleado->setDni(filter_input(INPUT_POST, "dni"));
        $empleado->setDireccion(filter_input(INPUT_POST, "direccion"));
        $empleado->setTelefono(filter_input(INPUT_POST, "telefono"));
        EmpleadoController::EDITAR_EMPLEADO($empleado);
    }

    private static function FiltrarEmpleados() {
        $nombre = filter_input(INPUT_POST, "nombre");
        $dni = filter_input(INPUT_POST, "dni");
        EmpleadoController::FILTRAR_EMPLEADOS($nombre, $dni);
    }

    // métodos para PROVEEDOR
    private static function NuevoProveedor() {
        $proveedor = new Proveedor();
        $proveedor->setNombre(filter_input(INPUT_POST, "nombre"));
        $proveedor->setDireccion(filter_input(INPUT_POST, "direccion"));
        $proveedor->setPagina_web(filter_input(INPUT_POST, "pagina_web"));
        $proveedor->setTelefono(filter_input(INPUT_POST, "telefono"));
        ProveedorController::CREAR_PROVEEDOR($proveedor);
    }

    private static function CargarProveedores() {
        ProveedorController::LISTAR_PROVEEDORES("json");
    }

    private static function EditarProveedorView() {
        $cod_proveedor = filter_input(INPUT_POST, "cod_proveedor");
        ProveedorController::BUSCAR_PROVEEDOR($cod_proveedor);
    }

    private static function EditarProveedor() {
        $proveedor = new Proveedor();
        $proveedor->setCod_proveedor(filter_input(INPUT_POST, "cod_proveedor"));
        $proveedor->setNombre(filter_input(INPUT_POST, "nombre"));
        $proveedor->setDireccion(filter_input(INPUT_POST, "direccion"));
        $proveedor->setPagina_web(filter_input(INPUT_POST, "pagina_web"));
        $proveedor->setTelefono(filter_input(INPUT_POST, "telefono"));
        ProveedorController::EDITAR_PROVEEDOR($proveedor);
    }

    private static function FiltrarProveedores() {
        $nombre = filter_input(INPUT_POST, "nombre");
        ProveedorController::FILTRAR_PROVEEDORES($nombre);
    }

    // métodos para PRODUCTOS
    private static function NuevoProducto() {
        $nombre_azar = self::generar_String_aleatorio();
        $extension = (new SplFileInfo($_FILES["rutaImagen"]["name"]))->getExtension();

        $producto = new Producto();
        $producto->setCod_referencia(filter_input(INPUT_POST, "cod_referencia"));
        $producto->setNombre_producto(filter_input(INPUT_POST, "nombre_producto"));
        $producto->setDescripcion(filter_input(INPUT_POST, "descripcion"));
        $producto->setStock(filter_input(INPUT_POST, "stock"));
        $producto->setPrecio(filter_input(INPUT_POST, "precio"));
        $producto->setFecha_vencimiento(filter_input(INPUT_POST, "fecha_vencimiento"));
        $producto->setRutaImagen("producto-" . $nombre_azar . "." . $extension);
        $producto->setCod_proveedor(filter_input(INPUT_POST, "cod_proveedor"));

        $msg = trim(ProductoController::CREAR_PRODUCTO($producto));

        if ($msg == "Registro completo con exito.") {
            move_uploaded_file($_FILES["rutaImagen"]["tmp_name"], "./Resources/img/productos/" . $producto->getRutaImagen());
        }

        echo $msg;
    }

    private static function CargarProductos() {
        ProductoController::LISTAR_PRODUCTOS("json");
    }

    private static function EditarProductoView() {
        $cod_producto = filter_input(INPUT_POST, "cod_producto");
        ProductoController::BUSCAR_PRODUCTO($cod_producto);
    }

    private static function EditarProducto() {
        $nombre_azar = self::generar_String_aleatorio();
        $extension = (new SplFileInfo($_FILES["rutaImagen"]["name"]))->getExtension();

        $producto = new Producto();
        $producto->setCod_producto(filter_input(INPUT_POST, "cod_producto"));
        $producto->setCod_referencia(filter_input(INPUT_POST, "cod_referencia"));
        $producto->setNombre_producto(filter_input(INPUT_POST, "nombre_producto"));
        $producto->setDescripcion(filter_input(INPUT_POST, "descripcion"));
        $producto->setStock(filter_input(INPUT_POST, "stock"));
        $producto->setPrecio(filter_input(INPUT_POST, "precio"));
        $producto->setFecha_vencimiento(filter_input(INPUT_POST, "fecha_vencimiento"));
        $producto->setRutaImagen("producto-" . $nombre_azar . $extension);
        $producto->setCod_proveedor(filter_input(INPUT_POST, "cod_proveedor"));


        $obj = ProductoController::BUSCAR_PRODUCTO($producto->getCod_producto(), "return");

        $msg = trim(ProductoController::EDITAR_PRODUCTO($producto));

        if ($msg == "Registro editado con exito.") {
            @unlink("./Resources/img/productos/" . $obj->rutaImagen);

            move_uploaded_file($_FILES["rutaImagen"]["tmp_name"], "./Resources/img/productos/" . $producto->getRutaImagen());
        }

        echo $msg;
    }

    private static function FiltrarProductos() {
        $cod_referencia = filter_input(INPUT_POST, "cod_referencia");
        $nombre_producto = filter_input(INPUT_POST, "nombre_producto");
        ProductoController::FILTRAR_PRODUCTOS($cod_referencia, $nombre_producto);
    }

    // METODO PARA GENERAR UNA CADENA AL AZAR
    private static function generar_String_aleatorio($length = 50) {
        return substr(str_shuffle(time() . "0123456789abcdefghijklmnopqrst" . time() . "uvwxyzABCDEFGHIJKLMNOPQRST" . time() . "UVWXYZ"), 0, $length);
    }

}
