<?php
/**
 * @package FRMTech Address book 
 * @version 1.0
 */
/*
Plugin Name: FRMTech Address book 
Plugin URI: https://github.com/lemonkazi/wp-banglamce
Description: By the simple address book plugin, a login user can view, add, edit their contact 
information from user side of the website. 
And from backhand /Admin side a admin user can view, add, edit and delete the 
user 's  information's. 
Author: Kazi Abdullah Al Mamun (Lemon) 
Version: 1.0
Author URI: http://lemon.it4gen.com/
*/
// add_action( 'init', 'wp29r01_date_picker' );
// function wp29r01_date_picker() {
//     wp_enqueue_script( 'jquery' );
//     wp_enqueue_script( 'jquery-ui-core' );
//     wp_enqueue_script( 'jquery-datepicker', 'http://jquery-ui.googlecode.com/svn/trunk/ui/jquery.ui.datepicker.js', array('jquery', 'jquery-ui-core' ) );
// }

add_action( 'wp_footer', 'wp29r01_print_scripts');
function wp29r01_print_scripts() {
    ?>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('#MyDate').datepicker();
    })
</script>
    <?php
}
function wptuts_scripts_basic()
{
    // Register the script like this for a plugin:
  //  wp_register_script( 'custom-script', plugins_url( '/js/jsDatePick.min.1.3.js', __FILE__ ) );
    // or
    // Register the script like this for a theme:
  //  wp_register_script( 'custom-script', get_template_directory_uri() . '/js/jsDatePick.min.1.3.js' );
// wp_enqueue_script('jquery');
//   //wp_enqueue_script('the_js', WP_PLUGIN_URL.'/frm-addressbook/js/jsDatePick.min.1.3.js');
//   wp_enqueue_script('the_js', plugins_url('/js/jsDatePick.min.1.3.js',__FILE__) );
//   wp_enqueue_script('the_js', plugins_url('/js/aaa.js',__FILE__) );
  //if (is_admin()) {
  wp_enqueue_script('jquery-ui-datepicker');
wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
//wp_enqueue_style('e2b-admin-ui-css','http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/themes/base/jquery-ui.css',false,"1.9.0",false);

//}

        //echo "test";
  //   if (!is_admin()) {
    // wp_enqueue_script('the_js', plugins_url('/js/jsDatePick.min.1.3.js',__FILE__) );
    // wp_enqueue_script('the_js', plugins_url('/js/aaa.js',__FILE__) );
  //  wp_enqueue_script('jquery-ui-datepicker');
//wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');

  //}
 
    // For either a plugin or a theme, you can then enqueue the script:
   // wp_enqueue_script( 'custom-script' );
}
add_action('wp_head', 'wptuts_scripts_basic');
add_action('wp_enqueue_scripts', 'wptuts_scripts_basic'); 
add_action('wp_enqueue_scripts','wptuts_scripts_basic');
//add_action('init','wptuts_scripts_basic'); 


function add_e2_date_picker(){
//jQuery UI date picker file
wp_enqueue_script('jquery-ui-datepicker');
//jQuery UI theme css file
wp_enqueue_style('e2b-admin-ui-css','http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/themes/base/jquery-ui.css',false,"1.9.0",false);
}
add_action('admin_enqueue_scripts', 'add_e2_date_picker'); 

function register_datepiker_submenu() {
    add_submenu_page( 'options-general.php', 'Date Picker', 'Date Picker', 'manage_options', 'date-picker', 'datepiker_submenu_callback' );
}

function datepiker_submenu_callback() { ?>

    <div class="wrap">

    <input type="text" class="datepicker" name="datepicker" value=""/>

    </div>

    <script>
    jQuery(function() {
        jQuery( ".datepicker" ).datepicker({
            dateFormat : "yy-mm-dd"
        });
    });
    
    </script> 

<?php }
add_action('admin_menu', 'register_datepiker_submenu');


