<?php

require_once 'layout' . DIRECTORY_SEPARATOR . "header.php";

?>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 mt-4">
        <div class="jumbotron jumbotron-fluid">
            <div class="container text-center">
                <h1 class="display-4">Data</h1>
            </div>
        </div>

        <div class="container text-center mb-2">
          <div class="row mb-2">
            <div class="col">

              <h2>Global Summary</h2>

                <em class="text-muted">API data updated on <?= date('d/m/Y H:i', time()) ?></em>

                <?php
                $globalresults = $results["Global"];
                $percentconfirmedglobal = round(($globalresults["NewConfirmed"]/$globalresults["TotalConfirmed"])*100, 2);
                $percentdeathglobal = round(($globalresults["NewDeaths"]/$globalresults["TotalDeaths"])*100, 2);
                $percentrecoveredglobal = round(($globalresults["NewRecovered"]/$globalresults["TotalRecovered"])*100, 2);
                ?>

                <ul class="list-group">
                    <li class="list-group-item">
                      Total confirmed : 
                      <strong>
                        <em class="text-warning">
                          <?= $globalresults["TotalConfirmed"] ?>
                          (+<?= $percentconfirmedglobal ?>%)
                        </em>
                      </strong>
                    </li>
                    <li class="list-group-item">
                      New confirmed : 
                      <strong>
                        <em class="text-warning"><?= $globalresults["NewConfirmed"] ?></em>
                      </strong>
                    </li>
                    <li class="list-group-item">
                      Total deaths : 
                      <strong>
                        <em class="text-danger">
                          <?= $globalresults["TotalDeaths"] ?>
                          (+<?= $percentdeathglobal ?>%)
                        </em>
                      </strong>
                    </li>
                    <li class="list-group-item">
                      New deaths : 
                      <strong>
                        <em class="text-danger">
                          <?= $globalresults["NewDeaths"] ?>
                        </em>
                      </strong>
                    </li>
                    <li class="list-group-item">
                      Total recovered : 
                      <strong>
                        <em class="text-success">
                          <?= $globalresults["TotalRecovered"] ?>
                          (+<?= $percentrecoveredglobal ?>%)
                        </em>
                      </strong>
                    </li>
                    <li class="list-group-item">
                      New recovered : 
                      <strong>
                        <em class="text-success"><?= $globalresults["NewRecovered"] ?></em>
                      </strong>
                    </li>
                </ul>
              </div>
    
            </div>

            <div class="row">
              <div class="col">
                <h2>Summary per country</h2>

                <?php $summarypercountryresults = $results["Countries"] ?>

                <em class="text-muted">API data updated on <?= date('d/m/Y H:i', strtotime($summarypercountryresults[0]["Date"])) ?></em>

                <div class="table-responsive">
                  <table id="summarypercountry" class="table display">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Total confirmed</th>
                        <th>New confirmed</th>
                        <th>% of confirmed</th>
                        <th>Total deaths</th>
                        <th>New deaths</th>
                        <th>% of deaths</th>
                        <th>Total recovered</th>
                        <th>New recovered</th>
                        <th>% of recovered</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($summarypercountryresults as $summarypercountryresult) : ?>
                            <?php
                            $percentconfirmedbycountry = round(($summarypercountryresult["NewConfirmed"]/$summarypercountryresult["TotalConfirmed"])*100, 2);
                            $percentdeathbycountry = round(($summarypercountryresult["NewDeaths"]/$summarypercountryresult["TotalDeaths"])*100, 2);
                            $percentrecoveredbycountry = round(($summarypercountryresult["NewRecovered"]/$summarypercountryresult["TotalRecovered"])*100, 2);
                            ?>
                        <tr>
                          <td>
                            <img src="https://www.countryflags.io/<?= $summarypercountryresult["CountryCode"] ?>/flat/32.png"
                                 title="<?= $summarypercountryresult["Country"] ?>">
                            <?= $summarypercountryresult["Country"] ?>
                          </td>
                          <td>
                            <strong>
                              <em class="text-warning">
                                <?= $summarypercountryresult["TotalConfirmed"] ?>
                              </em>
                            </strong>
                          </td>
                          <td>
                            <strong>
                              <em class="text-warning">
                                <?= $summarypercountryresult["NewConfirmed"] ?>
                              </em>
                            </strong>
                          </td>
                          <td>
                            <strong>
                              <em class="text-warning">
                                +<?= $percentconfirmedbycountry ?>%
                              </em>
                            </strong>
                          </td>
                          <td>
                            <strong>
                              <em class="text-danger">
                              <?= $summarypercountryresult["TotalDeaths"] ?>
                              </em>
                            </strong>
                          </td>
                          <td>
                            <strong>
                              <em class="text-danger">
                              <?= $summarypercountryresult["NewDeaths"] ?>
                              </em>
                            </strong>
                          </td>
                          <td>
                            <strong>
                              <em class="text-danger">
                                +<?= $percentdeathbycountry ?>%
                              </em>
                            </strong>
                          </td>
                          <td>
                            <strong>
                              <em class="text-success">
                              <?= $summarypercountryresult["TotalRecovered"] ?>
                              </em>
                            </strong>
                          </td>
                          <td>
                            <strong>
                              <em class="text-success">
                              <?= $summarypercountryresult["NewRecovered"] ?>
                              </em>
                            </strong>
                          </td>
                          <td>
                            <strong>
                              <em class="text-success">
                                +<?= $percentrecoveredbycountry ?>%
                              </em>
                            </strong>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>

                </div>

              </div>

          </div>
    </main>
  </div>
</div>
 
<?php

require_once 'layout' . DIRECTORY_SEPARATOR . "footer.php";