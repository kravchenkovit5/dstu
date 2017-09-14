<?php
$table = 'requests';
$primaryKey = 'id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'create_date', 'dt' => 0 ),
    array( 'db' => 'name', 		  'dt' => 1 ),
    array( 'db' => 'status',  	  'dt' => 2 ),
    array( 'db' => 'description', 'dt' => 3 ),
    array( 'db' => 'author',      'dt' => 4 ),
    array( 'db' => 'performer',   'dt' => 5),
    array( 'db' => 'performdate', 'dt' => 6 ),    
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


