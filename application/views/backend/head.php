<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?=$page_title?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <script
			  src="https://code.jquery.com/jquery-3.7.1.min.js"
			  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
			  crossorigin="anonymous"></script>

  <!-- Favicon -->
  <link href="<?=base_url('uploads/Logo/mindful_logo.png')?>" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  
  <link href="<?=base_url('assets/assets/vendor/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
  <link href="<?=base_url('assets/assets/vendor/bootstrap-icons/bootstrap-icons.css')?>" rel="stylesheet">
  <link href="<?=base_url('assets/assets/vendor/boxicons/css/boxicons.min.css')?>" rel="stylesheet">
  <link href="<?=base_url('assets/assets/vendor/quill/quill.snow.css')?>" rel="stylesheet">
  <link href="<?=base_url('assets/assets/vendor/quill/quill.bubble.css')?>" rel="stylesheet">
  <link href="<?=base_url('assets/assets/vendor/remixicon/remixicon.css')?>" rel="stylesheet">
  <link href="<?=base_url('assets/assets/vendor/simple-datatables/style.css')?>" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?=base_url('assets/assets/css/style.css')?>" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-ez7/ZKnPISd7kR95pcxjcpQ8IqC0xU8lBWT5gPTZaR7Rrl2T9P3jN9ENc9x7CGSF" crossorigin="anonymous">

  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">

  <style>
        body {
          background-color:#F1F1F1;
            background-image: url('<?= base_url('uploads/Images/Background.png') ?>');
            /* Add other background properties as needed */
            /* background-size: cover; */
            background-repeat: no-repeat;
           
            /* Add more styles if necessary */
        }
    </style>
</head>

<?php


$session_id=$this->session->userdata('session_id');
$session_first_name=$this->session->userdata('session_first_name');
$session_last_name=$this->session->userdata('session_last_name');
$session_occupation=$this->session->userdata('session_occupation');

$system=$this->home_model->system();
$contact=$this->home_model->contact();
$userSession=$this->home_model->users($session_id);

?>