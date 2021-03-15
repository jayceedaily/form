<?php

namespace App\Models;


class Git
{
    public static function getGitBranch()
    {
        $stringfromfile = file('../.git/HEAD', FILE_USE_INCLUDE_PATH);

        $firstLine = $stringfromfile[0]; //get the string from the array

        $explodedstring = explode("/", $firstLine, 3); //seperate out by the "/" in the string

        return  trim($explodedstring[2]);
    }

    public static function getGitMessage()
    {
        exec('git rev-parse --verify HEAD 2> /dev/null', $output);

        $hash = $output[0];

        $item =  exec("git show $hash", $output);

        return $item;
    }

    public static function getCurrentHash( $branch='master' ) {
        if ( $hash = file_get_contents( sprintf( '../.git/refs/heads/%s', $branch ) ) ) {
          return trim($hash);
        } else {
          return false;
        }
      }
}
