<?php
function param($type, $default = null) {
    $data = \App\Parameter::where("type", $type)->first();
    if ($data)
        return $data->value;
    return $default;
}
/**
 * @param $code
 */
function helpTag($code) {
    $e = \App\Help::where("code", $code)->first();
    if ($e)
        return "<small class='text-muted form-text'>{$e->data}</small>";
    return env("APP_ENV") == "local" ? "<small class='text-muted form-text'>{$code}</small>" : "";
}
/**
 * @param $code
 */
function labelElement($code) {
    $e = \App\Label::where("code", $code)->first();
    if ($e)
        return $e->data;
    return $code;
}
/**
 * @param $code
 */
function textPrint($code) {
    $e = \App\Text::where("code", $code)->first();
    if ($e)
        return $e->data;
    return env("APP_ENV") == "local" ? $code : "";
}