<?php
  session_start();

  //CSRF protection to prevent attackers from injecting malicious code

  if (empty($_SESSION['csrf'])) {
    if (function_exists('random_bytes')) {
      $_SESSION['csrf'] = bin2hex(random_bytes(32));
    } else if (function_exists('mcrypt_create_iv')) {
      $_SESSION['csrf'] = bin2hex(mcrypt_createiv(32, MCRYPT_DEV_URANDOM));
    } else {
      $_SESSION['csrf'] = bin2hex(openssl_random_pseudo_bytes(32));
    }
  }
  
  // Prevents XSS attacks by escaping HTML characters

  function escape($html) {
    return htmlspecialchars($html. ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
  }
?>