<head>
<title>Available Pieces</title>
<style>
#header {
    background-color:black;
    color:white;
    text-align:center;
    padding:5px;
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
	if(isset($_GET['id'])) {
		$id = $_GET['id'];
	}
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

    $statement = $conn->prepare("select * from purchases natural join customers where purchases.custname=customers.name and purchaseid= :id");
    $statement->bindParam(':id', $id);
    $statement->execute();
    $pur = $statement->fetch();

    $pieceid = $pur[pieceid];

 	$statement = $conn->prepare("select * from art_data natural join art_pieces where pieceid= :id");
 	$statement->bindParam(':id', $pieceid);
 	$statement->execute();
 	$gen = $statement->fetch();

    

    echo "<h2>".$gen[name]."</h2>";
    echo "<table style='width:50%'>";
    echo "<tr><td><h4>General Info</h4></td></tr>";
    echo "<tr><td>Artist</td><td>". $gen[artist]. "</td></tr>";
    echo "<tr><td>Date</td><td>". $gen[date]. "</td></tr>";
    echo "<tr><td>Price</td><td>$". $gen[price]. "</td></tr>";
    echo "<tr><td><h4></h4></td></tr>";

    echo "<tr><td><h4>Purchase Info</h4></td></tr>";
    echo "<tr><td>Customer</td><td>". $pur[custname]. "</td></tr>";
    echo "<tr><td>Address</td><td>". $pur[address]. "</td></tr>";
    echo "<tr><td>Date of Purchase</td><td>". $pur[date]. "</td></tr>";
?>