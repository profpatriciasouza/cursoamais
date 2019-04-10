<?php

/**
 * Description of Hook
 *
 * @author schirm
 */
class Hook {

    static $handles;

    static function addHandle($callName, $handleFunction, $handleID = "") {
        Hook::$handles[$callName][$handleID] = $handleFunction;
    }

    static function removeHandle($callName, $handleID = "") {
        if (!empty($handleID))
            unset(Hook::$handles[$callName][$handleID]);
        else
            unset(Hook::$handles[$callName]);

        if (count(Hook::$handles[$callName]) == 0)
            unset (Hook::$handles[$callName]);
    }

    static function exec($callName, $param) {
        if (isset(Hook::$handles[$callName])) {
            foreach (Hook::$handles[$callName] as $handle) {
                if (is_array($handle)) {
                    $param = call_user_func($handle, $param);
                } else
                    $param = $handle($param);
            }
        }
        return $param;
    }

}