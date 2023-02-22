<?php
require('pdfFromDatabase/vendor/autoload.php');
$con=mysqli_connect('localhost','root','','canteendb');
$res=mysqli_query($con,"select * from bill");
if(mysqli_num_rows($res)>0){
	$html='<style>
			.table{
				color:red;
			}
			<p></p>
			</style><table border = "1" cellspacing="0" class="table" >';
		$html.='<tr><th>Name</th><th>Qty</th><th>Price</th></tr>';
		while($row=mysqli_fetch_assoc($res)){
			$html.='<tr>produxt NAme<td>'.$row['order_id'].'</td><td>'.$row['qty'].'</td><td>'.$row['price'].'</td></tr>';
		}
	$html.='</table>';
}else{
	$html="Data not found";
}
$mpdf=new mpdf\mpdf();
$mpdf->WriteHTML($html);
$file=time().'.pdf';
$mpdf->output($file,'I');
//D
//I
//F
//S
?>