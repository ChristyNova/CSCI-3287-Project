<head>
<title>Available Pieces</title>
<style>
#header {
    background-color:black;
    color:white;
    text-align:center;
    padding:5px;
}  
}
</style>
</head>

<body>
<div id="header">
    <h1>Art Gallery</h1>
    <p>Joseph Sanchez and Christy Lentz -- CSCI 3287 Fall 2015</p>
</div>

<p><a href='/'>Home</a></p>

<?php
	$conn = null;
	if (isset($_SERVER['SERVER_SOFTWARE']) && 
		strpos($_SERVER['SERVER_SOFTWARE'],'Google App Engine') !== false) {
	    // Connect from App Engine.
	    try {
	    	$conn = new pdo('mysql:unix_socket=/cloudsql/artgallery-1156:art;dbname=artgallery', 'root', '');
	    } catch(PDOException $ex) {
	    	die(json_encode(
            	array('outcome' => false, 'message' => 'Unable to connect :((((')
            	)
        	);
	    }
  	} else {
    	// Connect from a development environment.
    	try {
    		$conn = new pdo('mysql:host=173.194.105.221;dbname=artgallery', 'joseph', 'admin');
    	} catch(PDOException $ex) {
	    	die(json_encode(
            	array('outcome' => false, 'message' => 'Unable to connect')
            	)
        	);
	    }
 	}

    echo "<h2>Purchased Pieces</h2>";
    echo "<table style='width:50%'>";
 	foreach($conn->query('select art_pieces.name, purchases.purchaseid from art_pieces, purchases where art_pieces.pieceid=purchases.pieceid') as $row) {
        echo "<tr><td><a href='purchDetail.php?id=" . $row[purchaseid] . "'>" . $row[name] . "</a></td></tr>";
    }
?>