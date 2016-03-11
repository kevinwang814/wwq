<?php
require_once(__DIR__ . '/../util/phpqrcode/qrlib.php');

class Ext_QRCode {
    public static function png($text, $path = false) {
        return QRCode::png($text, $path);
    }
}
?>
