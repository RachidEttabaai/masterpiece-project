<?php

require_once 'layout' . DIRECTORY_SEPARATOR . "header.php";

?>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 mt-4">
      <div class="jumbotron jumbotron-fluid">
        <div class="container text-center">
          <h1 class="display-4">Map</h1>
        </div>
      </div>

      <div class="container text-center mb-2">

        <?php
          // echo "<pre>";
          // print_r($results["Countries"]);
          // echo "</pre>"; 
        ?>
        
        <form id="map_form" class="mb-4" >
          <select class="custom-select" id="select_country">
            <option value="none">Choose a country</option>
            <?php foreach ($listcountries as $country) : ?>
              <option value="<?= $country["latitude"]." ".$country["longitude"] ?>">
                <?= $country["country_name"] ?>
              </option>
            <?php endforeach; ?>
          </select>
        </form>

        <div class="map-container">
            <div id="world-map-markers" class="jvmap-smart"></div>
        </div>

      </div>
      
    </main>
  </div>
</div>
 
<?php

require_once 'layout' . DIRECTORY_SEPARATOR . "footer.php";