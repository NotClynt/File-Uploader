<?php

function generateInvisible(): string
{
     $string = '';
     $unicodes = ['\u200B', '\u2060', '\u180E', '\u200D', '\u200C'];

     for ($i = 0; $i <= 34; $i++) {
          $random_keys = array_rand($unicodes);
          $thing = json_decode('"' . $unicodes[$random_keys] . '"');
          $string .= $thing;
     }

     return $string;
}
function generateRandomEmoji(): string
{
     $string = '';
     $unicodes = ['😁', '😂', '😃', '😄', '😅', '😆', '😉', '😊', '😋', '😌', '😍', '😏', '😒', '😓', '😔', '😖', '😘', '😚', '😜', '😝', '😞', '😠', '😡', '😢', '😣', '😤', '😥', '😨', '😩', '😪', '😫', '😭', '😰', '😱', '😲', '😳', '😵', '😷', '\u2060', '\u180E', '\u200D', '\u200C'];

     for ($i = 0; $i <= 12; $i++) {
          $random_keys = array_rand($unicodes);
          $thing = json_decode('"' . $unicodes[$random_keys] . '"');
          $string .= $thing;
     }

     return $string;
}

function generateRandomInt($length)
{
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0;$i < $length;$i++)
    {
        $randomString .= $characters[rand(0, $charactersLength - 1) ];
    }
    return $randomString;
}

function generateRandomString($length = 5)
{
     $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
     $charactersLength = strlen($characters);
     $randomString = '';
     for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
     }
     return $randomString;
}
function get_header($field)
{
     $headers = headers_list();
     foreach ($headers as $header) {
          list($key, $value) = preg_split('/:\s*/', $header);
          if ($key == $field) return $value;
     }
}
function generateSecret($length)
{
     $characters = '0123456789';
     $charactersLength = strlen($characters);
     $randomString = '';
     for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
     }
     return $randomString;
}
function ranCode($length)
{
     $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
     $charactersLength = strlen($characters);
     $randomString = '';
     for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
     }
     return $randomString;
}
function human_filesize($bytes, $decimals)
{
     $size = array(
          'B',
          'KB',
          'MB',
          'GB',
          'TB',
          'PB',
          'EB',
          'ZB',
          'YB'
     );
     $factor = floor((strlen($bytes) - 1) / 3);
     return sprintf("%.{$decimals}f ", $bytes / pow(1024, $factor)) . @$size[$factor];
}
function rndFileName($length)
{
     $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
     $charactersLength = strlen($characters);
     $randomString = '';
     for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
     }
     return $randomString;
}

function uuid()
{
     return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0x0fff) | 0x4000, mt_rand(0, 0x3fff) | 0x8000, mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff));
}
