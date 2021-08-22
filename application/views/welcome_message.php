<?php
$string = '123';
$encrypted_string = magicfunction($string,'e');
echo 'Encrypted string is ' .$encrypted_string .'<br>';

$decrypted_string = magicfunction($encrypted_string,'d');
echo 'Decrypted string is ' .$decrypted_string .'<br>';
?>