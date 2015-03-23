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
		<div style="margin-top:15px; font-weight:bold"></div>
		<div class="msg_h" style="float:left;margin-bottom:10px;font-weight:bold; width: 100%;">
			<h1> Details page</h1> 
			<?php //echo isset($msg) ? $msg : ''; ?> 
		</div>
		<table width="100%" border="1" cellspacing="0" cellpadding="0" style="width: 58%;float: left;">
			
		<col width="30%" />
	    <col width="50%" />
	    

   
			<?php
			global $wpdb;
			$sql = "SELECT * FROM " . $wpdb->prefix."addressbook WHERE id=".$_GET[id]; 
			$result = $wpdb->get_results($sql); 
	
			foreach($result as $row)
			{
				echo '<tr height="30px">';		
				echo '<th class="th_id"> Name</th>';
				echo '<th class="th_id" style="padding-left:5px; width:200px">' . $row->f_name, ' ', $row->m_name, ' ', $row->l_name . '</th>';
				echo '</tr>';

				echo '<tr height="25px">';	
				echo '<td class="fast_t">Phone:</td>';
				//	echo '<td style="padding-left:5px; width:200px">' . $row->f_name, ' ', $row->m_name, ' ', $row->l_name . '</td>';
				echo '<td style="padding-left:5px;width:200px">' . $row->phone . '</td>';		
				//echo '<td style="padding-left:5px;width:200px">' . $row->address . '</td>';
				//echo '<td style="padding-left:5px">' . $row->address . '</td>';
				// echo '<td '.$attributes.'> <a href="' . get_site_url() . '/wp-admin/admin.php?page=my_list_test&action=edit&id=' . $row->id . '"> Edit </a> | <a onclick="javascript:return confirmation()" href="' . get_site_url() . '/wp-admin/admin.php?page=my_list_test&action=delete&id=' . $row->id . '"> Delete</a></td>';
		  
				echo '</tr>';
				echo '<tr height="25px">';	
				echo '<td class="fast_t">Address:</td>';
				echo '<td style="padding-left:5px;width:200px">' . $row->address . '</td>';
				//echo '<td style="padding-left:5px">' . $row->address . '</td>';
				 //echo '<td '.$attributes.'> <a href="' . get_site_url() . '/wp-admin/admin.php?page=my_list_test&action=edit&id=' . $row->id . '"> Edit </a> | <a onclick="javascript:return confirmation()" href="' . get_site_url() . '/wp-admin/admin.php?page=my_list_test&action=delete&id=' . $row->id . '"> Delete</a></td>';
		  
				echo '</tr>';
				echo '</tr>';
				echo '<tr height="25px">';	
				echo '<td class="fast_t">E-Mail:</td>';
				echo '<td style="padding-left:5px;width:200px">' . $row->email . '</td>';
				//echo '<td style="padding-left:5px">' . $row->address . '</td>';
				 //echo '<td '.$attributes.'> <a href="' . get_site_url() . '/wp-admin/admin.php?page=my_list_test&action=edit&id=' . $row->id . '"> Edit </a> | <a onclick="javascript:return confirmation()" href="' . get_site_url() . '/wp-admin/admin.php?page=my_list_test&action=delete&id=' . $row->id . '"> Delete</a></td>';
		  
				echo '</tr>';
				echo '</tr>';
				echo '<tr height="25px">';	
				echo '<td class="fast_t">Gender:</td>';
				if ($row->gender=='M') {
					$gen="Male";
					# code...
				}
				if ($row->gender=='F') {
					$gen="Female";
					# code...
				}
				echo '<td style="padding-left:5px;width:200px">' . $gen . '</td>';
				//echo '<td style="padding-left:5px">' . $row->address . '</td>';
				 //echo '<td '.$attributes.'> <a href="' . get_site_url() . '/wp-admin/admin.php?page=my_list_test&action=edit&id=' . $row->id . '"> Edit </a> | <a onclick="javascript:return confirmation()" href="' . get_site_url() . '/wp-admin/admin.php?page=my_list_test&action=delete&id=' . $row->id . '"> Delete</a></td>';
		  
				echo '</tr>';
				echo '</tr>';
				echo '<tr height="25px">';	
				echo '<td class="fast_t">Age:</td>';
				//YEAR(CURDATE()) - $row->birthdate
				$datetime1 = new DateTime($row->birthdate);
				$today = date("Y-m-d");
				$datetime2 = new DateTime($today);

				$interval = $datetime1->diff($datetime2);
				//echo $interval->format('%y years %m months and %d days');
				echo '<td style="padding-left:5px;width:200px">' . $interval->format('%y years %m months and %d days') . '</td>';
				//echo '<td style="padding-left:5px">' . $row->address . '</td>';
				 //echo '<td '.$attributes.'> <a href="' . get_site_url() . '/wp-admin/admin.php?page=my_list_test&action=edit&id=' . $row->id . '"> Edit </a> | <a onclick="javascript:return confirmation()" href="' . get_site_url() . '/wp-admin/admin.php?page=my_list_test&action=delete&id=' . $row->id . '"> Delete</a></td>';
		  
				echo '</tr>';
				echo '</tr>';
				echo '<tr height="25px">';	
				echo '<td class="fast_t">Interest:</td>';
				echo '<td style="padding-left:5px;width:200px">' . $row->interest . '</td>';
				//echo '<td style="padding-left:5px">' . $row->address . '</td>';
				 //echo '<td '.$attributes.'> <a href="' . get_site_url() . '/wp-admin/admin.php?page=my_list_test&action=edit&id=' . $row->id . '"> Edit </a> | <a onclick="javascript:return confirmation()" href="' . get_site_url() . '/wp-admin/admin.php?page=my_list_test&action=delete&id=' . $row->id . '"> Delete</a></td>';
		  
				echo '</tr>';
			}
			?>
		</table>
	
		<div class="row image make-book-right">                   
	  	   <?php 
	  	   if (isset($row->p_url) ){

	            $image=$row->p_url;
	            if(!empty($row->p_url)) 
	          	{
	          	 	$image=$row->p_url;
	          	  	$path_array  = wp_upload_dir();
	                // $path = str_replace('\\', '/', $path_array['basedir']).'/documents';
	                $path = str_replace('\\', '/', $path_array['basedir']);
	                $image_id = explode($path, $image);
	                $image_id = $image_id[1];
	                  // $image_id=explode('D:/wamp/www/wordpresstest', $image);
	                  // $image_id=$image_id[1];
	                  
	                ?>
	                <!-- <img src="http://local-wordpresstest.dev/<?php echo $image_id; ?>" width="150"height="130" style="float: left;width: 203px;margin-right: 8px;"/> 
	                 -->
	                <img src="<?php echo site_url(); ?>/wp-content/uploads<?php echo $image_id; ?>" width="150"height="130" style="float: left;width: 203px;margin-right: 8px;"/> 
	                
	               	<?php 
	              	// end($row1);
	              	// $key = key($row1);
	               	// if ($row1['image'] === end($row1['image'])) { ?>
	               
	                <?php //} ?>
	            	<?php 
	        	} 
	        	else { ?>
	              	<div style="float: left;width: 100%;">
	                  	<Label for="file">ADD Picture:</label> 
	                    <input type="file" name="file" id="file">
	                </div>

	              	<?php 
	            	//} 
	          	}

	      	} ?>
	  	</div>
	    
		
	

		<?php 
		$pages1 = get_pages(array(
			'meta_key' => '_wp_page_template',
			'meta_value' => 'user_list_page.php'
		));
		foreach($pages1 as $page1){
			//echo $page->ID.'<br />';
		}
		echo '<div class="add_new11"><div class="add_new1"> <a href="' . get_permalink( $page1->ID) . '"> Back To List</a>
	  	</div></div>';

		?>
	</div>
</div>
<?php get_footer(); ?>