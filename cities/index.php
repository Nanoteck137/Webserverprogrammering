<?php
    $dbc_cities = mysqli_connect("localhost", "root", "", "cities");

    mysqli_query($dbc_cities, "SET NAMES utf8");
?>

<!DOCTYPE html>
<html>
<head>
    <?php
        require("templates/head.php");
    ?>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <div id="container">
        <?php 
            require("templates/header.php");
        ?>
        <form action="index.php" method="get">
            Search: <input type="search" name="q" value="<?php 
                echo isset($_GET["q"]) ? $_GET["q"] : "";
            ?>">

            <?php 
                function checkboxCheck($name, $value) {
                    if(isset($_GET[$name])) {
                        if($_GET[$name] === $value) {
                            return "checked";
                        }
                    }
                    return "";
                }
            ?>

            <br>
            Country: <input type="radio" value="country" name="order" <?php echo checkboxCheck("order", "country"); ?>>
            City: <input type="radio" value="city" name="order" <?php echo checkboxCheck("order", "city"); ?>>
            Population: <input type="radio" value="population" name="order" <?php echo checkboxCheck("order", "population"); ?>>

            <br>
            <br>
            Asc: <input type="radio" value="asc" name="sort" <?php echo checkboxCheck("sort", "asc"); ?>>
            Desc: <input type="radio" value="desc" name="sort" <?php echo checkboxCheck("sort", "desc"); ?>>

            <br>
            <br>
            <input type="submit" value="Search">
        </form>

        <br>

        <?php
        if(isset($_GET["view_id"])) {
            $id = $_GET["view_id"];

            $query = "SELECT * FROM cities JOIN countries ON cities.Country = countries.CountryCode WHERE City='$id';";
            $result = mysqli_query($dbc_cities, $query);

            $row = mysqli_fetch_array($result);
        ?>
            Country: <span style="font-weight: bold; font-size: 1.1em;"><?php echo $row["Countryname"]; ?></span><br> <br>
            City: <?php echo $row["AccentCity"]; ?> <br><br>
            Population: <?php echo $row["Population"]; ?>
        <?php
        } else {
            if(isset($_GET["q"]) && strlen($_GET["q"]) > 0) {
                $searchQuery = $_GET["q"];
                $custom = "WHERE City LIKE '$searchQuery%' OR Countryname LIKE '$searchQuery%' ";
            } else {
                $custom = "";
            }

            if(isset($_GET["order"])) {
                if(strlen($_GET["order"]) > 0) {
                    $order = $_GET["order"];
                    $custom .= "ORDER BY $order ";
                }
            } else {
                $custom .= "ORDER BY city ";
            }

            if(isset($_GET["sort"]) && strlen($_GET["sort"]) > 0) {
                $sort = $_GET["sort"];
                $custom .= "$sort";
            }

            $query = "SELECT * FROM cities JOIN countries ON cities.Country = countries.CountryCode $custom;";
            $result = mysqli_query($dbc_cities, $query);
        ?>
        <table id="country-table">
            <tr>
                <th>City</th>
                <th>Country</th>
            </tr>
        <?php
            while($row = mysqli_fetch_array($result)) {
        ?>

            <tr class="table-item">
                <a href="#">
                    <td><a href="index.php?view_id=<?php echo $row['City']; ?>"><?php echo $row["City"]; ?></a></th>
                    <td><?php echo $row["Countryname"]; ?></th>
                </a>
            </tr>

        <?php
            }
        }
        ?>
        </table>
    </div>
</body>
</html>