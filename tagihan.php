<script type="text/javascript" src="page/jquery.js"></script>
<script type="text/javascript">   
    $(document).ready(function(){
        $('#pelanggan').on('change',function(){
            nosambungan = $(this).val();
        });

        $('#btnAdd').on('click',function(){
            $('#billForm').slideToggle();
            $('#mode').val('new');
            var currentTime = new Date();
            var month       = currentTime.getMonth() + 1;
            var day         = currentTime.getDate();
            var year        = currentTime.getFullYear();
            $('#dicatat1').val(year + "-" + month + "-" + day);
            $('#batas').val(year + "-" + (month+1) + "-" + day);
            <?php 
               $query = mysql_query("SELECT * FROM tagihan order by notagihan DESC limit 1");
               if(mysql_num_rows($query) == 0){
                  $notagihan = 0;
               }
               else{
                  $row = mysql_fetch_assoc($query);
                  $notagihan = $row['notagihan'];
               }
            ?>
            billId = "<?php echo $notagihan+1; ?>";
            var num = 5 - billId.length;
            var con = "";
            if(num != 0){
               for(i = 0; i < num; i++){
                  con = con+"0";
               }
            }

            $('#idTagihan').val(con+billId);
         });

        $('#kini').on('change',function(){

            kini = $('#kini').val(); 
            prev = $('#lalu').val();
            gol  = $('#kodegol').val();
            pakai = kini-prev;
            if (gol == 'S1') {
                if(pakai >= 1){
                    billR = pakai*parseFloat($("#a0").val());
                }
            }
            if (gol == 'S2') {
                if(pakai >= 1){
                    billR = pakai*parseFloat($("#a1").val());
                }
            }
            if (gol == 'RT1') {
                if(pakai <= 10){
                    billR = pakai*parseFloat($("#a2").val());
                }
                if(pakai > 10 ){
                    billR = ((10)*parseFloat($("#a2").val()))+((pakai-10)*parseFloat($("#a3").val()));
                }
            }
            if (gol == 'RT2') {
                if(pakai <= 10){
                    billR = pakai*parseFloat($("#a4").val());
                }
                if(pakai > 10 ){
                    billR = ((10)*parseFloat($("#a4").val()))+((pakai-10)*parseFloat($("#a5").val()));
                }
            }
            if (gol == 'RT3') {
                if(pakai <= 10){
                    billR = pakai*parseFloat($("#a6").val());
                }
                if(pakai > 10 ){
                    billR = ((10)*parseFloat($("#a6").val()))+((pakai-10)*parseFloat($("#a7").val()));
                }
            }
            if (gol == 'RT4') {
                if(pakai <= 10){
                    billR = pakai*parseFloat($("#a8").val());
                }
                if(pakai > 10 ){
                    billR = ((10)*parseFloat($("#a8").val()))+((pakai-10)*parseFloat($("#a9").val()));
                }
            }
            if (gol == 'RT5') {
                if(pakai <= 10){
                    billR = pakai*parseFloat($("#a10").val());
                }
                if(pakai > 10 ){
                    billR = ((10)*parseFloat($("#a10").val()))+((pakai-10)*parseFloat($("#a11").val()));
                }
            }
            if (gol == 'RT6') {
                if(pakai <= 10){
                    billR = pakai*parseFloat($("#a12").val());
                }
                if(pakai > 10 ){
                    billR = ((10)*parseFloat($("#a12").val()))+((pakai-10)*parseFloat($("#a13").val()));
                }
            }
            if (gol == 'KK') {
                if(pakai <= 10){
                    billR = pakai*parseFloat($("#a14").val());
                }
                if(pakai > 10 ){
                    billR = ((10)*parseFloat($("#a14").val()))+((pakai-10)*parseFloat($("#a15").val()));
                }
            }
            if (gol == 'IP') {
                if(pakai <= 10){
                    billR = pakai*parseFloat($("#a16").val());
                }
                if(pakai > 10 ){
                    billR = ((10)*parseFloat($("#a16").val()))+((pakai-10)*parseFloat($("#a17").val()));
                }                
            }
            if (gol == 'N1') {
                if(pakai <= 10){
                    billR = pakai*parseFloat($("#a18").val());
                }
                if(pakai > 10 ){
                    billR = ((10)*parseFloat($("#a18").val()))+((pakai-10)*parseFloat($("#a19").val()));
                }                
            }

            if (gol == 'N2') {
                if(pakai <= 10){
                    billR = pakai*parseFloat($("#a20").val());
                }
                if(pakai > 10 ){
                    billR = ((10)*parseFloat($("#a20").val()))+((pakai-10)*parseFloat($("#a21").val()));
                }                
            }
            if (gol == 'N3') {
                if(pakai <= 10){
                    billR = pakai*parseFloat($("#a22").val());
                }
                if(pakai > 10 ){
                    billR = ((10)*parseFloat($("#a22").val()))+((pakai-10)*parseFloat($("#a23").val()));
                }                
            }
            if (gol == 'IN1') {
                if(pakai <= 10){
                    billR = pakai*parseFloat($("#a24").val());
                }
                if(pakai > 10 ){
                    billR = ((10)*parseFloat($("#a24").val()))+((pakai-10)*parseFloat($("#a25").val()));
                }                
            }
            if (gol == 'IN2') {
                if(pakai <= 10){
                    billR = pakai*parseFloat($("#a26").val());
                }
                if(pakai > 10 ){
                    billR = ((10)*parseFloat($("#26").val()))+((pakai-10)*parseFloat($("#a27").val()));
                }                
            }
            if (gol == 'NK') {
                if(pakai >= 1){
                    billR = pakai*parseFloat($("#a28").val());
                }               
            }
            
            total = billR+3000;
            $('#pemakaian').val(pakai);
            $('#harga').val(billR.toFixed(2));
            $('#totalBiaya').val(total.toFixed(2));
            
         });
        
    });
