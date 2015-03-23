<?php


/*
  Template Name: address 
 */

 get_header();
/*
When The form is submitted foloowing section is used
Do Add/Edit
*/
?>
<div id="make-book-left colorful">
	
    <div style="width:90%">
		<div style="margin-top:15px; font-weight:bold"> </div>
		<div class="msg_h" style="float:left;margin-bottom:10px;font-weight:bold">
			<h1> Contact List</h1> 
			<?php echo isset($msg) ? $msg : ''; ?> 
		</div>

		<?php
		//echo '<div style="float:left;margin-top:10px;font-weight:bold">' . $msg . ' </div><div class="add_new"> <a href="' . get_site_url() . '/wp-admin/admin.php?page=view-contact&action=exportToExcell"> Export To Excel File</a></div>';
		echo '<table width="100%" border="1" cellspacing="0" cellpadding="0">';
		?>
		<col width="10%" />
    <col width="25%" />
    <col width="25%" />
    <col width="30%" />
    <col width="10%" />

    <?php 
			echo '<tr class="st_th" height="30px">';
				echo '<th class="th_id"> ID</th>';		
				echo '<th class="st_th1"> Name</th>';
				echo '<th class="st_th1"> Phone</th>';
				echo '<th class="st_th1">Address</th>';	
				echo '<th class="st_th1">Details</th>';	
			echo '</tr>';
			global $wpdb;
			$num_rec_per_page=4;

		    if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
		    $start_from = ($page-1) * $num_rec_per_page; 
		    $sql = "SELECT * FROM {$wpdb->prefix}addressbook LIMIT $start_from, $num_rec_per_page"; 
		     //$sql = "SELECT * FROM " . $wpdb->prefix."addressbook LIMIT" .$start_from.",".$num_rec_per_page; 


				$result = $wpdb->get_results($sql); 

			foreach($result as $row)
			{
				echo '<tr height="25px">';
					echo '<td width="10%" class="fast_t">' . $row->id. '</td>';	
					echo '<td class="st_th1" style="padding-left:5px; width:200px">' . $row->f_name, ' ', $row->m_name, ' ', $row->l_name . '</td>';
					echo '<td class="st_th1" style="padding-left:5px;width:200px">' . $row->phone . '</td>';		
					echo '<td class="st_th1" style="padding-left:5px;width:200px">' . $row->address . '</td>';
					//echo '<td style="padding-left:5px">' . $row->address . '</td>';
					$pages = get_pages(array(
						'meta_key' => '_wp_page_template',
						'meta_value' => 'single_user.php'
					));
					foreach($pages as $page){
						//echo $page->ID.'<br />';
				
					}
					$pages1 = get_pages(array(
						'meta_key' => '_wp_page_template',
						'meta_value' => 'address.php'
					));
					foreach($pages1 as $page1){
						//echo $page->ID.'<br />';
				
					}
					$pages2 = get_pages(array(
						'meta_key' => '_wp_page_template',
						'meta_value' => 'user_list_page.php'
					));
					foreach($pages2 as $page2){
						//echo $page->ID.'<br />';
						
					}
					if ( is_user_logged_in() ) {
					 $user_ID = get_current_user_id();  
					}
					if ($user_ID==$row->id) {
						# code...

						echo '<td '.$attributes.'>';
					 		//echo '<a href="'. get_permalink( $page1->ID).'&id=' . $row->id . '"> Edit</a>|';
					 		 if ( get_option('permalink_structure') ) { 
					 		echo '<a href="'. get_permalink( $page->ID).'?id=' . $row->id . '"> Details</a>';
					 		//echo 'permalinks enabled'; 
					 	} else {
					 		echo '<a href="'. get_permalink( $page->ID).'&id=' . $row->id . '"> Details</a>';
					 	}
					 echo'</td>';
				  	}
					if ($user_ID!=$row->id) {
					  	 echo '<td '.$attributes.'><a href="'. get_permalink( $page->ID).'&id=' . $row->id . '"> Details</a></td>';
					}

				echo '</tr>';
				

			}
		echo '</table>';


		$sql = "SELECT * FROM " . $wpdb->prefix."addressbook"; 
		$rs_result = mysql_query($sql); //run the query
		$total_records = mysql_num_rows($rs_result);  //count number of records
		$total_pages = ceil($total_records / $num_rec_per_page); 
		$aaa = get_permalink( $page2->ID);
		
		
		echo '<div class="add_new1"> 
	    	<a class="continue-button" href="' . get_permalink( $page1->ID) . '"> Add Contact</a>
	  	</div>';

	  	?>
	  	
		<div class="pagination">
		<?php

		echo "<a href='".$aaa."&page=1'>".'|<'."</a> "; // Goto 1st page  

		for ($i=1; $i<=$total_pages; $i++) { 
			 if ( get_option('permalink_structure') ) { 
					 		echo "<a href='".$aaa."?page=".$i."'>".$i."</a> "; 
					 		//echo 'permalinks enabled'; 
					 	} else {
					 		echo "<a href='".$aaa."&page=".$i."'>".$i."</a> "; 
					 	}
           // echo "<a href='".$aaa."&page=".$i."'>".$i."</a> "; 
		}; 
		 if ( get_option('permalink_structure') ) { 
					 		echo "<a href='".$aaa."?page=$total_pages'>".'>|'."</a> "; // Goto last page
					 		//echo 'permalinks enabled'; 
					 	} else {
					 		echo "<a href='".$aaa."&page=$total_pages'>".'>|'."</a> "; // Goto last page
					 	}
		




		//echo '<div style="background-color:#218af4; height:7px;margin-top:20px;  border:1px solid #218af4; overflow:hidden;"></div>';
		echo '</div>';

		?>
	</div>
</div>	
<?php get_footer(); ?>