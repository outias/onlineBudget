<!DOCTYPE html>
<html lang="en">

<?php include 'head.php'?>
<body>


  <?= include 'header.php'?>
  <?php include 'navigation.php'?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1><?=$page_title?></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href=<?=site_url('admin')?>>Home</a></li>
          <li class="breadcrumb-item active"><?=$page_name?></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <?php include 'main/'.$page_name.'.php'?>

  </main><!-- End #main -->

  <?php include 'footer.php'?>
  <?php include 'include_bottom.php'?>
  <?php include 'modal.php'?>

</body>

</html>