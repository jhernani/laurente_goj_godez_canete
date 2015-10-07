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
$obj_pdf->SetFont('courier', '', 9);
$obj_pdf->setFontSubsetting(false);
$obj_pdf->setPrintFooter(false);
$obj_pdf->AddPage();
ob_start();
?>
<table>
	<tr>
		<td><?php echo $ismis ?></td>
		<td><?php echo $name ?></td>
		<td><?php echo $course ?></td>
	</tr>
	<br>
	<tr>
		<td>Period</td>
		<td><?php echo date('F d, Y', strtotime($start)) . " - " . date('F d, Y', strtotime($end)) ?></td>
		<td></td>
	</tr>
	<?php
		foreach($over_due->result() as $row)
		{
			$value = $this->sys->get_due_total($u_id, $row->DUE_DATE);
			echo "<tr>";
			echo "<td>";
			echo date('F d, Y', strtotime($row->DUE_START)) . " - " . date('F d, Y', strtotime($row->DUE_DATE));
			echo "</td>";
			echo "<td>";
			echo "PHP " . number_format($value, 2);
			echo "</td>";
			echo "</tr>";
		}
		foreach($fee->result() as $row)
		{
			echo "<tr>";
			echo "<td>";
			echo $row->FEE_NAME;
			echo "</td>";
			echo "<td colspan='2'>";
			echo "PHP " . number_format($row->VALUE, 2);
			echo "</td>";
			echo "</tr>";	
		}
	?>
	<tr>
	<td><b>Total</b></td>
	<td colspan="2"><b>PHP <?php echo number_format($total, 2) ?></b></td>
	</tr>
	<br>
	<tr>
	<td colspan="2"></td>
	<td><u>Celestina Salapa</u></td>
	</tr>
	<tr>
	<td colspan="2"></td>
	<td>Dorm Supervisor</td>
	</tr>
</table>
<br>
<br>
Certified true and correct.
<hr>
<?php	
$content = ob_get_contents();
ob_end_clean();
$obj_pdf->writeHTML($content, true, false, true, false, '');
$obj_pdf->Output('output.pdf', 'I');
    