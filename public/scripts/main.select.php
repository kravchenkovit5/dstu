<?php
$table = 'docs';
$primaryKey = 'marking'; 

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'marking', 		'dt' => 0 ),
    array( 'db' => 'description',  	'dt' => 1 ),
    array( 'db' => 'typedoc',   	'dt' => 2 ),
    array( 'db' => 'statusdoc',     'dt' => 3 ),
    array( 'db' => 'size',     		'dt' => 4 ),
    array( 'db' => 'actualdate',    'dt' => 5),
    array( 'db' => 'actualuser',    'dt' => 6 ),
    array( 'db' => 'note',     		'dt' => 7 ),
    // array(
    // 	'db'        => 'start_date',
    // 	'dt'        => 4,
    // 	'formatter' => function( $d, $row ) {
    // 		return date( 'jS M y', strtotime($d));
    // 	}
    // ),
    // array(
    // 	'db'        => 'salary',
    // 	'dt'        => 5,
    // 	'formatter' => function( $d, $row ) {
    // 		return '$'.number_format($d);
    // 	}
    // )
);

// SQL server connection information
$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db'   => 'dstu',
    'host' => 'localhost'
);

 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

require( 'ssp.class.php' );

echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);

