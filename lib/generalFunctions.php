<?php

//error_reporting(E_ALL);
//ini_set('display_errors', true);

define('CLASS_REGISTRY_KEY', '__CLASS_REGISTRY');

function debug($o) {
    print "<PRE>";
    print_r($o);
    print "</PRE>";
}

function registerClass($cp) {
    global $globalImportPrefix;
    if (!isset($GLOBALS[CLASS_REGISTRY_KEY])) {
        $GLOBALS[CLASS_REGISTRY_KEY] = array();
    }
    $pos = strrpos($cp, '.');
    if ($pos !== false) {
        $className = substr($cp, $pos + 1);
        $GLOBALS[CLASS_REGISTRY_KEY][$className] = array($cp, $globalImportPrefix);
    }
}

function __autoload($className) {
    //debug("autoimport:$className!");
    //debug($GLOBALS[CLASS_REGISTRY_KEY]);
    if (isset($GLOBALS[CLASS_REGISTRY_KEY][$className])) {
        import($GLOBALS[CLASS_REGISTRY_KEY][$className]);
    } else {
        debug("__Autoload of $className failed");
        exit;
    }
}

function import($desc) {
    global $globalImportPrefix;
    //print "Enter import |$c|$tryLocal|<br>";
    if (is_array($desc)) {
        $c = $desc[0];
        $p2r = $desc[1];
    } else {
        $c = $desc;
        $p2r = $globalImportPrefix;
    }

    $path = str_replace('.', '/', $c);
    $path = $p2r . $path . '.php';
    //print "$path<br>";
    if (file_exists($path)) {
        include_once($path);
        return true;
    } else {
        $success = false;
        if ($success !== true) {
            print "<BR>Can not import [$c]";
            exit();
        }
    }
}

function getGETParameter($varname, $defaultVal = null) {
    if (isset($_GET[$varname])) {
        return condStrip($_GET[$varname]);
    } else {
        return $defaultVal;
    }
}

function getPOSTParameter($varname, $defaultVal = null) {
    if (isset($_POST[$varname])) {
        return condStrip($_POST[$varname]);
    } else {
        return $defaultVal;
    }
}

function getPUTParameter($varname, $defaultVal = null) {
    if (isset($_PUT[$varname])) {
        return condStrip($_PUT[$varname]);
    } else {
        return $defaultVal;
    }
}

function getCookieParameter($varname, $defaultVal = null) {
    if (isset($_COOKIE[$varname])) {
        return condStrip($_COOKIE[$varname]);
    } else {
        return $defaultVal;
    }
}

function getGPParameter($varname, $defaultvalue = null) {
    $ret = getPOSTParameter($varname);
    if ($ret === null) {
        $ret = getGETParameter($varname);
    }
    if ($ret === null) {
        $ret = getPUTParameter($varname);
    }
    if ($ret === null) {
        $ret = $defaultvalue;
    }
    return $ret;
}

function getSERVERParameter($varname, $defaultVal = null) {
    if (isset($_SERVER[$varname])) {
        return $_SERVER[$varname];
    } else {
        return $defaultVal;
    }
}

function condStrip($s) {
    if (gettype($s) == 'array') {
        return $s;
    }
    if (get_magic_quotes_gpc()) {
        return stripslashes($s);
    } else {
        return $s;
    }
}

function n2br($s) {
    $ret = str_replace("\n", "<br />\n", $s);
    return $ret;
}

function safeHTML($val) {
    $val = str_replace('&', '&amp;', $val);
    $val = str_replace('"', '&quot;', $val);
    $val = str_replace("'", '&apos;', $val);
    $val = str_replace('>', '&gt;', $val);
    $val = str_replace('<', '&lt;', $val);
    return $val;
}

function transformValue($val, $transform = '') {
    switch ($transform) {
        case 'n2br':
            $val = n2br($val);
            break;
        case '10yn':
            $val = yesno($val);
            break;
        case 'date':
            $val = usDate($val);
            break;
        case 'n2brhtml':
            $val = n2br(safeHTML($val));
            break;
        default:
            $val = safeHTML($val);
    }
    return $val;
}

function printStackTrace() {
    $bt = debug_backtrace();
    foreach ($bt as $b) {
        print "<pre>";
        print "\nfile:" . $b['file'];
        print "\nline:" . $b['line'];
        if (isset($b['class'])) {
            print "\nclass:" . $b['class'];
        }
        print "\nfunction:" . $b['function'];
        print "\n---------------";
        print "</pre>";
    }
}
