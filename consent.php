<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 1/17/2016
 * Time: 1:06 PM
 */

require_once "includes/masterpage/header.php";
?>

<form method="post" action="process/consent.php" name="consent_form" id="consent_form">
    <input type="text" name="name" placeholder="Name">
    <br>
    <input type="text" name="surname" required placeholder="Surame">
    <br>
    <input type="number" name="age" required min="18" max="120" placeholder="Age">
    <br>
    <input type="radio" name="sex" value="<?php echo Sex::MALE; ?>" checked> Male<br>
    <input type="radio" name="sex" value="<?php echo Sex::FEMALE; ?>"> Female<br>
    <br>
    <textarea>I agree to participate in the study conducted and recorded by Alexander Spiteri during this interactive interface design and evaluation session developed in part fulfillment of a Bachelor of Science in Internet Applications Development at Middlesex University Malta.

I understand and consent to the use and release of the recording by Alexander Spiteri. I understand that the information and recording is for research purposes only and all data collected will be examined and reviewed to extract results.. My name and image will not be used for any other purpose. I relinquish any rights to the recording and understand the recording may be copied and used by Alexander Spiteri without further permission.

I understand that participation in this study is voluntary and I agree to immediately raise any concerns or areas of discomfort during the session with the study administrator. I understand that this session will take between 30 and 45 minutes and I agree to do all required tasks and answer all questions to the best of my abilities.

By checking the below combo box I confirm that I have read and understood the information on this form and that any questions I might have about the session have been answered.
    </textarea><br>
    <input type="checkbox" name="consent" checked> Agree and Give Consent <br>
    <input type="submit" name="consent_form_submit">
</form>
