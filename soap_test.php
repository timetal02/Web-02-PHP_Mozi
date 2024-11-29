<?php
if (class_exists('SoapClient')) {
    echo "SOAP modul aktív!";
} else {
    echo "SOAP modul nincs engedélyezve!";
}