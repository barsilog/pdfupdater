<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>TELESCOOP ONLINE LOAN FORMS</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>

  <?php

  $options = [
    'FSDL_SR' => 'Financial Service Development Loan (FSDL SR)',
    'MPL' => 'Multi Purpose Loan (MPL)',
    'PLDT' => 'Financial Loan Form (PLDT)',
    'SUBS' => 'Financial Loan Form (Subsidiaries & Affiliates)',
    'DS' => 'Direct Selling'
  ];

  echo "<div class='container-fluid p-0'  >";
  echo "<div class='jumbotron jumbotron-fluid p-md-5 text-dark rounded bg-info '";
  echo "<div class='card flex-md-row mb-4 box-shadow h-md-250'> ";
  echo "<h1>Loan Application Forms</h1>";
  echo form_open('/pforms/generatepdf');

  ?>
  <div class="form-group">
    <label class ='mdb-main-label'>Select a form to download</label>
    <?php echo form_dropdown('selectedfile', $options,"" ,'class="searchable=\"Search here..\"');   ?>
    <small id="emailHelp" class="form-text text-gray ">NOTE: Each downloaded form contains unique control number. Download a new form if you wish to apply for new loan</small>
  </div>

  <?php echo form_submit('submit', 'Download', 'class="btn btn-primary"');  ?>
  </form>
  </div>
  </div>
</body>

</html>