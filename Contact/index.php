<?php

// Show all errors (for educational purposes)
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

// Constants (database connection settings)
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'Azerty123');
define('DB_NAME', 'contact');

date_default_timezone_set('Europe/Brussels');

// Connect to the database
try {
    $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection error: ' . $e->getMessage();
    exit;
}

$name = isset($_POST['name']) ? (string)$_POST['name'] : '';
$email = isset($_POST['email']) ? (string)$_POST['email'] : '';
$message = isset($_POST['message']) ? (string)$_POST['message'] : '';
$findMe = isset($_POST['find_me']) ? $_POST['find_me'] : [];
$msgName = '';
$msgEmail = '';
$msgMessage = '';
$msgFindMe = '';

// form is sent: perform formchecking!
if (isset($_POST['btnSubmit'])) {

    $allOk = true;

    if (trim($name) === '') {
        $msgName = 'Please enter a name';
        $allOk = false;
    }

    if (trim($email) === '') {
        $msgEmail = 'Please enter an email';
        $allOk = false;
    }

    if (trim($message) === '') {
        $msgMessage = 'Please enter a message';
        $allOk = false;
    }

    if (empty($findMe)) {
        $msgFindMe = 'Please select at least one option for how you found me';
        $allOk = false;
    }

    // end of form check. If $allOk still is true, then the form was sent in correctly
    if ($allOk) {
        // build & execute prepared statement
        $stmt = $db->prepare('INSERT INTO messages (sender, message, added_on) VALUES (?, ?, ?)');
        $stmt->execute(array($name, $email, $message, (new DateTime())->format('Y-m-d H:i:s')));

        // the query succeeded, redirect to this very same page
        if ($db->lastInsertId() !== 0) {
            header('Location: formchecking_thanks.php?name=' . urlencode($name));
            exit();
        } // the query failed
        else {
            echo 'Database error.';
            exit;
        }
    }

}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio - Contact Me</title>

    <!--CSS FILES-->
    <link rel="stylesheet" href="https://unpkg.com/@csstools/normalize.css">
    <link rel="stylesheet" href="../styles/mobile.css">
    <link rel="stylesheet" href="styles/style.css">

    <!--FONTS-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Giga:wght@100..900&family=Red+Hat+Display:ital,wght@0,300..900;1,300..900&family=Russo+One&display=swap" rel="stylesheet">
</head>

<header>
        <div class="container portfolio-header">
            <nav>
                <a class="tab" href="../">Home</a>
                <a class="tab" href="../About/">About</a>
                <a class="tab" href="../Projects/">Projects</a>
                <a class="tab" href="./">Contact</a>
            </nav>
            <h1>Contact</h1>
        </div>
</header>

<main class="container">
<section class="card">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <h2>Contact Form</h2>
        <p class="message">All fields are required unless otherwise stated.</p>

        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlentities($name); ?>" class="input-text"/>
            <span class="message error"><?php echo $msgName; ?></span>
        </div>

        <div>
            <label for="name">Email:</label>
            <input type="text" id="email" name="email" value="<?php echo htmlentities($email); ?>" class="input-text"/>
            <span class="message error"><?php echo $msgEmail; ?></span>
        </div>

        <div>
            <label for="message">Message:</label>
            <textarea name="message" id="message" rows="5" cols="40"><?php echo htmlentities($message); ?></textarea>
            <span class="message error"><?php echo $msgMessage; ?></span>
        </div>

        <div>
            <fieldset>
                <legend>How did you find me?</legend>
                <div>
                    <input type="checkbox" name="find_me[]" id="find_me0" value="Social Media" <?php echo in_array('Social Media', $findMe) ? 'checked' : ''; ?>>
                    <label for="find_me0">Social Media</label>
                </div>

                <div>
                    <input type="checkbox" name="find_me[]" id="find_me1" value="Search Engine" <?php echo in_array('Search Engine', $findMe) ? 'checked' : ''; ?>>
                    <label for="find_me1">Search Engine</label>
                </div>

                <div>
                    <input type="checkbox" name="find_me[]" id="find_me2" value="Referral" <?php echo in_array('Referral', $findMe) ? 'checked' : ''; ?>>
                    <label for="find_me2">Referral</label>
                </div>

                <div>
                    <input type="checkbox" name="find_me[]" id="find_me3" value="Other" <?php echo in_array('Other', $findMe) ? 'checked' : ''; ?>>
                    <label for="find_me3">Other</label>
                </div>
            </fieldset>
            <span class="message error"><?php echo $msgFindMe; ?></span>
        </div>

        <button type="submit" id="btnSubmit" name="btnSubmit">Send Message</button>
    </form>
</section>

<section class="links">
            <div class="links-container">
                <a href="https://shobi-one.itch.io/" target="_blank" class="link">
                    <img src="../assets/img/links/itchio.png" alt="Itch.io Logo">
                </a>
                <a href="https://github.com/Shobi-one" target="_blank" class="link">
                    <img src="../assets/img/links/github.png" alt="GitHub Logo">
                </a>
                <a href="https://x.com/Shobi_one" target="_blank" class="link">
                    <img src="../assets/img/links/x.png" alt="X Logo">
                </a>
                <a href="https://www.linkedin.com/in/obi-verheyen/" target="_blank" class="link">
                    <img src="../assets/img/links/linkedin.png" alt="LinkedIn Logo">
                </a>
            </div>
</section>
</main>

<footer class="footer">
        <nav>
            <a href="../" class="link">Home</a>
            <a href="../About/" class="link">About</a>
            <a href="../Projects/" class="link">Projects</a>
            <a href="./" class="link">Contact</a>
        </nav>
        <p>&copy; 2024 Obi Verheyen</p>
    </footer>
</body>
</html>
