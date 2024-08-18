<?php
require_once("conn.php");
$bdGP = $_POST['bloodGP'];
$lat = $_POST['latitude'];
$lon = $_POST['longitude'];

$query = "SELECT 
            bbdb.id AS id,
            bbdb.name, 
            state.{$bdGP} AS qty, 
            price.{$bdGP} AS ppb, 
            bbdb.lat,
            bbdb.long,
            bbdb.plus_code AS loc,
            state.last_updated_at 
        FROM `easy_blood`.`bbdb` 
        INNER JOIN `easy_blood`.`state` ON bbdb.name = state.bbname 
        INNER JOIN price ON state.bbname = price.bbname";

echo $bdGP;
echo "<br>{$query}";
echo "<br>{$lat},{$lon}";

$result = mysqli_query($conn,$query);
if($result){
    echo '<html>
            <head>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
            </head>
            <body>
                <center>
                <table class="table table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col"> Name of the Blood Bank </th>
                    <th scope="col"> No of Bloods remaining </th>
                    <th scope="col">Price/Bag</th>
                    <th scope="col">Location</th>
                </tr>
                </thead class="thead-dark">';

    while($row = mysqli_fetch_assoc($result)){
        // echo json.encode($row);
        $name = $row['name'];
        $blood_remaining = $row['qty'];
        $price_per_bag = $row['ppb'];
        $loc_bb = $row['loc'];
        $url_map = 'https://www.google.com/maps/dir//'.$row["lat"].','.$row["long"].'/';
        echo '<tr>
            <td>'.$name.'</td>
            <td>'.$blood_remaining.' bags</td>
            <td>'.$price_per_bag.' Taka</td>
            <td><a href='.$url_map.'>'.$loc_bb.'</a></td>
        </tr>';
    }

}
?>
    </table>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>