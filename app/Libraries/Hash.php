<?php

namespace App\Libraries;

class Hash
{

  public static function make($password)
  {
    // Return hashed password
    return password_hash($password, PASSWORD_BCRYPT);
  }

  public static function check($entered_password, $db_password)
  {
    // Check if password is coorect
    return password_verify($entered_password, $db_password);
  }
}
