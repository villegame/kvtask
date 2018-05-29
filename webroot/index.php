<?php

    require("db.php");

    $infoMsg   = NULL;
    $errorMsg  = NULL;

    // Process POST-data
    if (isset($_POST['email'])) {

        // Validate given e-mail address
        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

            $db = new DB();
            if($db->addEmail($_POST['email'])) {

                $_POST = array();

                // For testing
                //$db->getEmails();

                $infoMsg = '<div class="alert alert-success" role="alert">E-mail address added into database.</div>';

            } else {
                $errorMsg = '<div class="alert alert-danger" role="alert">An error occurred inserting e-mail address into database.</div>';
            }


        } else {
            $errorMsg = '<div class="alert alert-danger" role="alert">Invalid e-mail address given.</div>';
        }
    }

?>

<html>
    <head>
        <title>E-mail collector</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    </head>

    <body>

        <div class="container mt-4">
            <div class="jumbotron">

                <h1>E-Mail database</h1>

<?php
                // Print messages if there is any.
                if($infoMsg) print $infoMsg;
                if($errorMsg) print $errorMsg;
?>

                <form method="POST">
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input name="email" class="form-control" placeholder="Type e-mail address here" value="<?php if(isset($_POST['email'])) print $_POST['email']; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit to database</button>
                </form>
            </div>
        </div>

    </body>
</html>