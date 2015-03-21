<?php
/*
When The form is submitted foloowing section is used
Do Add/Edit
*/
global $wpdb;

if($_POST['contact_form'])
{

	  global $wpdb;
	  if(isset($_POST['interest'])) 
            {

                $cartype = implode(",", $_POST['interest']); 
                //$productid_arr = explode(',' , $cartype); 
                //$cartype = $_POST['cartype'];
            }
            else 
            {
                $cartype = "";
                //$productid_arr = explode(',' , $cartype); 
            }  
	  	
	 if($_POST['id'])
	 {

	 	if ($_FILES["file"]["error"] > 0)
                                      {
                                      echo "Error: " . $_FILES["file"]["error"] . "<br>";
                                      }
                                    else
                                      {
                                                                                                      
                                  $path_array  = wp_upload_dir();
                                 // $path = str_replace('\\', '/', $path_array['path']);
                                    $path = str_replace('\\', '/', $path_array['basedir']).'/documents'; 
                                  $old_name = $_FILES["file"]["name"];
                                  $split_name = explode('.',$old_name);
                                  $time = time();
                                  $file_name = $time.".".$split_name[1];
                                   
                                  $tmp_name = $_FILES["file"]["tmp_name"];
                              



                                      move_uploaded_file($_FILES["file"]["tmp_name"],$path. "/" . $old_name);
                                   
                                      $path2 = $path. "/" . $old_name;
                                   // echo"$path2";
                                      //this code for insert into carimage working but not moving files 
                                   //$wpdb->insert( 'carimage', array('image' => $path2,'carid' => 37,'description' => $_POST['make'],'created' => $created,'updated' => $updated) );
                                  //  mysql_query("INSERT INTO" . $wpdb->prefix."addressbook (image,carid,description,created,updated) VALUES ('$path2','$x','$makeid','$created','$updated') ON DUPLICATE KEY UPDATE image='$path2',description='$makeid',updated='$updated'");
                                  }
		$id = $_POST['id'];
		if(!empty($path2)) {
		$sql = "UPDATE " . $wpdb->prefix."addressbook SET
				f_name = '" . $_POST['f_name'] ."',
				m_name = '" . $_POST['m_name'] ."',
				l_name = '" . $_POST['l_name'] ."',
				email = '" . $_POST['email'] ."',
				address = '" . $_POST['address'] ."',
				phone = '" . $_POST['phone'] ."',
				gender = '" . $_POST['gender'] ."',
				p_url = '" . $path2 ."',
				interest = '" . $cartype ."',
				birthdate = '" . $_POST['yearofbirth'] ."'
				WHERE id = " . $_POST['id'];	
			}
		else {
		$sql = "UPDATE " . $wpdb->prefix."addressbook SET
				f_name = '" . $_POST['f_name'] ."',
				m_name = '" . $_POST['m_name'] ."',
				l_name = '" . $_POST['l_name'] ."',
				email = '" . $_POST['email'] ."',
				address = '" . $_POST['address'] ."',
				phone = '" . $_POST['phone'] ."',
				gender = '" . $_POST['gender'] ."',
				interest = '" . $cartype ."',
				birthdate = '" . $_POST['yearofbirth'] ."'
				WHERE id = " . $_POST['id'];	
			}
	
		 mysql_query($sql); 		
		$msg = 'Data has been updated successfully';
		
	 } 
	 else
	 {
	 	if ($_FILES["file"]["error"] > 0)
                                      {
                                      echo "Error: " . $_FILES["file"]["error"] . "<br>";
                                      }
                                    else
                                      {
                                                                                                      
                                  $path_array  = wp_upload_dir();
                                 // $path = str_replace('\\', '/', $path_array['path']);
                                  $path = str_replace('\\', '/', $path_array['basedir']).'/documents';
                                    
                                  $old_name = $_FILES["file"]["name"];
                                  $split_name = explode('.',$old_name);
                                  $time = time();
                                  $file_name = $time.".".$split_name[1];
                                   
                                  $tmp_name = $_FILES["file"]["tmp_name"];
                              



                                      move_uploaded_file($_FILES["file"]["tmp_name"],$path. "/" . $old_name);
                                   
                                      $path2 = $path. "/" . $old_name;
                                   // echo"$path2";
                                      //this code for insert into carimage working but not moving files 
                                   //$wpdb->insert( 'carimage', array('image' => $path2,'carid' => 37,'description' => $_POST['make'],'created' => $created,'updated' => $updated) );
                                  //  mysql_query("INSERT INTO" . $wpdb->prefix."addressbook (image,carid,description,created,updated) VALUES ('$path2','$x','$makeid','$created','$updated') ON DUPLICATE KEY UPDATE image='$path2',description='$makeid',updated='$updated'");
                                  }
		$sql = "INSERT INTO " . $wpdb->prefix."addressbook (f_name,m_name,l_name,email,address,phone,gender,birthdate,p_url,interest) VALUES ('" . $_POST['f_name'] ."', '" . $_POST['m_name'] ."', '" . $_POST['l_name'] ."', '" . $_POST['email'] ."', '" . $_POST['address'] ."', '" . $_POST['phone'] ."', '" . $_POST['gender'] ."', '" . $_POST['yearofbirth'] ."', '" . $path2 ."', '" . $cartype ."')"; 
	
		mysql_query($sql); 
		$id = mysql_insert_id();
		$msg = 'Data has been added successfully';
		
	 }
	 
	
	
 }
 
 
 if($id)
 {
  
 $sql = "SELECT * FROM " . $wpdb->prefix."addressbook WHERE id = ".$id; 
 $info = $wpdb->get_row($sql);  

 }
   if(isset($info->interest)) 
            {
$ami=$info->interest;

                $cartype1 = implode(',', (array)$ami); 
               $productid_arr = explode(',' , $cartype1); 
                //$productid_arr = explode(',' , $info->interest);
                //$cartype = $_POST['cartype'];
            }
            else 
            {
                $cartype1 = "";
                $productid_arr = explode(',' , $cartype1); 
            } 
