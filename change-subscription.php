<?php
session_start();
require("./functions.php");
redirect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/48b1b4cd52.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./styles.css">
    <script src="./js/script.js"></script>
    <title>Chnage Subscription</title>
</head>
<body>
    <?php require("./navbar.php"); ?>

    <div id="flex-container-centre" class="flex-container">
        <div class="login-form col-lg-5 col-md-8">
            <h1>Update Subscription</h1>
                <form method="post" action="<?php updateSubscription(); ?>">
                    <p>Subscription</p>
                    <label for="subscription">
                        <input type="radio" name="subscription" checked="checked" value="0" onclick="hideCardDetailsForm();">Basic
                    </label>
                    <label for="subscription">
                        <input type="radio" name="subscription" value="1" onclick="showCardDetailsForm();">Premium (£99.99 p.a.)
                    </label>
                    <div id="card-details">
                        <p>Card Number</p>
                        <input class="col-lg-12 col-md-12" id="card-num" type="text" name="card_no" placeholder="Enter Card Number">
                        <div class="custom-select col-lg-6 col-md-6">
                            <p>Expiry Month</p>
                            <select id="expMonth" class="col-lg-11 col-md-11" name="exp-month">
                                <script>
                                    fillExpiryMonths();
                                </script>
                            </select>
                        </div>
                        <div class="custom-select col-lg-6 col-md-6">
                            <p>Expiry Year</p>
                            <select id="expYear" class="col-lg-12 col-md-12" name="exp-year">
                                <script>
                                    fillExpiryYears();
                                </script>
                            </select>
                        </div>
                        <p>CVV</p>
                        <input class="col-lg-12 col-md-12" id="cvv" type="text" name="cvv" placeholder="Security Code (CVV)">
                    </div>
                    <input class="col-lg-12 col-md-12" type="submit" name="register" value="Submit">
                </form>
            </div>
        </div>
    </div>
</body>
</html>