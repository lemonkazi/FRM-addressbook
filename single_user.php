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
	echo '<div style="margin-top:15px; font-weight:bold"> Details </div>';
	echo '<div style="background-color:#218af4; height:7px; margin-top:10px; border:1px solid #218af4; overflow:hidden;"></div>';
	//echo '<div style="float:left;margin-top:10px;font-weight:bold">' . $msg . ' </div><div class="add_new"> <a href="' . get_site_url() . '/wp-admin/admin.php?page=view-contact&action=exportToExcell"> Export To Excel File</a></div>';
	echo '<table width="100%" border="1" cellspacing="0" cellpadding="0">';
	
		global $wpdb;
    $sql = "SELECT * FROM " . $wpdb->prefix."addressbook WHERE id=".$_GET[id]; 
 $result = $wpdb->get_results($sql); 
	
	foreach($result as $row)
	{
		echo '<tr height="30px">';		
	echo '<th> Name</th>';
	echo '<th style="padding-left:5px; width:200px">' . $row->f_name, ' ', $row->m_name, ' ', $row->l_name . '</th>';
	echo '</tr>';

		echo '<tr height="25px">';	
		echo '<td style="padding-left:5px;width:200px">Phone:</td>';
	//	echo '<td style="padding-left:5px; width:200px">' . $row->f_name, ' ', $row->m_name, ' ', $row->l_name . '</td>';
		echo '<td style="padding-left:5px;width:200px">' . $row->phone . '</td>';		
		//echo '<td style="padding-left:5px;width:200px">' . $row->address . '</td>';
		//echo '<td style="padding-left:5px">' . $row->address . '</td>';
		// echo '<td '.$attributes.'> <a href="' . get_site_url() . '/wp-admin/admin.php?page=my_list_test&action=edit&id=' . $row->id . '"> Edit </a> | <a onclick="javascript:return confirmation()" href="' . get_site_url() . '/wp-admin/admin.php?page=my_list_test&action=delete&id=' . $row->id . '"> Delete</a></td>';
  
		echo '</tr>';
		echo '<tr height="25px">';	
		echo '<td style="padding-left:5px;width:200px">Address:</td>';
		echo '<td style="padding-left:5px;width:200px">' . $row->address . '</td>';
		//echo '<td style="padding-left:5px">' . $row->address . '</td>';
		 //echo '<td '.$attributes.'> <a href="' . get_site_url() . '/wp-admin/admin.php?page=my_list_test&action=edit&id=' . $row->id . '"> Edit </a> | <a onclick="javascript:return confirmation()" href="' . get_site_url() . '/wp-admin/admin.php?page=my_list_test&action=delete&id=' . $row->id . '"> Delete</a></td>';
  
		echo '</tr>';
		echo '</tr>';
		echo '<tr height="25px">';	
		echo '<td style="padding-left:5px;width:200px">E-Mail:</td>';
		echo '<td style="padding-left:5px;width:200px">' . $row->email . '</td>';
		//echo '<td style="padding-left:5px">' . $row->address . '</td>';
		 //echo '<td '.$attributes.'> <a href="' . get_site_url() . '/wp-admin/admin.php?page=my_list_test&action=edit&id=' . $row->id . '"> Edit </a> | <a onclick="javascript:return confirmation()" href="' . get_site_url() . '/wp-admin/admin.php?page=my_list_test&action=delete&id=' . $row->id . '"> Delete</a></td>';
  
		echo '</tr>';
		echo '</tr>';
		echo '<tr height="25px">';	
		echo '<td style="padding-left:5px;width:200px">Gender:</td>';
		echo '<td style="padding-left:5px;width:200px">' . $row->gender . '</td>';
		//echo '<td style="padding-left:5px">' . $row->address . '</td>';
		 //echo '<td '.$attributes.'> <a href="' . get_site_url() . '/wp-admin/admin.php?page=my_list_test&action=edit&id=' . $row->id . '"> Edit </a> | <a onclick="javascript:return confirmation()" href="' . get_site_url() . '/wp-admin/admin.php?page=my_list_test&action=delete&id=' . $row->id . '"> Delete</a></td>';
  
		echo '</tr>';
		echo '</tr>';
		echo '<tr height="25px">';	
		echo '<td style="padding-left:5px;width:200px">Age:</td>';
		echo '<td style="padding-left:5px;width:200px">' . $row->address . '</td>';
		//echo '<td style="padding-left:5px">' . $row->address . '</td>';
		 //echo '<td '.$attributes.'> <a href="' . get_site_url() . '/wp-admin/admin.php?page=my_list_test&action=edit&id=' . $row->id . '"> Edit </a> | <a onclick="javascript:return confirmation()" href="' . get_site_url() . '/wp-admin/admin.php?page=my_list_test&action=delete&id=' . $row->id . '"> Delete</a></td>';
  
		echo '</tr>';
		echo '</tr>';
		echo '<tr height="25px">';	
		echo '<td style="padding-left:5px;width:200px">Interest:</td>';
		echo '<td style="padding-left:5px;width:200px">' . $row->interest . '</td>';
		//echo '<td style="padding-left:5px">' . $row->address . '</td>';
		 //echo '<td '.$attributes.'> <a href="' . get_site_url() . '/wp-admin/admin.php?page=my_list_test&action=edit&id=' . $row->id . '"> Edit </a> | <a onclick="javascript:return confirmation()" href="' . get_site_url() . '/wp-admin/admin.php?page=my_list_test&action=delete&id=' . $row->id . '"> Delete</a></td>';
  
		echo '</tr>';
	}
	echo '</table>';
	?>
	<div class="row image">                   
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
                                                            <?php } else { ?>
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
	echo '<div style="background-color:#218af4; height:7px;margin-top:20px;  border:1px solid #218af4; overflow:hidden;"></div>';
	echo '</div>';

?>
<?php get_footer(); ?>