?>

<div style="width:90%">
	<div style="margin-top:20px">&nbsp;</div>
	<div style="background-color:#218af4; height:7px; margin-top:10px; border:1px solid #218af4; overflow:hidden;"></div>
	<div style="float:left;margin-top:10px;font-weight:bold"><?php echo isset($msg) ? $msg : ''; ?> </div><div class="add_new"> <a href="<?php echo get_site_url();?>/wp-admin/admin.php?page=my_list_test"> View All</a></div>
	<form enctype="multipart/form-data" class="contact-reply-form" method="post" action="">
	<input type="hidden" name="id" value="<?php echo $id;?>" />
	<input type="hidden" name="email" value="<?php echo $info->email;?>" />
		 <table>
		 <tr>
		 	<td><strong> Name </strong></td>
		 	<td>
		 		<input type="text" name="f_name" placeholder="First name" value="<?php echo isset($info->f_name) ? $info->f_name : ''; ?>" style="width:233px;height:39px;border-radius: 10px;border: 2px solid;">
		 		<input type="text" name="m_name" placeholder="Middle name" value="<?php echo isset($info->m_name) ? $info->m_name : ''; ?>" style="width:233px;height:39px;border-radius: 10px;border: 2px solid;">
		 		<input type="text" name="l_name" placeholder="Last name" value="<?php echo isset($info->l_name) ? $info->l_name : ''; ?>" style="width:233px;height:39px;border-radius: 10px;border: 2px solid;">
		 	</td>
		 </tr>
		 <tr><td><strong> Address </strong></td>
		 	<td> 
		 		<?php $settings = array( 'media_buttons' => false ); 
		 		$content = isset($info->address) ? $info->address : '';?> 
		 		<?php wp_editor($content, 'address', $settings); ?> 
		 	</td>
		 </tr>
		 <tr>
		 	<td><strong> Phone </strong></td>
		 	<td>
		 		<input type="text" name="phone" value="<?php echo isset($info->phone) ? $info->phone : ''; ?>" style="width:444px;height:39px;border-radius: 10px;border: 2px solid;">
		 	</td>
		 </tr>
		 <tr>
		 	<td><strong> E-Mail </strong></td>
		 	<td>
		 		<input type="text" name="email" value="<?php echo isset($info->email) ? $info->email : ''; ?>" style="width:444px;height:39px;border-radius: 10px;border: 2px solid;">
		 	</td>
		 </tr>
		 <tr>
		 	<td><strong>Gender: </strong></td>
		 	<td>
		 		
		 		<input type="radio" name="gender"  value="F" class="radio3" <?php if (isset($info->gender) && $info->gender=="F") echo "checked";?>>
                    <label for="r1"><span class="setting_radio_text">Female</span></label>
                <input type="radio" name="gender" value="M" class="radio3" <?php if (isset($info->gender) && $info->gender=="M") echo "checked";?>>
                    <label for="r2"><span class="setting_radio_text"> Male </span></label>
		 	</td>
		 </tr>
		 <tr>
		 	<td><strong>Date of Birth: </strong></td>
		 	<td>
		 	

		 		<input type="text" id="yearofbirth" name="yearofbirth" value="<?php echo isset($info->birthdate) ? $info->birthdate : ''; ?>" style="background: white;" placeholder="<?php _e('Birth year', 'beopen'); ?>" />
		 	</td>
		 </tr>
		<tr>
		 	<td><strong>Front Image: </strong></td>
		 	<td>
	          	<div class="row image">                   
	          	   <?php 
	          	   //if (isset($info->p_url) ){

                                                             
                                                                if(!empty($info->p_url)) 
                                                      {
                                                      	 $image=$info->p_url;
                                                              //$image_id=explode('F:/xampp/htdocs/wordpresstest', $image);
                                                             // $image_id=$image_id[1];
                                                            $path_array  = wp_upload_dir();
                                                             $path = str_replace('\\', '/', $path_array['basedir']).'/documents';
                                                          //  $path = str_replace('\\', '/', $path_array['path']);
                                                           // $split_name = explode('.',$old_name);
                                                            $image_id = explode($path, $image);
                                                            $image_id = $image_id[1];
                                                              
                                                            ?>
                                                       <img src="<?php echo site_url(); ?>/wp-content/uploads/documents/<?php echo $image_id; ?>" width="150"height="130" style="float: left;width: 203px;margin-right: 8px;"/> 
                                                    
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
                                                      //    } ?>
                                                      <div style="float: left;width: 100%;">
			                                                  	<Label for="file">ADD Picture:</label> 
			                                                    <input type="file" name="file" id="file">
			                                                </div>
                                                         
                                                            


                                                        
                                                 

                                                
	                                   

	            </div>      
            </td>
		</tr> 
		 <tr>
		 	<td><strong>Date of Birth: </strong></td>
		 	<td>
		 		<?php 
		 		$aid= "it";
		 		$aid2= "business";
		 		$aid3= "others";
		 		//echo $cartype1;
		 		if(in_array($aid,$productid_arr)) 
                            {
                                $check = 'checked';
                            } 
                            else
                            {
                                $check = '';
                            }
                            if(in_array($aid2,$productid_arr)) 
                            {
                                $check2 = 'checked';
                            } 
                            else
                            {
                                $check2 = '';
                            }
                            if(in_array($aid3,$productid_arr)) 
                            {
                                $check3 = 'checked';
                            } 
                            else
                            {
                                $check3 = '';
                            }
                            ?>
		 		<input type="checkbox" name="interest[]" value="it" <?php echo $check;?>> It service<br /> 
		 		<input type="checkbox" name="interest[]" value="business" <?php echo $check2;?>> Business <br /> 
		 		<input type="checkbox" name="interest[]" value="others" <?php echo $check3;?>> Others <br />      
			</td>
		</tr>

		 <tr><td colspan="2" align="center"><input type="submit" name="contact_form" value="SAVE" style="padding:5px 10px;font-weight:bold"></td></tr>
		 </table>
	</form>
	<div style="background-color:#218af4; height:7px; margin-top:10px; border:1px solid #218af4; overflow:hidden;"></div>
</div>	