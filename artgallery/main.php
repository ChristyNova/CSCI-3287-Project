<head>
<title>Art Gallery</title>

<style>
#header {
    background-color:black;
    color:white;
    text-align:center;
    padding:5px;
}
#section {
    width:350px;
    float:left;
    padding:10px;        
}
#nav {
    line-height:30px;
    background-color:#eeeeee;
    height:300px;
    width:100px;
    float:left;
    padding:5px;          
}
#footer {
    background-color:black;
    color:white;
    clear:both;
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



<?php
    $menu = array(
        'available' => array('text'=>'Available', 'url'=>'/available.php'),
        'sold' => array('text'=>'Purchased', 'url'=>'/purchased.php'),
    );
    class CNavigation {
        public static function GenerateMenu($items) {
            $html = "<div id='nav'><nav>\n";
            foreach($items as $item) {
              $html .= "<a href='{$item['url']}'>{$item['text']}</a><br>\n";
            }
            $html .= "</nav></div>\n";
            return $html;
        }
    }

    echo CNavigation::GenerateMenu($menu);

?>

<div id="section">
    <p>Welcome to our fictional art gallery.
        Use the links on the left to navigate through our collection.
        There you can view pieces available for purchase and a list of those that have already been sold.</p>
    <p>Souce code can be found at <a href='https://github.com/ChristyNova/CSCI-3287-Project'>https://github.com/ChristyNova/CSCI-3287-Project</a></p>
</div>
