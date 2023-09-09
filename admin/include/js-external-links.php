<?php
	 switch ($linksJs) {
	case 1: //root folder
	    ?>

   <!-- Bootstrap core JavaScript-->
   <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/ht-admin-2.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level plugins -->
    <script src="js/demo/datatables-demo.js"></script>
	
	
	<?php
        break;	 	 
    case 2: // admin folder
	    ?> 
		
	<!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/ht-admin-2.min.js"></script>	
	
	   <!-- Page level plugins -->
    <script src="../js/demo/datatables-demo.js"></script>
	
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
    
		  <?php
        break;
    } ?>