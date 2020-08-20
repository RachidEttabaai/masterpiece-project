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
          $res = $results["Countries"];
        ?>

        <div id="templates">
            <?php foreach($res as $r) : ?>
              <template tid="map-legend" id="<?= $r["CountryCode"] ?>" class="d-block mx-auto rounded">
                <div class="col mx-auto">
                <img class="flag-icon h4 d-block mx-auto rounded" src="https://www.countryflags.io/<?= $r["CountryCode"] ?>/flat/32.png" title="<?= $r["Country"] ?>" />
                  <div>
                    <span class="h5"><?= $r["Country"] ?></span>
                    <p><em class="text-muted"><?= date('d/m/Y H:i', strtotime($r["Date"])) ?></em></p>
                  </div>
                  <table>
                    <tbody>
                      <tr>
                        <td>Total Confirmed</td>
                        <td><span class="text-warning"><?= $r["TotalConfirmed"] ?></span></td>
                      </tr>
                      <tr>
                        <td>New Confirmed</td>
                        <td><span class="text-warning"><?= $r["NewConfirmed"] ?></span></td>
                      </tr>
                      <tr>
                        <td>Total Deceased</td>
                        <td><span class="text-danger"><?= $r["TotalDeaths"] ?></span></td>
                      </tr>
                      <tr>
                        <td>New Deceased</td>
                        <td><span class="text-danger"><?= $r["NewDeaths"] ?></span></td>
                      </tr>
                      <tr>
                        <td>Total Recovered</td>
                        <td><span class="text-success"><?= $r["TotalRecovered"] ?></span></td>
                      </tr>
                      <tr>
                        <td>New Recovered</td>
                        <td><span class="text-success"><?= $r["NewRecovered"] ?></span></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </template>
            <?php endforeach; ?>
        </div>

        <div class="map-container">
            <div id="world-map-markers" class="jvmap-smart"></div>
        </div>

      </div>
      
    </main>
  </div>
</div>
 
<?php

require_once 'layout' . DIRECTORY_SEPARATOR . "footer.php";