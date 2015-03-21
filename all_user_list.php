<?php
    echo '<div style="width:90%">';
	echo '<div style="margin-top:15px; font-weight:bold"> Contact List </div>';
	echo '<div style="background-color:#218af4; height:7px; margin-top:10px; border:1px solid #218af4; overflow:hidden;"></div>';
	//echo '<div style="float:left;margin-top:10px;font-weight:bold">' . $msg . ' </div><div class="add_new"> <a href="' . get_site_url() . '/wp-admin/admin.php?page=view-contact&action=exportToExcell"> Export To Excel File</a></div>';
	echo '<table width="100%" border="1" cellspacing="0" cellpadding="0">';
	echo '<tr height="30px">';		
	echo '<th> Name</th>';
	echo '<th> Phone</th>';
	echo '<th>E-Mail</th>';	
	//echo '<th>options</th>';	
	echo '</tr>';
	
	foreach($result as $row)
	{
		echo '<tr height="25px">';	
		echo '<td style="padding-left:5px; width:200px">' . $row->f_name, ' ', $row->m_name, ' ', $row->l_name . '</td>';
		echo '<td style="padding-left:5px;width:200px">' . $row->phone . '</td>';		
		echo '<td style="padding-left:5px;width:200px">' . $row->email . '</td>';
		//echo '<td style="padding-left:5px">' . $row->address . '</td>';
		echo '</tr>';
	}
	echo '</table>';
	echo '<div style="background-color:#218af4; height:7px;margin-top:20px;  border:1px solid #218af4; overflow:hidden;"></div>';
	echo '</div>';

?>