function wptuts_styles_with_the_lot()
{
    // Register the style like this for a plugin:
    wp_register_style( 'custom-style', plugins_url( '/css/style.css', __FILE__ ), array(), '20120208', 'all' );
    // or
    // Register the style like this for a theme:
   // wp_register_style( 'custom-style', get_template_directory_uri() . '/css/custom-style.css', array(), '20120208', 'all' );
 
    // For either a plugin or a theme, you can then enqueue the style:
    wp_enqueue_style( 'custom-style' );
}
 add_action( 'wp_enqueue_scripts', 'wptuts_styles_with_the_lot' );
 add_action('wp_head', 'wptuts_styles_with_the_lot');
// //add_action( 'wp_enqueue_scripts', 'wptuts_scripts_basic' );
// add_action('wp_enqueue_scripts','wptuts_styles_with_the_lot');
// add_action('init','wptuts_styles_with_the_lot'); 

global $jal_db_version;
$jal_db_version = '1.0';

function jal_install() {
	global $wpdb;
	global $jal_db_version;

	$table_name = $wpdb->prefix . 'addressbook';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		birthdate date DEFAULT '0000-00-00 00:00:00' NOT NULL,
		f_name tinytext NOT NULL,
		m_name tinytext NOT NULL,
		l_name tinytext NOT NULL,
		address tinytext NOT NULL,
		phone tinytext NOT NULL,
		email tinytext NOT NULL,
		gender tinytext NOT NULL,
		interest varchar(55) DEFAULT '' NOT NULL,
		p_url varchar(111) DEFAULT '' NULL,
		PRIMARY KEY (id),
		UNIQUE KEY id (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

	add_option( 'jal_db_version', $jal_db_version );
}
register_activation_hook( __FILE__, 'jal_install' );
register_activation_hook( __FILE__, 'jal_install_data' );

function jal_install_data() {
	global $wpdb;
	
	$welcome_name = 'Mr. WordPress';
	$welcome_text = 'Congratulations, you just completed the installation!';
	
	$table_name = $wpdb->prefix . 'addressbook';
	
	$wpdb->insert( 
		$table_name, 
		array( 
			'time' => current_time( 'mysql' ), 
			'name' => $welcome_name, 
			'text' => $welcome_text, 
		) 
	);
}






if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class My_Example_List_Table extends WP_List_Table {





    var $example_data = array(
            array( 'ID' => 1,'booktitle' => 'Quarter Share', 'author' => 'Nathan Lowell', 
                   'isbn' => '978-0982514542' ),
            array( 'ID' => 2, 'booktitle' => '7th Son: Descent','author' => 'J. C. Hutchins',
                   'isbn' => '0312384378' ),
            array( 'ID' => 3, 'booktitle' => 'Shadowmagic', 'author' => 'John Lenahan',
                   'isbn' => '978-1905548927' ),
            array( 'ID' => 4, 'booktitle' => 'The Crown Conspiracy', 'author' => 'Michael J. Sullivan',
                   'isbn' => '978-0979621130' ),
            array( 'ID' => 5, 'booktitle'     => 'Max Quick: The Pocket and the Pendant', 'author'    => 'Mark Jeffrey',
                   'isbn' => '978-0061988929' ),
            array('ID' => 6, 'booktitle' => 'Jack Wakes Up: A Novel', 'author' => 'Seth Harwood',
                  'isbn' => '978-0307454355' )
        );
    // function __construct(){
    // global $status, $page;

    //     parent::__construct( array(
    //         'singular'  => __( 'book', 'mylisttable' ),     //singular name of the listed records
    //         'plural'    => __( 'books', 'mylisttable' ),   //plural name of the listed records
    //         'ajax'      => false        //does this table support ajax?

    // ) );


    // add_action( 'admin_head', array( &$this, 'admin_header' ) );            

    // }

    //  function __construct() {
    //    parent::__construct( array(
    //   'singular'=> 'wp_list_text_link', //Singular label
    //   'plural' => 'wp_list_test_links', //plural label, also this well be one of the table css class
    //   'ajax'   => false //We won't support Ajax for this table
    //   ) );
    //     //add_action( 'admin_head', array( &$this, 'admin_header' ) ); 
    // }
   public function __construct(){
        global $status, $page;

        //Set parent defaults
        parent::__construct( array(
            'singular'  => 'item',     //singular name of the listed records
            'plural'    => 'items',    //plural name of the listed records
            'ajax'      => false        //does this table support ajax?
        ) );

    }
    // function process_bulk_action() {

    //     //Detect when a bulk action is being triggered...
    //     if( 'delete'===$this->current_action() ) {
    //         foreach($_GET['item'] as $video) {
    //             //$video will be a string containing the ID of the video
    //             //i.e. $video = "123";
    //             //so you can process the id however you need to.
    //             delete_this_video($video);
    //         }
    //     }

   // }
//     public function process_bulk_action() {        
//     $entry_id = ( is_array( $_REQUEST['id'] ) ) ? $_REQUEST['id'] : array( $_REQUEST['id'] );

//     if ( 'delete' === $this->current_action() ) {
//         global $wpdb;

//         foreach ( $entry_id as $id ) {
//             $id = absint( $id );
//             $wpdb->query( "DELETE FROM" .$wpdb->prefix. "addressbook WHERE id=".$id);
//             //"DELETE FROM " . $wpdb->prefix."addressbook WHERE id=".$id;
//         }
//     }
// }


   public function process_bulk_action() {

        // security check!
        // if ( isset( $_POST['_wpnonce'] ) && ! empty( $_POST['_wpnonce'] ) ) {

        //     $nonce  = filter_input( INPUT_POST, '_wpnonce', FILTER_SANITIZE_STRING );
        //     $action = 'bulk-' . $this->_args['items'];

        //     if ( ! wp_verify_nonce( $nonce, $action ) )
        //         wp_die( 'Nope! Security check failed!' );

        // }

// $action = $_REQUEST['action'];
  // switch ($action) {
  
  //   case add:
  //   contact_form();
  //   break;
    
  //   case edit:
  //   contact_form();
  //   break;
    
  //   case delete:
  //   delete();
  //   break;
    
  //   default:
  //   list_contact();
  //   break;
  // }
        $action = $this->current_action();

        switch ( $action ) {

            case 'delete':
                //wp_die( 'Delete something' );
                
              //  if( 'delete'===$this->current_action() ) {
                  //foreach($_GET['item'] as $video) {
                      //$video will be a string containing the ID of the video
                      //i.e. $video = "123";
                      //so you can process the id however you need to.
                     // delete_this_video($video);
            $video1=$_REQUEST['id'];
                      delete1($video1);
                 // }
             // }
                break;

            // case 'edit':
            //    // wp_die( 'Save something' );
            //      contact_form();
            //      //break;
            //     break;

            default:
                // do nothing or something else
              list_contact();
                return;
                break;
        }

        return;
    }
     // Handle bulk actions
    // function process_bulk_action() {
    //     // Define our data source
    //     if (defined('WP_ALLOW_MULTISITE') && WP_ALLOW_MULTISITE == true) {
    //         $themes = get_allowed_themes();
    //     } else {
    //         $themes = get_themes();
    //     }

    //     if ('update' === $this->current_action()) {
    //         foreach ($themes as $theme) {
    //             if ($theme['Stylesheet'] . '_status' == 'checked') {
    //                 // Do stuff - here's the problem
    //             }
    //         }
    //     }
    // }

  function admin_header() {
    $page = ( isset($_GET['page'] ) ) ? esc_attr( $_GET['page'] ) : false;
    if( 'my_list_test' != $page )
    return;
    echo '<style type="text/css">';
    echo '.wp-list-table .column-id { width: 5%; }';
    echo '.wp-list-table .column-booktitle { width: 40%; }';
    echo '.wp-list-table .column-author { width: 35%; }';
    echo '.wp-list-table .column-isbn { width: 20%;}';
    echo '</style>';
  }

 // public function no_items() {
 //    _e( 'No books found, dude.' );
 //  }

  function column_default( $item, $column_name ) {
    switch( $column_name ) { 
        case 'booktitle':
        case 'author':
        case 'isbn':
            return $item[ $column_name ];
        default:
            return print_r( $item, true ) ; //Show the whole array for troubleshooting purposes
    }
  }

public function get_sortable_columns() {
   return $sortable = array(
      'id'=>'id',
      'f_name'=>'f_name',
      'phone'=>'phone'
   );
}
function extra_tablenav( $which ) {
   if ( $which == "top" ){
      //The code that goes before the table is here
     // echo"Hello, I'm before the table";
   }
   if ( $which == "bottom" ){
      //The code that goes after the table is there
     // echo"Hi, I'm after the table";
    echo '<div style="float:left;margin-top:10px;font-weight:bold">' . $msg . ' </div><div class="add_new1" style="
    float: left;    padding: 5px;    font-weight: bold;    border: 1px solid #ccc;    border-radius: 10px;    height: 20px;    margin: 10px 0;    background-color: #F6F6F6;
"> <a href="' . get_site_url() . '/wp-admin/admin.php?page=my_list_test&action=add"> Add Contact</a>
  </div>';
   }
}
public function get_columns() {
   return $columns= array(
      'cb'        => '<input type="checkbox" />',
      'id'=>__('ID'),
      'f_name'=>__('Name'),
      'email'=>__('email'),
      'phone'=>__('phone'),
      'options'=>__('Options')
   );
}

function usort_reorder( $a, $b ) {
  // If no sort, default to title
  $orderby = ( ! empty( $_GET['orderby'] ) ) ? $_GET['orderby'] : 'booktitle';
  // If no order, default to asc
  $order = ( ! empty($_GET['order'] ) ) ? $_GET['order'] : 'asc';
  // Determine sort order
  $result = strcmp( $a[$orderby], $b[$orderby] );
  // Send final sort direction to usort
  return ( $order === 'asc' ) ? $result : -$result;
}

function column_booktitle($rec){
  $actions = array(
            'edit'      => sprintf('<a href="?page=my_list_test&action=%s&id=%s">Edit</a>','edit',$rec->id),
            'delete'    => sprintf('<a onclick="javascript:return confirmation()" href="?page=my_list_test&action=%s&id=%s"">Delete</a>','delete',$item['id']),
            //'delete'    => sprintf('<a href="' . get_site_url() . '/wp-admin/admin.php?page=configure-contact&action=delete&id=' . $item['id'] . '">Delete</a>',$_REQUEST['page'],'delete',$item['ID']),
          
        );

  return sprintf('%1$s %2$s', $item['id'], $this->row_actions($actions) );
}

public function get_bulk_actions() {
        $actions = array();

        $actions['edit'] ='<a href="?page=my_list_test&action=edit&id=' . $rec->id . '">Edit</a>';
               // $actions['reject'] = '<a href="#">'.__( 'Reject' ).'</a>';
                $actions['delete'] = '<a onclick="javascript:return confirmation()"  href="?page=my_list_test&action=delete&id=' . $rec->id . '">'.__( 'Delete' ).'</a>';
             //   $actions['view'] = '<a href="#">'.__( 'View' ).'</a>';


        return $actions;
    }

public function get_bulk_actions1($rec) {
        $actions = array();

        $actions['edit'] ='<a href="?page=my_list_test&action=edit&id=' . $rec->id . '">Edit</a>';
               // $actions['reject'] = '<a href="#">'.__( 'Reject' ).'</a>';
                $actions['delete'] = '<a onclick="javascript:return confirmation()"  href="?page=my_list_test&action=delete&id=' . $rec->id . '">'.__( 'Delete' ).'</a>';
             //   $actions['view'] = '<a href="#">'.__( 'View' ).'</a>';


        return $actions;
    }


// public function get_bulk_actions() {
//   $actions = array(
//     'delete'    => 'Delete',
//     'edit'    => 'Edit'
//   );
//   return $actions;
// }




function column_cb($item) {
        return sprintf(
            //'<input type="checkbox" name="id[]" value="%s" />', $item['id']
           '<input type="checkbox" name="%1$s[]" value="%2$s" />',
            /*$1%s*/ $this->_args['singular'],  //Let's simply repurpose the table's singular label ("video")
            /*$2%s*/ $item->id             //The value of the checkbox should be the record's id
        );    
    }
    // Displaying checkboxes!
    // function column_cb($item) {
    //     return sprintf(
    //         '<input type="checkbox" name="%1$s" id="%2$s" value="checked" />',
    //         //$this->_args['singular'],
    //         $item['id'] . '_status',
    //         $item['id'] . '_status'
    //     );
    // }

// function prepare_items() {
//   $columns  = $this->get_columns();
//   $hidden   = array();
//   $sortable = $this->get_sortable_columns();
//   $this->_column_headers = array( $columns, $hidden, $sortable );
//   usort( $this->example_data, array( &$this, 'usort_reorder' ) );
  
//   $per_page = 5;
//   $current_page = $this->get_pagenum();
//   $total_items = count( $this->example_data );

//   // only ncessary because we have sample data
//   $this->found_data = array_slice( $this->example_data,( ( $current_page-1 )* $per_page ), $per_page );

//   $this->set_pagination_args( array(
//     'total_items' => $total_items,                  //WE have to calculate the total number of items
//     'per_page'    => $per_page                     //WE have to determine how many items to show on a page
//   ) );
//   $this->items = $this->found_data;
// }


  public  function prepare_items() {
   global $wpdb, $_wp_column_headers;

    $query = "SELECT * FROM " . $wpdb->prefix."addressbook"; 
     if(isset($_POST['beopen_form']) )
    {
       $email=$_POST['email'];
       $name=$_POST['name'];
       $phone=$_POST['phone'];
     $conditions = array();
     if(!empty($colourId)) 
            {
              $conditions[] = "email='$email'";
            }
            if(!empty($name)) 
            {
              $conditions[] = "f_name='$name'";
            }
            if(!empty($phone)) 
            {
              $conditions[] = "phone='$phone'";
            }
          }
          if (count($conditions) > 0) {
              $query .= " WHERE " . implode(' AND ', $conditions);
            }
 //$result = $wpdb->get_results($sql); 
       /* Handle our bulk actions */
       // $this->process_bulk_action();
   $screen = get_current_screen();

   /* -- Preparing your query -- */

       // $query = "SELECT * FROM $wpdb->links";

   /* -- Ordering parameters -- */
       //Parameters that are going to be used to order the result
       $orderby = !empty($_GET["orderby"]) ? mysql_real_escape_string($_GET["orderby"]) : 'ASC';
       $order = !empty($_GET["order"]) ? mysql_real_escape_string($_GET["order"]) : '';
       if(!empty($orderby) & !empty($order)){ $query.=' ORDER BY '.$orderby.' '.$order; }

   /* -- Pagination parameters -- */
        //Number of elements in your table?
        $totalitems = $wpdb->query($query); //return the total number of affected rows
        //How many to display per page?
        $perpage = 5;
        //Which page is this?
        $paged = !empty($_GET["paged"]) ? mysql_real_escape_string($_GET["paged"]) : '';
        //Page Number
        if(empty($paged) || !is_numeric($paged) || $paged<=0 ){ $paged=1; }
        //How many pages do we have in total?
        $totalpages = ceil($totalitems/$perpage);
        //adjust the query to take pagination into account
       if(!empty($paged) && !empty($perpage)){
          $offset=($paged-1)*$perpage;
         $query.=' LIMIT '.(int)$offset.','.(int)$perpage;
       }


   /* -- Register the pagination -- */
      $this->set_pagination_args( array(
         "total_items" => $totalitems,
         "total_pages" => $totalpages,
         "per_page" => $perpage,
      ) );
      //The pagination links are automatically built according to those parameters

   /* -- Register the Columns -- */
      $columns = $this->get_columns();
      $_wp_column_headers[$screen->id]=$columns;

   /* -- Fetch the items -- */
  // $sql = $query;
            
      $this->items = $wpdb->get_results($query);
         //$this->process_bulk_action();
}

function display_rows() {

   //Get the records registered in the prepare_items method
   $records = $this->items;

   //Get the columns registered in the get_columns and get_sortable_columns methods
   list( $columns, $hidden ) = $this->get_column_info();

   //Loop for each record
   if(!empty($records)){foreach($records as $rec){

      //Open the line
        echo '<tr id="record_'.$rec->id.'">';
      foreach ( $columns as $column_name => $column_display_name ) {
//echo "string";
         //Style attributes for each col
         $class = "class='$column_name column-$column_name'";
         $style = "";
         if ( in_array( $column_name, $hidden ) ) $style = ' style="display:none;"';
         $attributes = $class . $style;

         //edit link
         $editlink  = '/wp-admin/link.php?action=edit&link_id='.(int)$rec->id;
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
         //Display the cell
         switch ( $column_name ) {
            case "id":  echo '<th class="check-column"><input type="checkbox" name="id[]" value='.stripslashes($rec->id).'></th>';
            case "id":  echo '<td '.$attributes.'>'.stripslashes($rec->id);
            $actions = $this->get_bulk_actions1($rec);

                    echo $this->row_actions( $actions );
                                     echo '</td>';   break;
            case "f_name": echo '<td '.$attributes.'>'.stripslashes($rec->f_name).'</td>'; break;
            case "phone": echo '<td '.$attributes.'>'.$rec->phone.'</td>'; break;
            case "email": echo '<td '.$attributes.'>'.stripslashes($rec->email).'</td>'; break;
            
            //case "address": echo '<td '.$attributes.'>'.$rec->address.'</td>'; break;
            case "options":
            echo '<td '.$attributes.'> <a href="' . get_site_url() . '/wp-admin/admin.php?page=my_list_test&action=edit&id=' . $rec->id . '"> Edit </a> | <a onclick="javascript:return confirmation()" href="' . get_site_url() . '/wp-admin/admin.php?page=my_list_test&action=delete&id=' . $rec->id . '"> Delete</a></td>';
  
            
         }
      }

      //Close the line
      echo'</tr>';
   }}
}


} //class



function my_add_menu_items(){
 $hook = add_menu_page( 'My Plugin List Table', 'My List Table Example', 'activate_plugins', 'my_list_test', 'my_render_list_page' );
  add_action( "load-$hook", 'add_options' );
}

function add_options() {
  global $myListTable;
  $option = 'per_page';
  $args = array(
         'label' => 'Books',
         'default' => 10,
         'option' => 'books_per_page'
         );
  add_screen_option( $option, $args );
  $myListTable = new My_Example_List_Table();
}
add_action( 'admin_menu', 'my_add_menu_items' );
// function delete()
// {
//   global $wpdb;
//   $id = $_REQUEST['id'];
//   $sql = "DELETE FROM " . $wpdb->prefix."addressbook WHERE id=".$id;
//   mysql_query($sql);
//   list_contact('delete');
// }


function my_render_list_page(){
  global $myListTable;
  $action = $_REQUEST['action'];
  switch ($action) {
  
    case add:
    contact_form();
    break;
    
    case edit:
    contact_form();
    break;
    
    case delete:
    delete();
    break;
    
    default:
    list_contact();
    break;
  }
  echo '</pre><div class="wrap"><h2>My List Table Test</h2>'; 
  ?>
  <form method="post">
    <div>
      <label>Search Contact</label>
    </div>
    <label>Search:</label>
    <input type="text" name="name" value="" placeholder="By name" />
  <input type="text" name="email" value="" placeholder="By email" />
  <input type="text" name="phone" value="" placeholder="By phone" />
  
  <input type="hidden" name="beopen_form" value="1" />
            <button class="button send-message" type="submit">
                <span class="send-message"></span><?php _e('Search', 'beopen'); ?>
            </button>
  </form>
 

  <?php

//  $table = new WPSE_List_Table();

//printf( '<div class="wrap" id="wpse-list-table"><h2>%s</h2>', __( 'Your List Table', 'your-textdomain' ) );

//echo '<form id="wpse-list-table-form" method="post">';

$page  = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_STRIPPED );
$paged = filter_input( INPUT_GET, 'paged', FILTER_SANITIZE_NUMBER_INT );

printf( '<input type="hidden" name="page" value="%s" />', $page );
printf( '<input type="hidden" name="paged" value="%d" />', $paged );

  $myListTable->prepare_items(); 
  //$table->display();

//echo '</form>';

//echo '</div>';
?>

   <form method="post">

     
    <input type="hidden" name="page" value="my_list_test">
    <?php
    // $myListTable->search_box( 'search', 'search_id' );

   $myListTable->display(); 
 echo '</form>

</div>'; 
}








