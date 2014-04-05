<center><h1>Loaner Equipment Agreement</h1></center>
<hr style="background-color:blue">
<p style="margin-left: 50px;">
	Name of Borrower: <?php echo $person_table->first_name." ".$person_table->last_name; ?>
</p>
<p style="margin-left: 50px;">
	Stetson ID#: <?php echo $person_table->student_id; ?>
</p>
<p style="margin-left: 50px;">
	Cell Phone #: <?php echo $person_table->cell_phone; ?>
</p>
<p style="margin-left: 50px;">
	Date of Reservation: <?php echo $reservation_table->beginning_date; ?>
</p>
<p style="margin-left: 50px;">
	Date of Expected Return: <?php echo $reservation_table->end_date; ?>
</p>
<p>
	<u>Initial</u>
</p>
<table>
	<tr>
		<td>
			<table style="margin-top:20px">
			<tr>
				<td>
				____
				</td>
			</tr>
			<tr>
				<td>
				____
				</td>
			</tr>
			<tr>
				<td>
				____
				</td>
			</tr>
			<tr>
				<td>
				____
				</td>
			</tr>
			</table>
		</td>
		<td>
			<table style="margin-left:17px;">
			<tr>
			<td>
			<b><u>I understand that I am responsible for returning the equipment at 9am the next day in acceptable condition.</u></b> This includes responsibility for the care of the equipment for the dates assigned to me.
			</td>
			</tr>
			<tr>
			<td>
			<b><u>If the item has not been returned by Noon on the due date, then we will lock your Email and Blackboard account until the items have been returned. </u></b>
			</td>
			</tr>
			<tr>
			<td>
			If it requires repairs for physical damage, I will be responsible for the cost of the repairs and parts.
			</td>
			</tr>
			<tr>
			<td>
			If it is lost or stolen, I will be responsible for the cost of the replacement.
			</td>
			</tr>
			</table>
		</td>
	</tr>
</table>
<p style="margin-left: 50px;">
	If an extension is needed for the loan, please contact IT Helpdesk at 386-822-7217 as soon as possible to determine if the equipment is available for an extension.
</p>
<p style="margin-left: 50px;">
	Loaned Equipment (Type & Name or SU#):
</p style="margin-left: 50px;">
<?php
	$reservation_items = $model->getReservationItemsByID($reservation_table->reservation_number);
	$eq_type = EquipmentType::model()->findAll();
	$report = new ReportForm;
	for($i = 0; $i < sizeof($reservation_items); $i++)
	{
		$equipment = $report->getEquipmentByID($reservation_items[$i]['item_number']);
		$type = $equipment->item_type_id;
		echo "<p style='margin-left: 100px;'>";
		echo $eq_type[$type - 1]." ".$equipment->su_number;
		echo "</p>";
	}

?>
<p>
	Signature of Recipient:_______________________________________________________
</p>
<p>
	Helpdesk Staff:___________________
</p>
<div class="row">
<a href="javascript:window.print()"><button>print</button></a>
</div>