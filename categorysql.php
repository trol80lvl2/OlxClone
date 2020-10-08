<?php
            $query = "SELECT * FROM `category`";
            $adres = mysqli_query($conn,$query) or die(mysqli_error($conn));
            $query="SELECT * FROM `subcategory`";
            $subcategory=mysqli_query($conn,$query) or die(mysqli_error($conn));
?>