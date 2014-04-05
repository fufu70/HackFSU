<?php
    date_default_timezone_set("America/New_York");
    $today = date('Y-m-d');
    $table_content = '';
  
    if (isset($table) && sizeof($table) > 0)
    {
        $today = date('Y-m-d');
        $table_keys = array_keys($table[0]);
        $table_content .= '<div class="panel panel-default scroll-hor">';
        $table_content .= '<table class="table table-hover" data-page-navigation=".pagination" data-page-size="8"><thead><tr>';
        for($i = 0; $i < sizeof($table_keys); $i ++)
        {
            $table_content .= '<th ';
            // setting up the table to be viewable on a tablet or a smaller device
            if($i > 7)
            {
                $table_content .= "data-hide='all'";
            }
            else if($i > 4)
            {
                $table_content .= "data-hide='phone,tablet'";
            }
            else if($i == 0)
            {
                $table_content .= "data-sort-initial='true' data-class='expand'";
            }

            $table_content .= '>'.$table_keys[$i].'</th>';
        }

        $table_content .= '</tr></thead><tbody>';
        
        for($i = 0; $i < sizeof($table); $i ++)
        {
            $row_numerical = array_values($table[$i]);
            $table_content .= "<tr>";
            for($j = 0; $j < sizeof($row_numerical); $j ++)
            {
                // To give the Reservation Status a certain css class for the specific Status
                // Initially check for Overdue Status, else just insert the Status as the css
                // class.
                if(isset($table[$i]['Reservation Status']) && $j == 3)
                {
                    $end_date = date('Y-m-d', strtotime($table[$i]['End Date']));
                    if($table[$i]['Reservation Status'] == 'Active' && $end_date < $today)
                    {
                        $table_content .= "<td class='Overdue'>".$row_numerical[$j]."</td>";
                    }
                    else
                    {
                        $table_content .= "<td class='".$row_numerical[$j]."''>".$row_numerical[$j]."</td>";
                    }
                }
                else
                {
                    $table_content .= "<td>".$row_numerical[$j]."</td>";
                }
            }
            $table_content .= "</tr>";
        }

        $table_content .= '</tbody></table></div>';
    }
  
?>

<!-- Sidebar -->
<div class="col-xs-12 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
	<div class="panel-group" id="accordion">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse_1">Reservations</a></h4>
			</div>
			<div id="collapse_1" class="panel-body panel-collapse collapse">
				<ul class="nav nav-pills nav-stacked">
				<li id="TotalReservations"><a href="/index.php/repo/reporttotalreservations">Total Reservations</a></li>
				<li id="ReservationStatus"><a href="/index.php/repo/reportreservationstatus">By Status</a></li>
				<li id="ItemsByPerson"><a href="/index.php/repo/reportitemsbyperson">By Person</a></li>
				<li id="ReservationsByType"><a href="/index.php/repo/reportreservationsbytype">By Item Type</a></li>
				<li id="ItemsByNumber"><a href="/index.php/repo/reportitemsbynumber">By Barcode Number</a></li>
				<li id="ReservationsWithDeliveryAndSetup"><a href="/index.php/repo/reportreservationswithdeliveryandsetup">With Delivery And Setup</a></li>
				<li id="ByEquipmentStatus"><a href="/index.php/repo/reportbyequipmentstatus">By Equipment Status</a></li>
				</ul>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse_2">Equipment</a></h4>
			</div>
			<div id="collapse_2" class="panel-body panel-collapse collapse">
				<ul class="nav nav-pills nav-stacked">
				<li id="TotalReservationItems"><a href="/index.php/repo/reporttotalreservationitems">Reserved Items</a></li>
				<li id="UnreservedItems"><a href="/index.php/repo/reportunreserveditems">Unreserved Items</a></li>
				</ul>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse_3">Misc</a></h4>
			</div>
			<div id="collapse_3" class="panel-body panel-collapse collapse">
				<ul class="nav nav-pills nav-stacked">
				<li id="OverdueItems"><a href="/index.php/repo/reportoverdueitems">Overdue Items</a></li>
				<li id="LogItems"><a href="/index.php/repo/reportlogitems">Log Items</a></li>
				</ul>
			</div>
		</div>
	</div>
</div> <!-- /.sidebar -->
        
<div class="col-xs-12 col-sm-9">
    
    <!-- No Results Message -->
    <div class="alert alert-warning <?php if(isset($table) && sizeof($table) > 0) { echo 'hide'; } ?>">
        No results found.
    </div>

    <!-- Results Table -->
    <div id="<?php if(isset($table)) { echo $formname; } ?>" class="<?php if(!isset($table)) echo 'hide'; ?>">
        <?php 
            if (isset($table) && sizeof($table) > 0)
            {
                echo $table_content;
            }
        ?>
        <form class="report-form" action="/index.php/repo/report<?php if(isset($table)) echo strtolower($formname); ?>" style="<?php if(isset($table) && sizeof($table) == 0) echo 'display:none'; ?>" method="POST">
            <input name="ReportForm[download<?php if(isset($table)) echo $formname; ?>]" type="text" style="display: none" value="1">
            <input name="ReportForm[queriedBeginningDate]" type="Date" style="display: none" id="ReportForm_queriedqueriedBeginningDate" value="<?php if (isset($table) && isset($_POST['ReportForm']['queriedBeginningDate'])) echo $_POST['ReportForm']['queriedBeginningDate']; ?>">
            <input name="ReportForm[queriedEndDate]" type="Date" style="display: none" id="ReportForm_queriedEndDate" value="<?php if (isset($table) && isset($_POST['ReportForm']['queriedEndDate'])) echo $_POST['ReportForm']['queriedEndDate']; ?>">
            <input name="ReportForm[extraInfo]" type="text" style="display: none" id="ReportForm_extraInfo" value="<?php if (isset($table) && isset($_POST['ReportForm']['extraInfo'])) echo $_POST['ReportForm']['extraInfo']; ?>">
            <button class="btn btn-primary" type="submit" name="yt0">Download CSV</button>
        </form>
    </div>

</div>

<!-- javascript -->
<input type="hidden" id="formname" value="<?php echo $formname; ?>" />
<script type="text/javascript" src="<?php Yii::app()->request->baseUrl; ?>/js/site/reportdisplay.js"></script>