function addressbook_list() {
 global $wpdb;
 $sql = "SELECT * FROM " . $wpdb->prefix."addressbook"; 
 $result = $wpdb->get_results($sql); 
 return $result;



}

// Now we set that function up to execute when the admin_notices action is called
add_action('admin_menu', 'addresslist_admin');

 
function addresslist_admin(){
      // add_menu_page( 'Addressbook Page', 'Address-book', 'manage_options', 'my_list_test', 'configure_contact' );
       
		//add_submenu_page( 'contact-and-reply-plugin', 'contact_list', 'view contact', 'contact-and-reply-plugin', 'viewContact',  );
		//add_options_page( 'Contact and Reply Page', 'View contact11','manage_options','contact-and-reply-plugin', 'viewContact' );
		//add_menu_page('My Custom Page', 'My Custom Page', 'manage_options', 'contact-and-reply-plugin');
        //add_submenu_page( 'configure-contact', 'View addresss', 'View address', 'manage_options', 'view-contact', 'viewContact');
        //add_submenu_page( 'configure-contact', 'View addresss', 'View address', 'manage_options', 'my_list_test', 'configure_contact');
		
}
 
 function viewContact()
 {
 //   $action = $_REQUEST['action'];
 //   if($action == 'exportToExcell')
 //   {
	// exportToExcell();	
 //   }
 //   else
 //   {
	 global $wpdb;
	 $sql = "select * FROM " . $wpdb->prefix."addressbook ORDER BY " . $wpdb->prefix ."addressbook.id DESC";
	 $result = $wpdb->get_results($sql); 	
     include('all_user_list.php');	
	//echo '<br /><br /><br /><b> <a href= "' . get_site_url() . '/wp-admin/admin.php?page=view-contact&action=exportToExcell">Download All Contacts.</a></b>';
 //  }
   
 }
 
 
 function exportToExcell()
 {
 
 $table = 'wp_contacts';
 $result = mysql_query("SHOW COLUMNS FROM ".$table."");
$i = 0;
if (mysql_num_rows($result) > 0) {
while ($row = mysql_fetch_assoc($result)) {
$csv_output .= $row['Field']."; ";
$i++;
}
}
$csv_output .= "\n";

$values = mysql_query("SELECT * FROM ".$table."");
while ($rowr = mysql_fetch_row($values)) {
for ($j=0;$j<$i;$j++) {
$csv_output .= $rowr[$j]."; ";
}
$csv_output .= "\n";
}

$filename = $file."_".date("Y-m-d_H-i",time());
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$filename.".csv");
print $csv_output;
exit;

}
 