</script> 
<?php
    $e=0;
    $bill = mysql_query("Select * from readingvalue ");
    $nums       =     mysql_num_rows($bill); 
    if($nums!=0){
        while($row = mysql_fetch_assoc($bill)){
            echo "<input type='hidden' name='aa".$e."' id='a".$e."' value='".$row['value']."'>";
            echo "<input type='hidden'  name='aa".$e."' id='a".$e."' value='".$row['kodegol']."'>";
            $e++;
        }
    }       
                          
?>

                 <div class="row">
                    <div class="col-xs-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Tagihan</h4>
                            <ol class="breadcrumb p-0">
                                <li>
                                    <a href="#">Dashboard</a>
                                </li>
                                <li class="active">
                                    tagihan 
                                </li>
                            </ol>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="row">
                
                                                    
                    <div class="col-xs-12">
                        <div class="card-box" >
                            <form name="frm" method="post" action="?p=controller" id="basic-form">
                                <input type="button" class="btn btn-primary" id="btnAdd" value="ADD">
<?php  
                $sql_sms = "Select no_hp from pelanggan where nosambungan='$_POST[pelanggan]' ";
                $array_sms = mysql_query($sql_sms) or die(mysql_error());
                $rows = mysql_fetch_assoc($array_sms);
                $nomor_hp = $rows['no_hp'];
                $userkey = "csymkg";
                $passkey = "grace95";
                $nohp = "$nomor_hp";
                $message = "Tagihan air periode '$_POST[dicatat1]' adalah sebesar '$_POST[totalBiaya]'. silahkan melakukan pembayaran sebelum  '$_POST[batas]'. Terima Kasih.";
                $curlHandle = curl_init();
                curl_setopt($curlHandle, CURLOPT_URL, $url);
                curl_setopt($curlHandle, CURLOPT_POSTFIELDS, 'userkey='.$userkey.'&passkey='.$passkey.'&nohp='.$cellPhone.'&pesan='.urlencode($message));
                curl_setopt($curlHandle, CURLOPT_HEADER, 0);
                curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
                curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
                curl_setopt($curlHandle, CURLOPT_POST, 1);
                $results = curl_exec($curlHandle);
                curl_close($curlHandle);
