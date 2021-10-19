<?php include('partials/menu.php');?>

<?php 
    //Check if is is set or not
    if(isset($_GET['id']))
    {
        //Get all the details
        $id = $_GET['id'];

        //SQL Query to get the selected food
        $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
        //execute the query
        $res2 = mysqli_query($conn, $sql2);
        //Get the value based on query executed
        $row2 = mysqli_fetch_assoc($res2);
        //Get the individual values of selected food
        $food_name = $row2['food_name'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category = $row2['category_id'];
        $featured = $row2['featured'];
        $active = $row2['active'];
    }
    else
    {
        //Redirect to manage food
        header('location:'.SITEURL.'admin/manage-food.php');
    }
?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Food</h1>
            <br><br>

            <form action="" method="POST" enctype="multipart/form-data"></form>
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="food_name" value="<?php echo $food_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description;?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price;?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                            if($current_image=="")
                            {
                                //Image not available
                                echo "<div class='error'>Image not Available</div>";
                            }
                            else
                            {
                                //Image available
                                ?>
                                <img src="<?php echo SITEURL;?>images/food/<?php echo $current_image; ?>" width="100">
                                <?php
                            }
                        ?>
                        
                    </td>
                </tr>

                <tr>
                    <td>Select New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php
                                //Query to get active categories
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                //Execute the query
                                $res=mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($res);

                                //Check if the category is available or not
                                if($count>0)
                                {
                                    //Category available
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        $category_title = $row['title'];
                                        $category_id = $row['id'];

                                        ?>
                                        <option value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                        <?php 
                                    }
                                }
                                else
                                {
                                    //Category not available
                                    echo "<option value='0'>Category Not Available</option>";
                                }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="submit" name="submit" value="Update Food" class="btn-primary">
                    </td>
                </tr>
            </table>
        </div>
    </div>

<?php include('partials/footer.php');?>