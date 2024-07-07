<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" type="image/x-icon" href="/images/logo_azul_sem_texto.png">

    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css" />

    <link href="/css/styles.css" rel="stylesheet" />

    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script>
        function randColor() {
            return "#" + Math.floor(Math.random() * 16777215).toString(16).padStart(6, '0').toUpperCase();
        }
    </script>

    <script src="https://js.stripe.com/v3/"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="{{ route('dashboard') }}"><img src="/images/logo_branco_com_texto.png"
                class="logo-menu"></a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" method="get"
            action="{{ route('filter') }}">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="fiter for..." aria-label="fiter for..."
                    aria-describedby="btnNavbarFilter" id="periodo" name="periodo" />
                {{-- <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button> --}}
                <button class="btn btn-primary">Filtrar</button>
            </div>
        </form>
        <script>
            window.addEventListener("load", function(event) {
                const data_de = Date.parse("{{ getDataDe()->format('Y/m/d') }}");
                const data_ate = Date.parse("{{ getDataAte()->format('Y/m/d') }}");

                const picker = new Litepicker({
                    element: document.getElementById('periodo'),
                    singleMode: false,
                    // allowRepick: true,
                    plugins: ['ranges'],
                    format: 'DD/MM/YYYY',
                    startDate: data_de,
                    endDate: data_ate,
                    numberOfMonths: 2,
                    numberOfColumns: 2,
                    autoApply: false
                    // showOn: 'both',
                });
            }, false);
        </script>
        {{-- <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form> --}}
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false"><i
                        class="fas fa-user fa-fw"></i>{{ Auth::user()->name }}</a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="{{ route('settings.edit') }}">Settings</a></li>
                    <li><a class="dropdown-item" href="{{ route('sync.index') }}">Sincronização</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    {{-- <li><a class="dropdown-item" href="#!">Sair</a></li> --}}
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item">Sair</button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Dashboard</div>
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>

                        <div class="sb-sidenav-menu-heading">Módulos</div>

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseFaturamento" aria-expanded="false"
                            aria-controls="collapseFaturamento">
                            <div class="sb-nav-link-icon"><i class="fas fa-dollar-sign"></i></div>
                            Faturamento
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseFaturamento" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                {{-- <a class="nav-link" href="{{route('vendas.index')}}">Nota fiscal</a>     --}}
                                <a class="nav-link" href="{{ route('faturamento.pedidos-venda') }}">Pedidos de
                                    Venda</a>
                                <a class="nav-link" href="{{ route('faturamento.canais-venda') }}">Canais de Venda</a>
                            </nav>
                        </div>

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseEstoque" aria-expanded="false" aria-controls="collapseEstoque">
                            <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                            Estoque
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseEstoque" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('estoque.saldos-armazem') }}">Saldo por
                                    Armazém</a>
                                <a class="nav-link" href="{{ route('estoque.produtos-vendidos') }}">Produtos
                                    Vendidos</a>
                                <a class="nav-link" href="{{ route('estoque.produtos-sem-vendas') }}">Produtos Sem
                                    Vendas</a>
                                <a class="nav-link" href="{{ route('estoque.recomendacao-compra') }}">Recomendação de
                                    Compra</a>
                            </nav>
                        </div>

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseClientes" aria-expanded="false"
                            aria-controls="collapseClientes">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Clientes
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseClientes" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('cliente.lista-clientes') }}">Lista de
                                    Clientes</a>
                            </nav>
                        </div>

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseLogistica" aria-expanded="false"
                            aria-controls="collapseLogistica">
                            <div class="sb-nav-link-icon"><i class="fas fa-truck"></i></div>
                            Logistica
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLogistica" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('logistica.entregas') }}">Entregas</a>
                            </nav>
                        </div>

                        <div class="sb-sidenav-menu-heading">Marketplace</div>

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseMercadoLivre" aria-expanded="false"
                            aria-controls="collapseMercadoLivre">
                            <div class="sb-nav-link-icon"><i class="fas fa-truck"></i></div>
                            Mercado Livre
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseMercadoLivre" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('anuncios-favoritos.index') }}">Anúncios
                                    Favoritos</a>
                            </nav>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            {{-- <main style="background-color: #f8f9fa"> --}}
            <main>
                <div class="container-fluid px-4">
                    {{-- <h1 class="mt-4">ADICIONAR OS FILTROS</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">adicionar os filtros</li>
                        </ol> --}}

                    @if (session('success'))
                        <br />
                        <div class="row">
                            <div class="alert alert-success">{{ session('success') }}</div>
                        </div>
                    @endif

                    @if (session('error'))
                        <br />
                        <div class="row">
                            <div class="alert alert-danger ">{{ session('error') }}</div>
                        </div>
                    @endif

                    {{ $slot }}
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="/js/scripts.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="assets/demo/chart-pie-demo.js"></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    {{-- <script src="js/datatables-simple-demo.js"></script> --}}

    {{-- <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/nocss/litepicker.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js"></script>
</body>

</html>
