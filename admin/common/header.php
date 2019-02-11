<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo CLIENT_NAME; ?></title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">

<!-- Bootstrap Validator css -->
<link rel="stylesheet" href="dist/css/bootstrapValidator.min.css">

<!-- Font Awesome -->
<link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
 
<!-- DataTables List Products page only-->
<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<!-- bootstrap datepicker add purchase only -->
<link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

<!-- daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">

<!-- Select2 Products Add page only-->
 <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">

<!-- Theme style -->
<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
<!-- AdminLTE Skins. We have chosen the skin-blue for this starter
	page. However, you can choose any other skin. Make sure you
	apply the skin class to the body tag so the changes take effect. -->
<link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<style type="text/css">
	.table-striped > tbody > tr:nth-child(2n+1) > td, 
	.table-striped > tbody > tr:nth-child(2n+1) > th {
   		background-color: #d6e7f142;
}
</style>

<style>
                     .rating {
                     display: inline-block;
                     position: relative;
                     height: 50px;
                         line-height: 35px;
						font-size: 35px;
                     }
                     .rating label {
                     position: absolute;
                     top: 0;
                     left: 0;
                     height: 100%;
                     cursor: pointer;
                     }
                     .rating label:last-child {
                     position: static;
                     }
                     .rating label:nth-child(1) {
                     z-index: 5;
                     }
                     .rating label:nth-child(2) {
                     z-index: 4;
                     }
                     .rating label:nth-child(3) {
                     z-index: 3;
                     }
                     .rating label:nth-child(4) {
                     z-index: 2;
                     }
                     .rating label:nth-child(5) {
                     z-index: 1;
                     }
                     .rating label input {
                     position: absolute;
                     top: 0;
                     left: 0;
                     opacity: 0;
                     }
                     .rating label .icon {
                     float: left;
                     color: transparent;
                     }
                     .rating label:last-child .icon {
                     color: #337ab7;
                     }
                     .rating:not(:hover) label input:checked ~ .icon,
                     .rating:hover label:hover input ~ .icon {
                     color: #1fe812fa;
                     }
                     .rating label input:focus:not(:checked) ~ .icon:last-child {
                     color: #337ab7;
                     text-shadow: 0 0 5px #09f;
                     }
                  </style>