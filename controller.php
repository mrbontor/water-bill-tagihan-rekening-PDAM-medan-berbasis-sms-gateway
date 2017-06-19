<?php  
include('koneksi.php');
 	


if(isset($_POST["pelanggans"])){
	$value 		= 	mysql_query("SELECT * FROM pelanggan WHERE nosambungan='".$_POST['pelanggans']['nosambungan']."'");
	$v2 		= 	mysql_query("SELECT * FROM tagihan WHERE nosambungan = '".$_POST['pelanggans']['nosambungan']."' order by tgl_dicatat DESC limit 1");
	$values		=	mysql_fetch_assoc($value); 
	$v2s 		=	mysql_fetch_assoc($v2); 
	$numrows 	= 	mysql_num_rows($value);
	$fetched	=	"";
	if($numrows!=0 && mysql_num_rows($v2)!=0){
		$fetched = $values["nama"].",".$values["nomorktp"].",".$values["kodegol"].",".$values["alamat"].",".$values["no_hp"].",".$v2s["meterKini"]; 
		echo $fetched;
		return;
	}
	if($numrows!=0 && mysql_num_rows($v2)==0){
		$fetched = $values["nama"].",".$values["nomorktp"].",".$values["kodegol"].",".$values["alamat"].",".$values["no_hp"].",0"; 
		echo $fetched;
		return;
	}
}


if(isset($_POST['mode'])){
	if($_POST['mode'] == 'new'){
		$batas 	= mysql_query("SELECT nosambungan FROM tagihan WHERE nosambungan='$_POST[pelanggan]' ");
		$nums 	= mysql_num_rows($batas); 
		if($nums==0){
			try {
				
		
				mysql_query("INSERT INTO tagihan VALUES ('','$_POST[pelanggan]','$_POST[kodegol]','$_POST[lalu]','$_POST[kini]','$_POST[dicatat1]','$_POST[batas]','$_POST[pemakaian]','$_POST[totalBiaya]','$_POST[harga]',0,0)");

				mysql_query("INSERT INTO pemakaian VALUES ('','$_POST[pelanggan]','$_POST[kodegol]','$_POST[lalu]','$_POST[kini]','$_POST[dicatat1]','$_POST[pemakaian]','$_POST[totalBiaya]',0)");

				

				echo '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i></i> Successfully</h4>
                         Tagihan berhasil diinput
                </div>' ;
				echo '<meta http-equiv="refresh" content="0; url=?p=tagihan" />';
			} catch (Exception $e) {
				echo $e;
			}
		}
		else{
		
			mysql_query("Update tagihan set meterLalu='$_POST[lalu]', meterkini='$_POST[kini]', tgl_dicatat='$_POST[dicatat1]', batas_tgl='$_POST[batas]', pemakaian='$_POST[pemakaian]', biaya=biaya+'$_POST[totalBiaya]', hargaPer=hargaPer+'$_POST[harga]', status='0' WHERE nosambungan='$_POST[pelanggan]' ");
			echo '<meta http-equiv="refresh" content="0; url=?p=tagihan" />';
		}
	}
}

if(isset($_POST['mode2'])){	
	mysql_query("INSERT INTO pembayaran values ('','$_POST[nosa]','$_POST[batas]','$_POST[boaya]','$_POST[bayar]','$_POST[denda]','$_POST[balance]')");
		if($_POST['balance']==0){
			mysql_query("UPDATE tagihan SET status = '1', savings='$_POST[savings]' WHERE nosambungan = '$_POST[nosa]'");
			mysql_query("UPDATE pemakaian SET status = '1' WHERE nosambungan = '$_POST[nosa]'");
		}
		else{
			mysql_query("UPDATE tagihan SET biaya = '$_POST[balance]',savings='$_POST[savings]' WHERE nosambungan = '$_POST[nosa]' ");
		}
		unset($_SESSION['sav']);
		echo '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i></i> Successfully</h4>
                         Pembayaran berhasil dilakukan
                </div>' ;
		echo '<meta http-equiv="refresh" content="0; url=?p=bayar" />';
}



?>