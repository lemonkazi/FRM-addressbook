<?php


/*
  Template Name: address 
 */

 get_header();
/*
When The form is submitted foloowing section is used
Do Add/Edit
*/
    echo '<div style="width:90%">';
	echo '<div style="margin-top:15px; font-weight:bold"> Contact List </div>';
	echo '<div style="background-color:#218af4; height:7px; margin-top:10px; border:1px solid #218af4; overflow:hidden;"></div>';
	//echo '<div style="float:left;margin-top:10px;font-weight:bold">' . $msg . ' </div><div class="add_new"> <a href="' . get_site_url() . '/wp-admin/admin.php?page=view-contact&action=exportToExcell"> Export To Excel File</a></div>';
	echo '<table width="100%" border="1" cellspacing="0" cellpadding="0">';
	echo '<tr height="30px">';		
	echo '<th> Name</th>';
	echo '<th> Phone</th>';
	echo '<th>Address</th>';	
	echo '<th>Details</th>';	
	echo '</tr>';
		global $wpdb;
    $sql = "SELECT * FROM " . $wpdb->prefix."addressbook"; 
 $result = $wpdb->get_results($sql); 
	
	foreach($result as $row)
	{
		echo '<tr height="25px">';	
		echo '<td style="padding-left:5px; width:200px">' . $row->f_name, ' ', $row->m_name, ' ', $row->l_name . '</td>';
		echo '<td style="padding-left:5px;width:200px">' . $row->phone . '</td>';		
		echo '<td style="padding-left:5px;width:200px">' . $row->address . '</td>';
		//echo '<td style="padding-left:5px">' . $row->address . '</td>';
		$pages = get_pages(array(
	'meta_key' => '_wp_page_template',
	'meta_value' => 'single_user.php'
));
		foreach($pages as $page){
	//echo $page->ID.'<br />';
	
}
		 echo '<td '.$attributes.'> <a href="'. get_permalink( $page->ID).'&id=' . $row->id . '"> Details</a></td>';
  
		echo '</tr>';
		

	}
	echo '</table>';
	echo '<div style="background-color:#218af4; height:7px;margin-top:20px;  border:1px solid #218af4; overflow:hidden;"></div>';
	echo '</div>';

?>
<?php get_footer(); ?>