<?php ob_start(); 
    include 'cek.php';
    
    if($_SESSION['username']){

?>
<?php include 'includes/koneksi.php'; ?>
<?php 
    include 'includes/funtion.php'; 
    error_reporting();
?>

<?php require 'includes/header_start.php'; ?>
<!--Morris Chart CSS -->
    <link href="assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css" rel="stylesheet"/>
    <link href="assets/plugins/multiselect/css/multi-select.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="assets/plugins/morris/morris.css">
    <!-- DataTables -->
    <link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
    <!-- Responsive datatable examples -->
    <link href="assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    <link href="assets/plugins/mjolnic-bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="assets/plugins/clockpicker/bootstrap-clockpicker.min.css" rel="stylesheet">
    <link href="assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/plugins/jquery.steps/demo/css/jquery.steps.css" />
    <script src="assets/js/modernizr.min.js"></script>
    <script type="text/javascript" src="page/jquery.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("select[name='pelanggan']").on("change",function(){
                var pelanggans = {"nosambungan":$(this).val()};
                $.ajax({
                    url:"page/controller.php",
                    type:"post",
                    data:{pelanggans:pelanggans},
                    success:function(result){
                        var value = result.split(",");

                        $("input[name='nama']").val(value[0]);
                        $("input[name='nomorktp']").val(value[1]);
                        $("input[name='kodegol']").val(value[2]);
                        $("input[name='alamat']").val(value[3]);
                        $("input[name='no_hp']").val(value[4]);
                        $("input[name='lalu']").val(value[5]);
                    }
                })
            })

            $("select[name='bayar']").on("change",function(){
                var bills = {"nosambungan":$(this).val()};
                $.ajax({
                    url:"page/controller.php",
                    type:"post",
                    data:{bills:bills},
                    success:function(result){
                        var value = result.split(",");

                        $("input[name='batas']").val(value[0]);
                        $("input[name='pakai']").val(value[1]);
                        $("input[name='boaya']").val(parseFloat(value[2]).toFixed(2));
                        $("input[name='prev']").val(value[3]);
                        $("input[name='pres']").val(value[4]);
                        $("input[name='savings']").val(value[5]);
                        $("input[name='nosa']").val(value[6]);
                        var d = new Date();
                        var strDate = d.getFullYear() + "-" + d.getMonth() + "-" + d.getDate();
                        if( (new Date(value[0]).getTime() < new Date(strDate).getTime())){
                            <?php
                                $query  = mysql_query("Select * from readingvalue where id='30' ");
                                $row    = mysql_fetch_assoc($query);
                                $penal  = $row['value'];
                            ?>
                            urdenda     = <?php echo $penal; ?>;
                            totdenda    = parseFloat(urdenda);
                            $("input[name='denda']").val(totdenda.toFixed(2));
                            totalboaya  = parseFloat(value[2])+totdenda;
                            $("input[name='total']").val(totalboaya.toFixed(2));
                        }
                        else{
                            $("input[name='total']").val(parseFloat(value[2]).toFixed(2));
                        }
                    }
                });
            });

            $("#buttonLoad,#saveBill,#savePayment,#saveInst").on("click",function(){
                $(this).button('loading');           
            });

            $('.dropdown input,#new,#new2').click(function(e) {
                e.stopPropagation();
            });
            
            $('input[name="perPelanggan"]').on("click",function(){
                id=$("select[name='nosambungan']").val().split("-")[0];
                window.open('page/lappelanggan.php?nosambungan=true&id='+id,'','width=800,height=500');
            });

            $('input[name="perBulan"]').on("click",function(){
                window.open('page/monthly.php?start='+$("input[name='start']").val()+'&end='+$("input[name='end']").val(),'','width=800,height=500');
            })
            $('input[name="perBulan2"]').on("click",function(){
                window.open('page/monthly2.php?start='+$("input[name='start']").val()+'&end='+$("input[name='end']").val(),'','width=800,height=500');
            })
            $('#install-ok').on("click",function(){
                window.open('page/installok.php','','width=800,height=500');
            })
            $('#install-not').on("click",function(){
                window.open('page/installnot.php','','width=800,height=500');
            })
            $('#daily-reports').on("click",function(){
                window.open('daily.php','','width=800,height=500');
            })
            $('#due-reports').on("click",function(){
                window.open('due.php','','width=800,height=500');
            })

            $("#new").click(function(){
                $("#go2").slideDown("slow");
                $("#go").slideUp("slow");
            })
            
            $( ".datepicker" ).datepicker({
                dateFormat: "yy-mm-dd",
                changeMonth: true,
                changeYear: true                
            });

            $("#new2").click(function(){
                $("#go").slideDown("slow");
                $("#go2").slideUp("slow");
            });

            
        });
        

    </script>