function configure_contact(){


  $action = $_REQUEST['action'];
	switch ($action) {
	
		case add:
		contact_form();
		break;
		
		case edit:
		contact_form();
		break;
		
		case delete:
		delete();
		break;
		
		default:
		list_contact();
		break;
	}
}

function delete()
{
	global $wpdb;
 	$id = $_REQUEST['id'];
	$sql = "DELETE FROM " . $wpdb->prefix."addressbook WHERE id=".$id;
	mysql_query($sql);
	list_contact('delete');
}
function delete1($video1)
{
  global $wpdb;
  $id = $video1;
  $sql = "DELETE FROM " . $wpdb->prefix."addressbook WHERE id=".$id;
  mysql_query($sql);
  list_contact('delete');
}

function contact_form()
{
	$id = $_REQUEST['id'];
	include('address_form.php');
}

function list_contact($action_done = '')
{

    // action_done is used to show only add/edit/delete success operation message.	
	if(!$action_done)
	$action_done = $_REQUEST['action_done'];
	
	$resultList = addressbook_list();	
	
	//include('user_form_list.php');	
	//include('testlisttable_complete.php');	
}





add_action( 'admin_head', 'contact_reply');
add_action( 'wp_enqueue_scripts', 'contact_reply' );

function contact_reply()
{
 ?>

 
 <style type='text/css'>
 
	.add_new {
	float: right;
padding: 5px;
font-weight: bold;
border: 1px solid #ccc;
border-radius: 10px;
height: 20px;
margin: 10px 0;
background-color: #F6F6F6;
	}
	
	.add_new a{
	text-decoration:none;
	
	}
	</style>

<script type="text/javascript">	
 function confirmation()
 {
    if(confirm("Are you sure to Delete?"))
	return true;
	else
	return false;
 }
</script>
 <?php
}

