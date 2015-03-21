<?php
/*
When The form is submitted foloowing section is used
Do Add/Edit
*/
global $wpdb;

if($_POST['contact_form'])
{

	 // global $wpdb;
	 if($_POST['id'])
	 {
		$id = $_POST['id'];
		$sql = "UPDATE '" . $wpdb->prefix."'addressbook SET
				f_name = '" . $_POST['f_name'] ."',
				email = '" . $_POST['email'] ."'
				WHERE id = " . $_POST['id'];		
		 mysql_query($sql); 		
		$msg = 'Data has been updated successfully';
		
	 } 
	 else
	 {
		$sql = "INSERT INTO " . $wpdb->prefix."addressbook (f_name, email) VALUES ('" . $_POST['f_name'] ."', '" . $_POST['email'] ."')"; 
		mysql_query($sql); 
		$id = mysql_insert_id();
		$msg = 'Data has been added successfully';
		
	 }
	 
	
	
 }
 
 
 if($id)
 {
  
 $sql = "SELECT * FROM " . $wpdb->prefix."addressbook WHERE id = $id"; 
 $info = $wpdb->get_row($sql);  
 }
 
?>

<div style="width:90%">
	<div style="margin-top:20px">&nbsp;</div>
	<div style="background-color:#218af4; height:7px; margin-top:10px; border:1px solid #218af4; overflow:hidden;"></div>
	<div style="float:left;margin-top:10px;font-weight:bold"><?php echo isset($msg) ? $msg : ''; ?> </div><div class="add_new"> <a href="<?php echo get_site_url();?>/wp-admin/admin.php?page=my_list_test"> View All</a></div>
	<form class="contact-reply-form" method="post" action="">
	<input type="hidden" name="id" value="<?php echo $id;?>" />
		 <table>
		 <tr><td><strong> Name </strong></td><td><input type="text" name="f_name" value="<?php echo isset($info->subject) ? $info->f_name : ''; ?>" style="width:450px;height:25px"></td></tr>
		 <tr><td><strong> Email </strong></td><td> <?php $settings = array( 'media_buttons' => false ); $content = isset($info->email) ? $info->email : '';?> <?php wp_editor($content, 'emai', $settings); ?> </td></tr>
		 <tr><td colspan="2" align="center"><input type="submit" name="contact_form" value="SAVE" style="padding:5px 10px;font-weight:bold"></td></tr>
		 </table>
	</form>
	<div style="background-color:#218af4; height:7px; margin-top:10px; border:1px solid #218af4; overflow:hidden;"></div>
</div>	