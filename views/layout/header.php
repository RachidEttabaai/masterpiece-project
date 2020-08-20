<?php

require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

use App\Country\Country;
use App\Summary\Summary;

$countries = new Country("https://api.covid19api.com/countries");

// if ($countries->countCountriesinDB() === 0) {
//     $countries->insertCountriesDatastoDB();
// }

$summary = new Summary("https://api.covid19api.com/summary");
$results = $summary->getSummaryFromAPI();

$uri = trim($_SERVER["REQUEST_URI"], "/");
if ($uri === "data") {
    $pagename = "Data";
} elseif ($uri === "map") {
    $pagename = "Map";
} elseif ($uri === "about") {
    $pagename = "About";
} else {
    $pagename = "Home";
}
?>
<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" 
                  content="width=device-width, initial-scale=1.0, 
                  maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <link rel="stylesheet" 
                  href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" 
                  integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" 
                  crossorigin="anonymous">
            <?php if ($pagename === "Data") : ?>
              <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
            <?php endif; ?>
            <?php if ($pagename === "Map") : ?>
              <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jvectormap/2.0.5/jquery-jvectormap.css"/>
              <style type="text/css">
                  <?php include dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR . "css". DIRECTORY_SEPARATOR . "map.css"?>
              </style>
            <?php endif; ?>      
            <title>COVID19 Dashboard - <?= $pagename ?></title>
        </head>
        <body>
        <header>
            <nav class="navbar navbar-expand-md navbar-dark bg-primary border-bottom">
                <a class="navbar-brand" href="/index">
                    <em class="fa fa-globe" aria-hidden="true"></em>
                    COVID19 Dashboard
                </a>
                <button class="navbar-toggler" 
                        type="button" data-toggle="collapse" 
                        data-target="#sidebarMenu" 
                        aria-controls="sidebarMenu" aria-expanded="false" 
                        aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
            </nav>
        </header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="navbar navbar-expand-md col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="sidebar-sticky pt-4">
        <ul class="nav flex-column text-center">
          <li class="nav-item">
            <a class="nav-link" href="/data">
                Data
                <em class="fa fa-database" aria-hidden="true"></em>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/map">
                Map
                <em class="fa fa-map" aria-hidden="true"></em>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/about">
                About
                <em class="fa fa-info-circle" aria-hidden="true"></em>
            </a>
          </li>
        </ul>
      </div>
    </nav>
