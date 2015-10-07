<?php
tcpdf();
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = "Carolinian Residence Association";
$obj_pdf->SetTitle($title);
$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('helvetica');
$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$obj_pdf->SetFont('helvetica', '', 9);
$obj_pdf->setFontSubsetting(false);
$obj_pdf->setPrintFooter(false);
$obj_pdf->AddPage();
ob_start();
?>
<table>
	<tr>
		<td><b>Student ID</b></td>
		<td><b>Name</b></td>
		<td><b>Gender</b></td>
		<td><b>Course/Year</b></td>
		<td><b>Amount Paid</b></td>
	</tr>
<?php
	if($total == 0)
	{
		echo "<tr>";
		echo "<td colspan='5'> No results found. </td>";
		echo "</tr>";
	}
	$start = $this->input->post('start');
	$end = $this->input->post('end');
	$total = 0.00;
	
	foreach($account->result() as $row)
	{			
		$query = $this->sys->user_details($row->ACC_ID);
		$user = $query->row();
		$ismis = $user->ISMIS_ID;
		$gender = $user->GENDER;
		$name = $user->LNAME . ", " . $user->FNAME . " " . $user->MNAME;	
		
		$course = $this->sys->get_course_abbr($user->C_ID);
		$amount = $this->sys->get_amount_total($row->ACC_ID, $start, $end);
		$total += $amount;
			
		echo "<tr>";
		echo "<td>" . $ismis . "</td>";
		echo "<td>" . $name . "</td>";
		echo "<td>" . $gender . "</td>";
		echo "<td>" . $course . " " . $user->YEAR . "</td>";
		echo "<td>PHP " . number_format($amount, 2) . "</td>";
		echo "</tr>";
	}
?>
	<tr>
		<td colspan="3"></td>
		<td><b>Total</b></td>
		<td><b>PHP <?php echo number_format($total, 2) ?></b></td>
	</tr>
</table>
<?php
$content = ob_get_contents();
ob_end_clean();
$obj_pdf->writeHTML($content, true, false, true, false, '');
$obj_pdf->Output('output.pdf', 'I');

    