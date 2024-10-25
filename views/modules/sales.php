<?php

if ($_SESSION["profile"] == "Special") {

  echo '<script>

    window.location = "home";

  </script>';

  return;

}


$xml = ControllerSales::ctrDownloadXML();

if ($xml) {

  rename($_GET["xml"] . ".xml", "xml/" . $_GET["xml"] . ".xml");

  echo '<a class="btn btn-block btn-success openXML" file="xml/' . $_GET["xml"] . '.xml" href="sales">The XML file has been created succesfully<span class="fa fa-times pull-right"></span></a>';

}

?>
<div class="content-wrapper">

  <section class="content-header">

    <h1>
      <!-- Web Engineering Project By 21CS050,21CS072,21CS078 ! -->
      Sales Management

    </h1>



  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <a href="create-sale">
          <button class="btn btn-success">

            <i class="fa fa-plus"></i> Add Sale

          </button>
        </a>


      </div>

      <div class="box-body">
        <!-- Web Engineering Project By 21CS050,21CS072,21CS078 ! -->
        <table class="table table-bordered table-hover table-striped dt-responsive tables" width="100%">

          <thead>

            <tr>

              <th style="width:10px">#</th>
              <th>Bill</th>
              <th>Customer</th>
              <th>Seller</th>
              <th>Payment Method</th>
              <th>Net Cost</th>
              <th>Total Cost</th>
              <th>Date</th>
              <th>Actions</th>

            </tr>

          </thead>

          <tbody>

            <?php

            if (isset($_GET["initialDate"])) {

              $initialDate = $_GET["initialDate"];
              $finalDate = $_GET["finalDate"];

            } else {

              $initialDate = null;
              $finalDate = null;

            }

            $answer = ControllerSales::ctrSalesDatesRange($initialDate, $finalDate);

            foreach ($answer as $key => $value) {


              echo '<td>' . ($key + 1) . '</td>

                  <td>' . $value["code"] . '</td>';

              $itemCustomer = "id";
              $valueCustomer = $value["idCustomer"];

              $customerAnswer = ControllerCustomers::ctrShowCustomers($itemCustomer, $valueCustomer);

              echo '<td>' . $customerAnswer["name"] . '</td>';

              $itemUser = "id";
              $valueUser = $value["idSeller"];

              $userAnswer = ControllerUsers::ctrShowUsers($itemUser, $valueUser);

              echo '<td>' . $userAnswer["name"] . '</td>

                  <td>' . $value["paymentMethod"] . '</td>

                  <td>$ ' . number_format($value["netPrice"], 2) . '</td>

                  <td>$ ' . number_format($value["totalPrice"], 2) . '</td>

                  <td>' . $value["saledate"] . '</td>

                  <td>

                    <div class="btn-group">
                        
                      <div class="btn-group">

                
                

                      </button>';

              if ($_SESSION["profile"] == "Administrator") {

                echo '<button class="btn btn-primary btnEditSale" idSale="' . $value["id"] . '"><i class="fa fa-pencil"></i></button>

                          <button class="btn btn-danger btnDeleteSale" idSale="' . $value["id"] . '"><i class="fa fa-trash"></i></button>';
              }

              echo '</div>  

                  </td>

                </tr>';
            }

            ?>


          </tbody>

        </table>

        <?php

        $deleteSale = new ControllerSales();
        $deleteSale->ctrDeleteSale();

        ?>

      </div>

    </div>
    <!-- Web Engineering Project By 21CS050,21CS072,21CS078 ! -->
  </section>

</div>