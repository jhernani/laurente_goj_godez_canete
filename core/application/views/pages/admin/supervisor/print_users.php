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
<h3>User list</h3>
<table>
	<tr>
		<td><b>Student ID</b></td>
		<td><b>Name</b></td>
		<td><b>Account Status</b></td>
		<td><b>Gender</b></td>
		<td><b>Course/Year</b></td>
		<td><b>Room</b></td>
	</tr>
<?php
	if($total == 0)
	{
		echo "<tr>";
		echo "<td colspan='6'> Empty result. </td>";
		echo "</tr>";
	}
	else
	{
	foreach($users->result() as $row)
			{
			echo "<tr>";
			echo "<td>" . $row->ISMIS_ID . "</td>";
			echo "<td>" . $row->LNAME . ", " . $row->FNAME . " " . $row->MNAME . "</td>";
			if($row->STATUS == '1')
			{
				echo "<td>Active</td>";
			}
			else
			{
				echo "<td>Inactive</td>";
			}
			if($row->GENDER == 'M')
			{
				echo "<td>Male</td>";
			}
			else
			{
				echo "<td>Female</td>";
			}
			echo "<td>" . $row->C_ABBR . " " . $row->YEAR . "</td>";
			echo "<td>" . $row->BLG_NAME . " Room " . $row->ROOM_NO . "</td>";
			echo "</tr>";
		}
	}
?>
</table>

<?php
$content = ob_get_contents();
ob_end_clean();
$obj_pdf->writeHTML($content, true, false, true, false, '');
$obj_pdf->Output('output.pdf', 'I');

    