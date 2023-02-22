<?php
require('vendor/autoload.php');
$con=mysqli_connect('localhost','root','','canteendb');
$res=mysqli_query($con,"SELECT `products_id`, `date`, `time`, `daily_amount`, `sold_amount`, `rest_amount`, `daily_cost`, `daily_value`, `profit` FROM `sales`");
if(mysqli_num_rows($res)>0){
	$html='<style>
			.table{
				color:red;
			}
			<p></p>
			</style><table border = "1" cellspacing="0" class="table" >';
		$html.='<tr><th>Product ID</th><th>Date</th><th>Time</th><th>Daily Amount</th><th>Sold Amount</th><th>Rest Amount</th><th>Daily Cost</th><th>Daily Value</th><th>profit</th></tr>';
		while($row=mysqli_fetch_assoc($res)){
			$html.='<tr>produxt NAme<td>'.$row['products_id'].'</td><td>'.$row['date'].'</td><td>'.$row['time'].'</td></tr>';
		}
	$html.='</table>';
}else{
	$html="Data not found";
}
$mpdf=new \mpdf\mpdf();
$mpdf->WriteHTML($html);
$file=time().'.pdf';
$mpdf->output($file,'I');
//D
//I
//F
//S
?>