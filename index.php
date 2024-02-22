<?php

require_once './config.php';

$name = isset($_POST['name']) ? $_POST['name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$message = isset($_POST['message']) ? $_POST['message'] : '';
$errors = [];
$values = [];

if (!empty($_POST['submit'])) {
    if (empty($_POST['name'])) {
        array_push($errors, "Name cannot be empty");
    } elseif (strlen($name) > MAX_NAME_LENGTH) {
        array_push($errors, "Name is too long, must be less than ".MAX_NAME_LENGTH." characters");
    }
    if (empty($_POST['email'])) {
        array_push($errors, "Email cannot be empty");
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Invalid email");
    }
    if (empty($_POST['message'])) {
        array_push($errors, "Message cannot be empty");
    } elseif (strlen($message) > MAX_MESSAGE_LENGTH) {
        array_push($errors, "Message is too long, must be less than ".MAX_MESSAGE_LENGTH." characters");
    }
}

if (!empty($_POST['submit'])) {
    if (!empty($_POST['name'])) {
        array_push($values, $_POST['name']);
    }
    if (!empty($_POST['email'])) {
        array_push($values, $_POST['email']);
    }
    if (!empty($_POST['message'])) {
        array_push($values, $_POST['message']);
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php if (!empty($_POST['submit']) && count($errors) === 0) { ?>
        <div class="container">
            <div class="alert alert-success mt-4">
                <?php echo THANK_YOU_MESSAGE; ?>
            </div>

            <div class="card w-25">
                <div class="card-header fw-bold text-center">
                    Your Information
                </div>
                <div class="card-body">
                    <h5 class="card-title">
                        Name:
                        <?php echo $values[0] ?>
                    </h5>
                    <p class="card-text lead">
                        Email:
                        <?php echo $values[1] ?>
                    </p>
                    <p class="card-text lead">
                        Message:
                        <?php echo $values[2] ?>
                    </p>

                </div>
            </div>
        </div>


        <?php exit();
    } ?>

    <div class="container">
        <h2 class="text-center mt-4 mb-5">Please fill out the form</h2>
        <form class="row g-3" method="post" action="index.php">
            <?php if (count($errors) > 0) { ?>
                <div class="alert alert-danger">
                    <?php foreach ($errors as $error) { ?>
                        <p>
                            <?php echo $error; ?>
                        </p>
                    <?php } ?>
                </div>
            <?php } ?>
            <div class="col-12">
                <label for="inputName" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $name ?>" id="inputName">
            </div>
            <div class="col-md-12">
                <label for="inputEmail4" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $email ?>" id="inputEmail4">
            </div>
            <div class="col-md-12">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" id="message" name="message" rows="3"><?php echo $message ?></textarea>
            </div>
            <div class="col-12 ">
                <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
                <button type="reset" class="btn btn-danger" name="reset" value="reset">Reset</button>
            </div>
        </form>
    </div>


</body>

</html>