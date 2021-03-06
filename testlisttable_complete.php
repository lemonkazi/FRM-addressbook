<?php


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
    function __construct(){
        global $status, $page;

        //Set parent defaults
        parent::__construct( array(
            'singular'  => 'item',     //singular name of the listed records
            'plural'    => 'items',    //plural name of the listed records
            'ajax'      => false        //does this table support ajax?
        ) );

    }
    function process_bulk_action() {

        //Detect when a bulk action is being triggered...
        if( 'delete'===$this->current_action() ) {
            foreach($_GET['item'] as $video) {
                //$video will be a string containing the ID of the video
                //i.e. $video = "123";
                //so you can process the id however you need to.
                delete_this_video($video);
            }
        }

    }

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

  function no_items() {
    _e( 'No books found, dude.' );
  }

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
"> <a href="' . get_site_url() . '/wp-admin/admin.php?page=configure-contact&action=add"> Add New</a>
  </div>';
   }
}
function get_columns() {
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

function column_booktitle($item){
  $actions = array(
            'edit'      => sprintf('<a href="?page=%s&action=%s&book=%s">Edit</a>',$_REQUEST['page'],'edit',$item['id']),
            'delete'    => sprintf('<a href="?page=%s&action=%s&id=%s">Delete</a>',$_REQUEST['page'],'delete',$item['id']),
            //'delete'    => sprintf('<a href="' . get_site_url() . '/wp-admin/admin.php?page=configure-contact&action=delete&id=' . $item['id'] . '">Delete</a>',$_REQUEST['page'],'delete',$item['ID']),
          
        );

  return sprintf('%1$s %2$s', $item['booktitle'], $this->row_actions($actions) );
}



// function get_bulk_actions($rec) {
//         $actions = array();

//         //$actions['approv'] ='<a href="#">'.__( 'Approve' ).'</a>';
//                // $actions['reject'] = '<a href="#">'.__( 'Reject' ).'</a>';
//                 $actions['delete'] = '<a onclick="javascript:return confirmation()"  href="?page=configure-contact&action=delete&id=' . $rec->id . '">'.__( 'Delete' ).'</a>';
//              //   $actions['view'] = '<a href="#">'.__( 'View' ).'</a>';


//         return $actions;
//     }


function get_bulk_actions() {
  $actions = array(
    'delete'    => 'Delete'
  );
  return $actions;
}




function column_cb($item) {
        return sprintf(
           // '<input type="checkbox" name="id[]" value="%s" />', $item['id']
            '<input type="checkbox" name="%1$s[]" value="%2$s" />',
            /*$1%s*/ $this->_args['singular'],  //Let's simply repurpose the table's singular label ("video")
            /*$2%s*/ $item->id             //The value of the checkbox should be the record's id
        );    
    }

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


    function prepare_items() {
   global $wpdb, $_wp_column_headers;
    $query = "SELECT * FROM " . $wpdb->prefix."addressbook"; 
 //$result = $wpdb->get_results($sql); 
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
      $this->items = $wpdb->get_results($query);
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
            $actions = $this->get_bulk_actions($rec);

                    echo $this->row_actions( $actions );
                                     echo '</td>';   break;
            case "f_name": echo '<td '.$attributes.'>'.stripslashes($rec->f_name).'5</td>'; break;
            case "phone": echo '<td '.$attributes.'>'.$rec->phone.'</td>'; break;
            case "email": echo '<td '.$attributes.'>'.stripslashes($rec->email).'</td>'; break;
            
            //case "address": echo '<td '.$attributes.'>'.$rec->address.'</td>'; break;
            case "options":
            echo '<td '.$attributes.'> <a href="' . get_site_url() . '/wp-admin/admin.php?page=configure-contact&action=edit&id=' . $rec->id . '"> Edit </a> | <a onclick="javascript:return confirmation()" href="' . get_site_url() . '/wp-admin/admin.php?page=configure-contact&action=delete&id=' . $rec->id . '"> Delete</a></td>';
  
            
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
  echo '</pre><div class="wrap"><h2>My List Table Test</h2>'; 
  $myListTable->prepare_items(); 
?>
  <form method="post">
    <input type="hidden" name="page" value="ttest_list_table">
    <?php
    $myListTable->search_box( 'search', 'search_id' );

  $myListTable->display(); 
  echo '</form></div>'; 
}