?>                                
                                <div id="billForm" style="display:none">
                                    <h3>Detil Informasi Pelanggan</h3>
                                    <section>
                                     
                                    <input type="hidden" name="idTagihan" id="idTagihan">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-5">
                                                <div class="form-group clearfix">
                                                    <label for="nosambungan"> No Meteran<span class="text-danger">*</span></label>
                                                    <div>

                                                        <select name="pelanggan" class="required form-control select2" id="pelanggan" required>
                                                            <?php
                                          
                                                            $nosambungan = mysql_query("select *
                                                                from pelanggan where status='1'");
                                                            $nums        = mysql_num_rows($nosambungan); 
                                                            if($nums!=0){
                                                                echo "<option>Select</option>";
                                                            while($rows=mysql_fetch_assoc($nosambungan)){
                                                            ?>
                                                            <option><?php echo $rows["nosambungan"];?></option>
                                                            <?php
                                                                        }
                                                                  }
                                                            ?>   
                                                        </select>
                                                                                                       
                                                       
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-6">
                                                <div class="form-group clearfix">
                                                    <label for="nama"> Nama<span class="text-danger">*</span></label>
                                                    <div>
                                                        <input id="nama" name="nama" type="text" class="form-control" required >

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="form-group clearfix">
                                                    <label for="kodegol">No KTP<span class="text-danger">*</span></label>
                                                    <div>
                                                        <input id="nomorktp" name="nomorktp" type="text" class="required email form-control" readonly>
                                                    </div>
                                                 </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="form-group clearfix">
                                                    <label for="kodegol">Golongan<span class="text-danger">*</span></label>
                                                    <div>
                                                        <input id="kodegol" name="kodegol" type="text" class="required email form-control" readonly>
                                                    </div>
                                                 </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="form-group clearfix">
                                                    <label for="kodegol">Alamat<span class="text-danger">*</span></label>
                                                    <div>
                                                        <input id="alamat" name="alamat" type="text" class="required email form-control" readonly>
                                                    </div>
                                                 </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="form-group clearfix">
                                                    <label for="kodegol">No Telepon/Hp<span class="text-danger">*</span></label>
                                                    <div>
                                                        <input id="no_hp" name="no_hp" type="text" class="form-control" readonly>
                                                    </div>
                                                 </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-4">
                                                <div class="form-group clearfix">
                                                    <label for="no_hp">Tanggal Dicatat<span class="text-danger">*</span></label>
                                                    <div>
                                                        <div class="input-group">
                                                            <input type="text"  id="dicatat1" name="dicatat1" readonly>
                                                            <span class="input-group-addon bg-custom b-0"><i class="icon-calender"></i></span>
                                                        </div><!-- input-group -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end row -->
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="form-group clearfix">
                                                    <label>(<span class="text-danger">*</span>) Mandatory</label>
                                                </div>
                                            </div>
                                        </div><!-- end row -->

                                    </section>
                                    <h3>Detil Pemakaian</h3>
                                    
                                    <section>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="form-group clearfix">
                                                    <label for="nosambungan"> Meteran Lalu<span class="text-danger">*</span></label>
                                                    <div>
                                                    <div class="input-group">

                                                       <input id="lalu" name="lalu" type="text" class="form-control" readonly="readonly" >
                                                       <span class="input-group-addon bg-custom b-0"><i>M.ku</i></span>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="form-group clearfix">
                                                    <label for="nosambungan"> Harga + Biaya Administrasi<span class="text-danger">*</span></label>
                                                    <div>
                                                       <input id="totalBiaya" name="totalBiaya" type="text" class="form-control" required readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-6">
                                                <div class="form-group clearfix">
                                                    <label for="nama"> Meteran Sekarang<span class="text-danger">*</span></label>
                                                    <div>
                                                        <div class="input-group">

                                                       <input id="kini" name="kini" type="text" class="form-control" required>
                                                       <span class="input-group-addon bg-custom b-0"><i>M.ku</i></span>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-6">
                                                <div class="form-group clearfix">
                                                    <label for="nama"> Harga/m.cu<span class="text-danger">*</span></label>
                                                    <div>
                                                        <input type="hidden" name="dicatat2" id="dicatat2" required="required" placeholder = "YYYY-MM-DD">
                                                        <input id="harga" name="harga" type="text" class="form-control" required readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>

                                         <div class="row">
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="form-group clearfix">
                                                    <label for="nama"> Jumlah Pemakaian<span class="text-danger">*</span></label>
                                                    <div>
                                                    <div class="input-group">

                                                        <input id="pemakaian" name="pemakaian" type="text" class="form-control" required readonly>
                                                        <span class="input-group-addon bg-custom b-0"><i>M.ku</i></span>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-4">
                                                <div class="form-group clearfix">
                                                    <label for="no_hp">Batas Pembayaran<span class="text-danger">*</span></label>
                                                    <div>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="batas"  id="batas" readonly>
                                                            <span class="input-group-addon bg-custom b-0"><i class="icon-calender"></i></span>
                                                        
                                                        </div><!-- input-group -->
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="form-group clearfix">
                                                    <label>(<span class="text-danger">*</span>) Mandatory</label>
                                                </div>
                                            </div>
                                        </div><!-- end row -->
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-6 pul">
                                            </div>
                                            <div class="col-xs-12 col-sm-6 pul">
                                                <div class="form-group clearfix row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                        <div>
                                                        <input type="hidden" name="mode" id="mode" >
                                                            <input type="submit" value="Simpan" id="saveBill" class="btn btn-primary " hidden>

                                                            <button type="reset" class="btn btn-secondary waves-effect m-l-5 pull-right">
                                                                reset
                                                            </button>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                
                            </form>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            
                            <h4 class="m-t-0 header-title"><b>Data-data Meteran air terinstal/not terinstal</b></h4>
                            <p class="text-muted font-13 m-b-30">
                                
                            </p>
                              
                            <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr align="center">
                                    <th>No Meter</th>
                                    <th>Nama</th>
                                    <th>kodegol</th>
                                    <th>Pemakaian</th>
                                    <th>Total Biaya</th>
                                    <th>Batas Bayar</th>
                                    <th>Status</th>
                                    <th>Aksi SMS</th>
                                </tr>
                                </thead>

                                <tbody>
                                    <?php  
                                        $sql    = "SELECT pelanggan.*,golongan.*,tagihan.* FROM pelanggan, golongan, tagihan 
                                                WHERE golongan.kodegol=pelanggan.kodegol AND pelanggan.status='1' AND pelanggan.nosambungan=tagihan.nosambungan ";
                                        $result = mysql_query($sql) or die(mysql_error());
                                        
                                        while ($rows   = mysql_fetch_object($result)){;

                                    ?>
                                <tr>
                                    <td align="center"><?=$rows->nosambungan ?></td>
                                    <td><?=$rows->nama ?></td>
                                    <td><?=$rows->golongan ?></td>
                                    <td align="center"><?=$rows->pemakaian ?></td>
                                    <td align="center"><?=format_rupiah($rows->biaya) ?></td>
                                    <td align="center"><?=$rows->batas_tgl ?></td>
                                    <td align="center">
                                        <?php  
                                            if ($rows->status==0) {
                                               echo ' <span class="label label-sm label-danger"> Belum Bayar </span>';
                                            } elseif ($rows->status==1) {
                                                echo ' <span class="label label-sm label-success"> Sudah Bayar </span><span>';
                                            }
                                        ?>

                                    </td>
                                    <td align="center"> <a onclick="return confirm('Are You Sure ?')" href="?p=sms&id=<?=$rows->nosambungan?>" title="Kirim SMS" class="btn waves-effect waves-light btn-success tombol-simpan" ><i class="fa fa-send"></i></a>
                                    
                                    <a href="https://reguler.zenziva.net/apps/smsapi.php?userkey=xxxx&xx=xxx&nohp=<?=$rows->no_hp ?>&pesan=Yth; <?=$rows->nama ?>. Tagihan air anda sebesar : Rp <?=$rows->biaya ?> , mohon dibayar seblum taggal = <?=$rows->batas_tgl?>. Terima kasih" target="_blank" type="button" class="btn waves-effect waves-light btn-success tombol-simpan" title="Kirim SMS"><i class="fa fa-send"></i></a>
                                    </td>
                                    
                                </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end row -->