class PageTemplater {
    /**
         * A Unique Identifier
         */
     protected $plugin_slug;
        /**
         * A reference to an instance of this class.
         */
        private static $instance;
        /**
         * The array of templates that this plugin tracks.
         */
        protected $templates;
        /**
         * Returns an instance of this class. 
         */
        public static function get_instance() {
                if( null == self::$instance ) {
                        self::$instance = new PageTemplater();
                } 
                return self::$instance;
        } 
        /**
         * Initializes the plugin by setting filters and administration functions.
         */
        private function __construct() {
                $this->templates = array();
                // Add a filter to the attributes metabox to inject template into the cache.
                add_filter(
          'page_attributes_dropdown_pages_args',
           array( $this, 'register_project_templates' ) 
        );
                // Add a filter to the save post to inject out template into the page cache
                add_filter(
          'wp_insert_post_data', 
          array( $this, 'register_project_templates' ) 
        );
                // Add a filter to the template include to determine if the page has our 
        // template assigned and return it's path
                add_filter(
          'template_include', 
          array( $this, 'view_project_template') 
        );
                // Add your templates to this array.
                $this->templates = array(
                        'address.php'     => 'It\'s Good to Be Bad',
                        'user_list_page.php'     => 'all user',
                        'single_user.php'     => 'single user',
                );
        
        } 
        /**
         * Adds our template to the pages cache in order to trick WordPress
         * into thinking the template file exists where it doens't really exist.
         *
         */
        public function register_project_templates( $atts ) {
                // Create the key used for the themes cache
                $cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );
                // Retrieve the cache list. 
        // If it doesn't exist, or it's empty prepare an array
        $templates = wp_get_theme()->get_page_templates();
                if ( empty( $templates ) ) {
                        $templates = array();
                } 
                // New cache, therefore remove the old one
                wp_cache_delete( $cache_key , 'themes');
                // Now add our template to the list of templates by merging our templates
                // with the existing templates array from the cache.
                $templates = array_merge( $templates, $this->templates );
                // Add the modified cache to allow WordPress to pick it up for listing
                // available templates
                wp_cache_add( $cache_key, $templates, 'themes', 1800 );
                return $atts;
        } 
        /**
         * Checks if the template is assigned to the page
         */
        public function view_project_template( $template ) {
                global $post;
                if (!isset($this->templates[get_post_meta( 
          $post->ID, '_wp_page_template', true 
        )] ) ) {
          
                        return $template;
            
                } 
                $file = plugin_dir_path(__FILE__). get_post_meta( 
          $post->ID, '_wp_page_template', true 
        );
        
                // Just to be safe, we check if the file exist first
                if( file_exists( $file ) ) {
                        return $file;
                } 
        else { echo $file; }
                return $template;
        } 
} 
add_action( 'plugins_loaded', array( 'PageTemplater', 'get_instance' ) );




?>
