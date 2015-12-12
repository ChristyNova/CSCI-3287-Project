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
 	$statement = $conn->prepare("select * from art_data natural join art_pieces where pieceid= :id");
 	$statement->bindParam(':id', $id);
 	$statement->execute();
 	$res = $statement->fetch();

    echo "<h2>".$res[name]."</h2>";
    echo "<table style='width:50%'>";
    echo "<tr><td><h4>General Info</h4></td></tr>";
    echo "<tr><td>Artist</td><td>". $res[artist]. "</td></tr>";
    echo "<tr><td>Date</td><td>". $res[date]. "</td></tr>";
    echo "<tr><td>Price</td><td>$". $res[price]. "</td></tr>";
?>