<?php

 switch ($action_done)
	{
	  case 'delete':
	  $msg = 'Data has been deleted successfully';
	  break;
	  
	  case 'add':
	  $msg = 'Data has been added successfully';
	  break;
	  
	  case 'edit':
	  $msg = 'Data has been updated successfully';
	  break;	  
	  
	  default:
	  $msg = '';
	}


/**
	 * Display the table
	 *
	 * @since 3.1.0
	 * @access public
	 */
	//public function display() {
		//$singular = $this->_args['singular'];

		//display_tablenav( 'top' );

?>

<?php
		//display_tablenav( 'bottom' );
	//}



	
    echo '<div style="width:90%">';
	echo '<div style="margin-top:15px; font-weight:bold"> Configure Your Contact subject and Email Content </div>';
	echo '<div style="background-color:#218af4; height:7px; margin-top:10px; border:1px solid #218af4; overflow:hidden;"></div>';
	echo '<div style="float:left;margin-top:10px;font-weight:bold">' . $msg . ' </div><div class="add_new"> <a href="' . get_site_url() . '/wp-admin/admin.php?page=my_list_test&action=add"> Add New</a>
	</div>';
	//get_bulk_actions();
	echo '<table class="wp-list-table" width="100%" border="1" cellspacing="0" cellpadding="0">';
	?>
	<thead>
		<tr>
			<th scope="col" id="cb" class="manage-column column-cb check-column" style="">
				<label class="screen-reader-text" for="cb-select-all-1">Select All</label>
				<input id="cb-select-all-1" type="checkbox">
			</th>
			<th scope="col" id="title" class="manage-column column-title sortable desc" style="">
				<a href="http://local-wordpresstest.dev/wp-admin/edit.php?orderby=title&amp;order=asc">
					<span>Name</span><span class="sorting-indicator"></span>
				</a>
			</th>
			<th scope="col" id="author" class="manage-column column-author" style="">Phone</th>
			<th scope="col" id="categories" class="manage-column column-categories" style="">E-Mail</th>
			<th scope="col" id="tags" class="manage-column column-tags" style="">Options</th>
				
		</tr>
	</thead>
	<?php
	// echo '<tr height="30px">';		
	// echo '<th> Name</th>';
	// echo '<th> Phone</th>';
	// echo '<th>E-Mail</th>';
	// echo '<th> Options</th>';
	// echo '</tr>';
	
	foreach($resultList as $row)
	{
		?>



		<tbody id="the-list">
			<tr id="post-<?php echo $row->id; ?>" class="post-<?php echo $row->id; ?> type-post format-standard hentry alternate iedit author-self level-0">
				<th scope="row" class="check-column">
					<label class="screen-reader-text" for="cb-select-1">Select Hello world!</label>
					<input id="cb-select-1" type="checkbox" name="post[]" value="1">
					<div class="locked-indicator"></div>
				</th>
				
				<?php 
				echo '<td class="post-title page-title column-title" style="padding-left:5px; width:300px"><strong>' . $row->f_name, ' ', $row->m_name, ' ', $row->l_name . '</strong></td>';			
				echo '<td class="author column-author" style="padding-left:5px; width:300px">' . $row->phone . '</td>';		
				echo '<td class="categories column-categories" style="padding-left:5px">' . $row->email .'</td>';
			//	echo '<td class="tags column-tags" style="padding-left:5px">' . $row->email . '</td>';
				echo '<td class="tags column-tags" style="padding-left:5px; width:100px"> <a href="' . get_site_url() . '/wp-admin/admin.php?page=my_list_test&action=edit&id=' . $row->id . '"> Edit </a> | <a onclick="javascript:return confirmation()" href="' . get_site_url() . '/wp-admin/admin.php?page=my_list_test&action=delete&id=' . $row->id . '"> Delete</a></td>';
	
				?>
			
					
			</tr>
		</tbody>
		<?php
		//echo '<tr height="25px">';	
		//echo '<td style="padding-left:5px; width:300px">' . $row->f_name, ' ', $row->m_name, ' ', $row->l_name . '</td>';
		//echo '<td style="padding-left:5px">' . $row->phone . '</td>';
		//echo '<td style="padding-left:5px">' . $row->email . '</td>';
		//echo '<td style="padding-left:5px; width:100px"> <a href="' . get_site_url() . '/wp-admin/admin.php?page=configure-contact&action=edit&id=' . $row->id . '"> Edit </a> | <a onclick="javascript:return confirmation()" href="' . get_site_url() . '/wp-admin/admin.php?page=configure-contact&action=delete&id=' . $row->id . '"> Delete</a></td>';
		//echo '</tr>';
	}
	echo '</table>';
	echo '<div style="background-color:#218af4; height:7px;margin-top:20px;  border:1px solid #218af4; overflow:hidden;"></div>';
	echo '</div>';

?>