<?php require 'includes/header_end.php'; ?>


<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            
        <?php
            $pages_dir='page';
            if(!empty($_GET['p'])) {
                $page = scandir($pages_dir, 0);
                unset($page[0], $page[1]);

                $p = $_GET['p'];
                if(in_array($p.'.php', $page)) {
                    include($pages_dir.'/'.$p.'.php');
                } else {
                    include('404.php');
                }
            } else {
                include($pages_dir.'/home.php');
            } 
        ?>
            


        </div> <!-- container -->

    </div> <!-- content -->


</div>
<!-- End content-page -->


<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->


<?php require 'includes/footer_start.php' ?>

<!--Morris Chart-->
<script src="assets/plugins/morris/morris.min.js"></script>
<script src="assets/plugins/raphael/raphael-min.js"></script>


<!-- Required datatable js -->
    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
    <script src="assets/plugins/datatables/jszip.min.js"></script>
    <script src="assets/plugins/datatables/pdfmake.min.js"></script>
    <script src="assets/plugins/datatables/vfs_fonts.js"></script>
    <script src="assets/plugins/datatables/buttons.html5.min.js"></script>
    <script src="assets/plugins/datatables/buttons.print.min.js"></script>
    <script src="assets/plugins/datatables/buttons.colVis.min.js"></script>
     <script src="assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.js"></script>

    <script type="text/javascript" src="assets/plugins/jquery-quicksearch/jquery.quicksearch.js"></script>
    <script src="assets/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>

    <!-- Autocomplete -->
    
    <script type="text/javascript" src="assets/pages/jquery.formadvanced.init.js"></script>

    <!-- Responsive examples -->
    <script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="assets/plugins/datatables/responsive.bootstrap4.min.js"></script>
     <!-- Validation js (Parsleyjs) -->
    <script type="text/javascript" src="assets/plugins/parsleyjs/parsley.min.js"></script>
    <script src="assets/plugins/moment/moment.js"></script>
    <script src="assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="assets/plugins/mjolnic-bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="assets/plugins/clockpicker/bootstrap-clockpicker.js"></script>
    <script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="files/ui-lightness/jquery-ui-1.8.13.custom.css">
    <link rel="stylesheet" type="text/css" href="files/jquery.ui.datepicker.css">
    <script src="assets/pages/jquery.form-pickers.init.js"></script>
    <script src="assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
    <script src="assets/plugins/autoNumeric/autoNumeric.js" type="text/javascript"></script>
     <!--Form Wizard-->
    <script src="assets/plugins/jquery.steps/build/jquery.steps.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>

    <!--wizard initialization-->
    <script src="assets/pages/jquery.wizard-init.js" type="text/javascript"></script>
    <script type="text/javascript" src="files/jquery.ui.datepicker.js" ></script>
    <script type="text/javascript" src="files/jquery-ui-1.8.16.custom.js" ></script>
    <script type="text/javascript">
      jQuery(function($) {
          $('.autonumber').autoNumeric('init');
      });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#datatable').DataTable();

            //Buttons examples
            var table = $('#datatable-buttons').DataTable({
                lengthChange: false,
                buttons: ['copy', 'excel', 'pdf', 'colvis']
            });

            table.buttons().container()
                .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

            $('form').parsley();
        });

    </script>                

<!-- Page specific js -->
<script src="assets/pages/jquery.dashboard.js"></script>

<?php require 'includes/footer_end.php' ?>
<?php } else   {
    header('location:login.php');
}
?>
