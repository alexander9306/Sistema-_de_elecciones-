<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Mesa Electoral</title>
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  
  <!-- Bootstrap core CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
 
  <!-- Material Design Bootstrap -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/css/mdb.min.css" rel="stylesheet">
  
  <!-- Custom styles for this template -->
  <link href="https://blackrockdigital.github.io/startbootstrap-blog-home/css/blog-home.css" rel="stylesheet">
  <!-- MDBootstrap Datatables  -->
  <link href="https://raw.githubusercontent.com/mdbootstrap/bootstrap-material-design/master/css/addons/datatables.min.css" rel="stylesheet">
  <!-- Bostrap Select css-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="<?= base_url() ?>">Mesa Electoral</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link " href="<?= base_url() ?>"><i class="fas fa-home"></i>Inicio
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="<?= base_url('votacion') ?>"><i class="fas fa-person-booth"></i>Casilla de Votacion</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="<?= base_url('electoral') ?>"><i class="fas fa-toolbox"></i>Mesa Electoral</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="<?= base_url('configuracion/padronjce') ?>"><i class="fas fa-tools"></i>Configuracion</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container" style="min-height: 70rem;">