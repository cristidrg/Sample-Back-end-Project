<?php

namespace App;

class Utils {
    public function getColorClass($score)
    {
        if ($score < 0.9 && $score > 0.49) {
            return 'clr-orange';
        } else if ($score < 0.5) {
            return 'clr-red';
        } else {
            return 'clr-green';
        }
    }

    public function getDigitClass($score)
    {
        if ($score * 100 >= 100) {
            return 'digits-3';
        } else if ($score * 100 > 10) {
            return 'digits-2';
        } else {
            return 'digit-1';
        }
    }

    public static function delete_directory($dirname) {
        if (is_dir($dirname)) {
            $dir_handle = opendir($dirname);
            if (!$dir_handle)
                return false;
            while($file = readdir($dir_handle)) {
                if ($file != "." && $file != "..") {
                    if (!is_dir($dirname."/".$file))
                            unlink($dirname."/".$file);
                    else
                            Utils::delete_directory($dirname.'/'.$file);
                }
            }
            closedir($dir_handle);
            rmdir($dirname);

            return true;
        }
    }
}