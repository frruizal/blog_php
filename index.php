<?php
function hayValorEnArray($array, $key)
{
    return array_key_exists($key, $array);
}
function hayValorGet($key): bool
{
    return hayValorEnArray($_GET, $key);
}
function getValorGet($key, $defautl = "")
{
    return (hayValorGet($key) ? $_GET[$key] : $defautl);
}
function hayValorPost($key): bool
{
    return hayValorEnArray($_POST, $key);
}
function getValorPost($key, $defautl = "")
{
    return (hayValorPost($key) ? $_POST[$key] : $defautl);
}
function isUserLogged(): bool
{
    return array_key_exists("username", $_SESSION) && $_SESSION["username"] !== "";
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once "config.php";
require_once  DOCUMENT_ROOT . 'repositorio/conector.php';
require_once  DOCUMENT_ROOT . 'repositorio/categoriasRepositorio.php';
require_once  DOCUMENT_ROOT . 'repositorio/noticiasRepositorio.php';
require_once  DOCUMENT_ROOT . 'repositorio/usuarioRepository.php';

$con = new Conector();

$username = $_SESSION["username"] ?? "";
$pageParam = (array_key_exists("p", $_GET) ? $_GET["p"] : "home");

//login
if ($pageParam == "login") {
    if (array_key_exists("btnLogin", $_POST)) {
        $user = $_POST["username"] ?? "";
        $password = $_POST["password"] ?? "";
        $usuarioRepositorio = new UsuarioRepository($con);
        if ($usuarioRepositorio->compruebaLogin($user, $password)) {
            $_SESSION["username"] = $user;
            $usuarioRepositorio->saveLastConecction($user);

            header("Location: index.php?p=home"); //redirigimos a la portada
        } else {
            header("Location: index.php?p=error"); //redirigimos a la pag de error

        }
    }
    //logout
} else if ($pageParam == "logout") {
    $_SESSION["username"] = null;
    $_SESSION["username"] = "";
    unset($_SESSION["username"]);

    session_unset();
    session_destroy();
    header("Location: index.php?p=home"); //redirigimos a la portada
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Index de ejemplo</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="estilos.css">

</head>

<body>
    <header id="header">
        <?php include './cabecera.php'; ?>
    </header>
    <div id="wrapper" class="wrap_cnt">
        <div id="barralateral">
            <?php include './menu_lateral.php'; ?>
        </div>

        <main id="content">
            <?php
            $filtrosNoticia = [];

            $idCat = $_GET["cat"] ?? "";
            if ($idCat != "") {
                $filtrosNoticia["idCategoria"] = $idCat;
            }

            $filtrosCat = [];

            $idCat2 = $_GET["cat"] ?? "";
            if ($idCat2 != "") {
                $filtrosCat["id"] = $idCat2;
            }

            $nPage = $_GET["page"] ?? 1;

            $nRegPerPage = 5;

            $categoriasRepositorio = new CategoriasRepositorio($con);
            $noticiasRepositorio = new NoticiasRepositorio($con);

            $totalNoticias =  $noticiasRepositorio->getCount($filtrosNoticia);
            $nTotalNoticias = ceil($totalNoticias / $nRegPerPage);
            $lstNoticias = $noticiasRepositorio->getAllByField($filtrosNoticia, $nPage, $nRegPerPage);

            $totalRegistros = $categoriasRepositorio->getCount($filtrosCat);
            $nTotalPaginas = ceil($totalRegistros / $nRegPerPage);
            $lstCategorias = $categoriasRepositorio->getAllByField($filtrosCat, $nPage, $nRegPerPage);

            $lstCategoriasActivas = $categoriasRepositorio->getAllByField(["activo" => 1], 0);
            $arr = array();
            foreach ($lstCategoriasActivas as $cat) {
                $arr[$cat["id"]] = $cat;
            }
            $lstCategoriasActivas = $arr;


            //Home
            if ($pageParam == "home") {
                if ($idCat == "Todas") {
                    header("Location: index.php");
                    exit();
                }

                $arrNoticias = $noticiasRepositorio->getAllByField($filtrosNoticia, $nPage, $nRegPerPage);
                include "./home.php";

                //Contacto
            } else if ($pageParam == "contacto") { ?>
                <div class="contacto">
                    <?php include "./contacto.php";
                    ?>
                </div>
            <?php
            } else if ($pageParam == "enviar_fichero") { ?>
                <?php include "./enviar_fichero.php";
                ?>

            <?php
            } else if ($pageParam == "error") { ?>
                <h1>Error al introducir usuario o contraseña</h1>
            <?php

                //Noticias
            } else if ($pageParam == "noticias") {
                $accion = $_GET["accion"] ?? "listar";
                $id = $_GET["id"] ?? 0;
                //eliminar noticia
                if ($accion == "eliminar") {
                    $noticiasRepositorio->deleteGenerico($id);
                    //editar noticia
                } else if ($accion == "editar") {
                    $noticia = null;
                    if ($id != 0) {
                        $noticia = $noticiasRepositorio->getByIdGenerico($id);
                    }
                    if ($noticia == null) {
                        $noticia = ["titulo" => "", "titulo" => "", "idCategoria" => 1, "autor" => "", "contenido" => "", "fechaPublicacion" => "",];
                    }
                    if (hayValorPost("btnSave")) {
                        //.... obtener valores de post
                        $noticia = new Noticia(
                            0,
                            getValorPost("titulo", $noticia["titulo"]),
                            getValorPost("contenido", $noticia["contenido"]),
                            getValorPost("autor", $noticia["autor"]),
                            getValorPost("fechaPublicacion", $noticia["fechaPublicacion"]),

                        );
                        $cat = $lstCategoriasActivas[getValorPost("idCategoria")] ?? null;
                        $cat = new Categoria($cat["id"], $cat["nombre"], $cat["activo"]);
                        $noticia->setCategoria($cat);
                        // $noticia = ["titulo" => getValorPost("titulo", $noticia["titulo"]), "idCategoria" => getValorPost("idCategoria", $noticia["idCategoria"]), "contenido" => getValorPost("contenido", $noticia["contenido"]), "autor" => getValorPost("autor", $noticia["autor"]), "fechaPublicacion" => getValorPost("fechaPublicacion", $noticia["fechaPublicacion"])];
                        if ($noticiasRepositorio->save($noticia, $id)) {
                            header("Location: index.php?p=noticias&page=1");
                            exit();
                        }
                    }
                    //crear noticia
                } else if ($accion == "crear") {
                    $noticia = null;
                    if (hayValorPost("btnSave")) {
                        //.... obtener valores de post
                        $noticia = new Noticia(
                            0,
                            getValorPost("titulo", $noticia["titulo"]),
                            getValorPost("contenido", $noticia["contenido"]),
                            getValorPost("autor", $noticia["autor"]),
                            getValorPost("fechaPublicacion", $noticia["fechaPublicacion"]),
                        );
                        $cat = $lstCategoriasActivas[getValorPost("idCategoria")] ?? null;
                        $cat = new Categoria($cat["id"], $cat["nombre"], $cat["activo"]);
                        $noticia->setCategoria($cat);
                        //$noticia = ["id" => getValorPost("id", $noticia["id"]), "titulo" => getValorPost("titulo", $noticia["titulo"]), "idCategoria" => getValorPost("idCategoria", $noticia["idCategoria"]), "contenido" => getValorPost("contenido", $noticia["contenido"]), "autor" => getValorPost("autor", $noticia["autor"]), "fechaPublicacion" => getValorPost("fechaPublicacion", $noticia["fechaPublicacion"])];
                        if ($noticiasRepositorio->save($noticia, $id)) {
                            header("Location: index.php?p=noticias&page=1");
                            exit();
                        }
                    }
                }
                include "./noticias.php";
                //Categorias
            } else if ($pageParam == "categorias") {

                $accion = $_GET["accion"] ?? "listar";
                $id = $_GET["id"] ?? 0;
                //eliminar categoria
                if ($accion == "eliminar") {
                    $categoriasRepositorio->deleteGenerico($id);
                    //editar categoria
                } else if ($accion == "editar") {
                    $categoria = null;
                    if ($id != 0) {
                        $categoria = $categoriasRepositorio->getByIdGenerico($id);
                    }
                    if ($categoria == null) {
                        $categoria = ["nombre" => "", "activo" => 1];
                    }
                    if (hayValorPost("btnSave")) {
                        //.... obtener valores de post
                        $categoria = new Categoria(0, getValorPost("nombre", $categoria["nombre"]), hayValorPost("activo") ? 1 : 0);
                        //$categoria = ["activo" => hayValorPost("activo") ? 1 : 0,  "nombre" => getValorPost("nombre", $categoria["nombre"])];
                        if ($categoriasRepositorio->save($categoria, $id)) {
                            header("Location: index.php?p=categorias");
                            exit();
                        }
                    }
                    //Crear categoria
                } else if ($accion == "crear") {
                    $categoria = null;
                    if (hayValorPost("btnSave")) {
                        //.... obtener valores de post
                        //$categoria = ["nombre"=>"", "activo"=>1];
                        //$categoria = ["id" => getValorPost("id", $categoria["id"]), "activo" => hayValorPost("activo") ? 1 : 0,  "nombre" => getValorPost("nombre", $categoria["nombre"])];
                        $categoria = new Categoria(0, getValorPost("nombre", $categoria["nombre"]), hayValorPost("activo") ? 1 : 0);
                        if ($categoriasRepositorio->save($categoria, $id)) {
                            header("Location: index.php?p=categorias");
                            exit();
                        }
                    }
                }
                include "./categorias.php";
            }
            //mysqli_close($con);
            $con = null;
            ?>
        </main>
    </div>
    <div id="footer">
        <?php include './footer.php'; ?>
    </div>

</body>

</html>