---
layout: default
permalink: subscribe/
---

<?php
// Code partially derived from the following resources:
//  * https://www.w3schools.com/php/php_forms.asp
//  * https://www.w3schools.com/php/func_mail_mail.asp


// define variables and set to default values
$email = "";
$emailErr = "";
$list = "updates";
$subscribed = False;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = test_input($_POST["email"]);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    } else {
      // the message
      $msg = "Subscribe" . "\n" . $email;
      $recipient = $list . "+subscribe@developspace.org";
      $subject = "Subscribe";
      $headers = "From: " . $email;

      // use wordwrap() if lines are longer than 70 characters
      $msg = wordwrap($msg,70);
      // send email to subscribe
      mail($recipient, $subject, $msg, $headers);

      $recipient = "testing@tst.dvlpspc.org, info@developspace.org";
      // send email for record keeping
      mail($recipient, $list, $msg, $headers);


      $subscribed = True;
    }

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>

<?php if ($subscribed) { ?>
  <p>
    Thank you for requesting to be added to the DevelopSpace <?php echo $list;?> mailing list!
  </p>
  <p>
    You should receive a confirmation email at <a><?php echo $email; ?></a> which you will need
    to reply to in order for the subscription to be completed. Check your spam folder if
    you do not see it within the next few minutes. Feel free to email us at 
    <a href="mailto:info@developspace.org">info@developspace.org</a> if there are any issues
    being added or with other questions.
  </p>
  <p>
    You can adjust your settings and see prior messages <a href="/list/<?php echo $list;?>">here</a>.
  </p>
<?php } else { // not subscribed
?>
  <p>
    Please fill out the form below to join our <?php echo $list;?> mailing list. You can also join by
    emailing <a href="mailto:<?php echo $list;?>+subscribe@developspace.org"><?php echo $list;?>+subscribe@developspace.org</a>,
    or <a href="/list/<?php echo $list;?>">go here</a> to see prior messages, subscribe, and adjust settings.
  </p>
  <p>
    <form method="post" action="/subscribe/">
      <input type="email" name="email" value="<?php echo $email;?>" placeholder="Email" required>
      <input type="submit" name="submit" value="Subscribe">
      <span class="error"><?php echo $emailErr;?></span>
    </form>
  </p>
  <p>
    Feel free to email us at 
    <a href="mailto:info@developspace.org">info@developspace.org</a> with any issues or questions.
  </p>
  

<?php } // end of subscribed block 
?>