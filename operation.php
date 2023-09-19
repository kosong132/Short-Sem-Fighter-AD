<?php
session_start();
require_once("config.php");

if ($_SESSION["Login"] != "YES") {
    header("Location: guest_form.php");
}

if (isset($_GET["pass"])) {
    $menu_code = $_GET["pass"];
    $order_id = $_SESSION['COUNTER'];
    
    if ($_SESSION['LEVEL'] == 1) {
        $sql = "DELETE FROM Menu WHERE menu_code = '$menu_code'";
        unset($_GET["pass"]);
        if (mysqli_query($conn, $sql)) {
            $_SESSION['alert_message'] = "Menu item deleted successfully.";
        } else {
            $em = "Error deleting menu item: " . mysqli_error($conn);
            $_SESSION['alert_message'] = $em;
        }
        header("Location: servicespage.php");
    } else if ($_SESSION['LEVEL'] == 2 || $_SESSION['LEVEL'] == 0) {
        $delete_query = "DELETE FROM Orderdetails WHERE order_id = '$order_id' AND menu_code = '$menu_code'";
        if (mysqli_query($conn, $delete_query)) {
            $_SESSION['alert_message'] = "Menu item removed from cart.";
        } else {
            $em = "Error removing menu item from cart: " . mysqli_error($conn);
            $_SESSION['alert_message'] = $em;
        }
        header("Location: cart.php");
    } else {
        $em = "Error: Invalid user level";
        $_SESSION['alert_message'] = $em;
        header("Location: servicespage.php");
    }

    mysqli_close($conn);
}

if (isset($_POST["menucode"])) {
    $menu_code = $_POST["menucode"];
    $menu_name = $_POST["menuname"];
    $menu_price = $_POST["menuprice"];
    $menu_description = $_POST["menudesc"];
    $category = $_POST["category"];

    // Check if a new image file has been uploaded
    if (isset($_FILES['uploadfile'])) {
        $img_name = $_FILES['uploadfile']['name'];
        $img_size = $_FILES['uploadfile']['size'];
        $img_tmp_name = $_FILES['uploadfile']['tmp_name'];
        $img_error = $_FILES['uploadfile']['error'];

        if ($img_error === 0) {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);
            $allowed_exs = array("jpg", "jpeg", "png");

            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                $img_upload_path = 'img/menuimages/' . $new_img_name;

                if (move_uploaded_file($img_tmp_name, $img_upload_path)) {
                    // Update the menu item with the new image filename
                    $sql = "UPDATE Menu SET menu_img='$new_img_name', menu_name='$menu_name', menu_price='$menu_price', menu_description='$menu_description', category='$category' WHERE menu_code = '$menu_code'";
                } else {
                    $em = "Error uploading image file.";
                    $_SESSION['alert_message'] = $em;
                    header("Location: servicespage.php");
                    exit();
                }
            } else {
                $em = "You can't upload files of this type";
                $_SESSION['alert_message'] = $em;
                header("Location: servicespage.php");
                exit();
            }
        }
    } else {
        // No new image was uploaded, update menu item without changing the image
        $sql = "UPDATE Menu SET menu_name='$menu_name', menu_price='$menu_price', menu_description='$menu_description', category='$category' WHERE menu_code = '$menu_code'";
    }

    if (mysqli_query($conn, $sql)) {
        $_SESSION['alert_message'] = "Menu item updated successfully.";
    } else {
        $em = "Error updating menu item: " . mysqli_error($conn);
        $_SESSION['alert_message'] = $em;
    }

    header("Location: servicespage.php");
    mysqli_close($conn);
}
?>
