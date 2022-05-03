<?php
session_start();
require("./functions.php");
redirect();
$userId = $_SESSION["user_id"];
$userInfo = getUserDetails($userId);
$subscription = translateSubscription($userInfo["premium"]);
$cardDetails = getCardDetails($userId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./styles.css">
    <script src="./js/script.js"></script>
    <title>Account</title>
</head>
<body>
    <?php require("./navbar.php"); ?>

    <div id="flex-container-centre" class="flex-container">
        <div class="user-info">
            <div class="user-info-card">
                <div class="user-info-card-header">
                    <h1>Your Details</h1>
                </div>
                <div class="user-info-card-content">
                    <h2>Forename: <span><?php echo $userInfo["firstName"]; ?></span></h2>
                    <h2>Surname: <span><?php echo $userInfo["lastName"]; ?></span></h2>
                    <h2>Email: <span><?php echo $userInfo["email"]; ?></span></h2>
                    <h2>Subscription: <span><?php echo $subscription; ?></span></h2>
                </div>
                <div class="user-info-card-footer">
                    <p>Registered on: <span><?php echo $userInfo["dateOfReg"]; ?></span></p>
                </div>
            </div>

            <div id="card-info" class="card-info-card">
                <div class="card-info-card-header">
                    <h1>Card Details</h1>
                </div>
                <div class="card-info-card-content">
                    <h2>Card Number: <span><?php echo $cardDetails["cardNumber"]; ?></span></h2>
                    <h2>Expiry Date: <span><?php echo $cardDetails["expMonth"] . "/" . $cardDetails["expYear"]; ?></span></h2>
                    <h2>CVV: <span><?php echo $cardDetails["cvv"]; ?></span></h2>
                </div>
                <div class="card-info-card-footer">

                </div>
            </div>
        </div>
    </div>
</body>
</html>