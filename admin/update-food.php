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

            <form action="" method="POST" enctype="multipart/form-data">
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
                                        <option <?php if($current_category
                                        ==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
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
                        <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if($featured=="No"){echo "checked";}?>type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";}?>  type="radio" name="active" value="Yes">Yes
                        <input <?php if($active=="No"){echo "checked";}?>  type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

                        <input type="submit" name="submit" value="Update Food" class="btn-primary">
                    </td>
                </tr>
            </table>
            </form>

            <?php
                if(isset($_POST['submit']))
                {
                    //1.Get all the details from the form
                    $id = $_POST['id'];
                    $food_name = $_POST['food_name'];
                    $description = $_POST['description'];
                    $price = $_POST['price'];
                    $current_image = $_POST['current_image'];
                    $category = $_POST['category'];
                    $featured = $_POST['featured'];
                    $active = $_POST['active'];


                    //2. Upload the image if selected
                    //Check if the upload button is clicked or not
                    if(isset($_FILES['image']['name']))
                    {
                        $image_name = $_FILES['image']['name'];

                        //Check if the file is available or not
                        if($image_name!="")
                        {
                            //Img is available
                            //A. Uploading new image
                            //rename the image
                            $ext = end(explode('.', $image_name)); //Gets the extension of the image
                            $image_name = "Food-Name-".rand(0000, 9999).'.'.$ext;
                            //Get the source path and desti path
                            $src_path = $_FILES['image']['tmp_name'];
                            $dest_path="../images/food/".$image_name;

                            //upload the image
                            $upload = move_uploaded_file($src_path, $dest_path);

                            //check if the image is uploaded or not
                            if($upload==false){
                                //failed to upload
                                $_SESSION['upload'] = "<div class='error'>Failed to upload new Image</div>";
                                //Redirect to manage food
                                header('location:'.SITEURL.'admin/manage-food.php');
                                //stop the process
                                die();
                            }
                            //3. Remove the image if new image is uploaded and current image exists
                            //B Remove current image if available
                            if($current_image!="")
                            {
                                //Current image is available
                                //remove the image
                                $remove_path = "../images/food/".$current_image;
                                $remove = unlink($remove_path);
                                //Check if the image was removed or not
                                if($remove==false)
                                {
                                    //failed to remove current image
                                    $_SESSION['remove-failed']="<div class='error'>Failed to remove current image</div>";
                                    //redirect to manage food
                                    header('location:'.SITEURL.'admin/manage-food.php');
                                    //stop the process
                                    die();
                                }
                            }
                        }
                        else
                        {
                            $image_name = $current_image;//default image when image is not selected
                        }
                    }
                    else
                    {
                        $image_name = $current_image;//default image when button is not clicked
                    }

                    
                    //4. Update the Food in Database
                    $sql3 = "UPDATE tbl_food SET
                        food_name = '$food_name',
                        description = '$description',
                        price = $price,
                        image_name = '$image_name',
                        category_id = '$category',
                        featured = '$featured',
                        active = '$active'
                        WHERE id=$id
                    ";
                    //Execute the SQL query
                    $res3 = mysqli_query($conn, $sql3);

                    //Check if the query was executed or not
                    if($res3==true)
                    {
                        $_SESSION['update']="<div class='success'>Food Updated Successfully</div>";
                        header('location:'.SITEURL.'admin/manage-food.php');
                    }
                    else{
                        $_SESSION['update']="<div class='error'>Failed to Update Food</div>";
                        header('location:'.SITEURL.'admin/manage-food.php');
                    } 
                }

            ?>
        </div>
    </div>

<?php include('partials/footer.php');?>