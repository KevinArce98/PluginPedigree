<?php 

if ( ! defined( 'ABSPATH' ) ) exit;

if( !class_exists('WP_List_Table') ){

	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );

}
 
class Pedigree_List_Table extends WP_List_Table {

   	function __construct() {

	    parent::__construct( array(
		    'singular'=> 'pedigree',
		    'plural' => 'pedigrees',
		    'ajax'  => false
	    ));

    }

   	function extra_tablenav( $which ) {

        if ( $which == "top" ) { ?>

        <?php }

        if ( $which == "bottom" ) {}

   	}

	function get_columns() {

	  $columns = array(
	 
	    'name'=>__('Nombre', 'pedigree' ),
	    'idMadre'=>__('Madre', 'pedigree' ),
	    'idPadre'=>__('Padre', 'pedigree' ),
	    'shortcode'=>__('Shortcode', 'pedigree' )
	  );
	  return $columns;

	}

	function prepare_items( $search = NULL ) {

		global $wpdb, $_wp_column_headers;
	    $screen = get_current_screen();
	    $table_name = $wpdb->prefix . "pedigree_uniko";

		$query = "SELECT * FROM $table_name ORDER BY id DESC"; 
		 
		$orderby = !empty($_GET["orderby"]) ? mysql_real_escape_string($_GET["orderby"]) : 'ASC';
		$order = !empty($_GET["order"]) ? mysql_real_escape_string($_GET["order"]) : '';
		if(!empty($orderby) & !empty($order)){ $query.=' ORDER BY '.$orderby.' '.$order; }	 

		$totalitems = $wpdb->query($query); 
		$perpage = 5;
		$paged = !empty($_GET["paged"]) ? esc_sql($_GET["paged"]) : '';

		if(empty($paged) || !is_numeric($paged) || $paged<=0 ){ $paged=1; }

		$totalpages = ceil($totalitems/$perpage);

		if(!empty($paged) && !empty($perpage)){
			$offset=($paged-1)*$perpage;
			$query.=' LIMIT '.(int)$offset.','.(int)$perpage;
		}
		 
		$this->set_pagination_args( array(
			"total_items" => $totalitems,
			"total_pages" => $totalpages,
			"per_page" => $perpage
		) );

		$columns = $this->get_columns();
		$hidden = array();
		$sortable = $this->get_sortable_columns();
		$this->_column_headers = array($columns, $hidden, $sortable);
		 
		$this->items = $wpdb->get_results($query);

	}

	function display_rows() {

        $records = $this->items;
 
        list( $columns, $hidden ) = $this->get_column_info();
 
	        if( !empty( $records ) ) { foreach( $records as $rec ) {
	 
		        echo '<tr id="record_'.$rec->id.'">';

		        foreach ( $columns as $column_name => $column_display_name ) {
		 
			        $class = "class='$column_name column-$column_name'";
			        $style = " style='padding-top: 15px;padding-bottom: 15px;'";

			        if ( in_array( $column_name, $hidden ) ) $style = ' style="display:none;"';
			       	$attributes = $class . $style;
			 
			        $paged = !empty($_GET["paged"]) ? esc_sql($_GET["paged"]) : '';			      
					$viewlink = sprintf('<a href="?page=%s&action=%s&encuesta=%s&paged=%s">'. __( 'Veure info', 'pedigree' ) .'</a>',$_REQUEST['page'],'edit', (int)$rec->id, $paged );					
			 
			        switch ( $column_name ) {
				       	case "name":     
				        	echo '<td '.$attributes.'><a href="#">'.stripslashes($rec->name).'</a></td>';        
				        	break;	

				       	case "idMadre":     
				        	echo '<td '.$attributes.'>'.stripslashes($rec->idMadre).'</td>';        
				        	break;	

				       	case "idPadre":     
				        	echo '<td '.$attributes.'>'.stripslashes($rec->idPadre).'</td>';        
				        	break;
				        case "shortcode":     
				        	echo '<td '.$attributes.'>'.stripslashes($rec->shortcode).'</td>';        
				        	break;
			        }

		        }
		 
		        echo'</tr>';

	        }

    	}

    }

}