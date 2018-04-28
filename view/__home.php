<body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Cadastro de Produtos</a>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="#">Sair</a>
            </li>
        </ul>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column" id="menus">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= __PATH__ ?>painel-controle">
                                <span data-feather="home"></span>
                                Inicío <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= __PATH__ ?>painel-controle/cadastro-produtos">
                                <span data-feather="home"></span>
                                Cadastro de Produtos <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= __PATH__ ?>painel-controle/cadastro-categorias">
                                <span data-feather="home"></span>
                                Cadastro de Categorias <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= __PATH__ ?>painel-controle/cadastro-marcas">
                                <span data-feather="home"></span>
                                Cadastro de Marcas <span class="sr-only">(current)</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <?php
                if (isset($param[1])) {
                    switch ($param[1]) {
                        case "":
                            $javaScript = ["home.js"];
                            break;
                        case "cadastro-produtos":
                            include_once './view/__produtos.php';
                            break;
                        case "cadastro-marcas":
                            include_once './view/__marcas.php';
                            break;
                        case "cadastro-categorias":
                            include_once './view/__categorias.php';
                            break;
                        default:
                            $javaScript = ["home.js"];
                            break;
                    }
                } else
                    $javaScript = ["home.js"];
                ?>
            </main>
        </div>
    </div>
</body>