<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $fillable = [
        "order",
        "type",
        "name",
        "data",
        "required"
    ];

    protected $casts = [
        "data" => "array",
        "required" => "boolean"
    ];

    public function printForm($value = "") {
        $required = "";
        $span = "";
        if ($this->required) {
            $span = '<span class="text-danger ml-2">*</span>';
            $required = "required=true";
        }
        switch($this->type) {
            case 'input:text':
                return "<div class='form-group'>" .
                    "<label for='{$this->name}'>{$this->name}{$span}</label>" .
                    "<input {$required} type='text' name='data[{$this->name}]' id='{$this->name}' class='form-control' placeholder='{$this->name}' value='{$value}'/>" .
                "</div>";
            break;
            case 'input:number':
                return "<div class='form-group'>" .
                    "<label for='{$this->name}'>{$this->name}{$span}</label>" .
                    "<input {$required} type='number' min=0 name='data[{$this->name}]' id='{$this->name}' class='form-control' placeholder='{$this->name}' value='{$value}'/>" .
                "</div>";
            break;
            case 'input:email':
                return "<div class='form-group'>" .
                    "<label for='{$this->name}'>{$this->name}{$span}</label>" .
                    "<input {$required} type='email' name='data[{$this->name}]' id='{$this->name}' class='form-control' placeholder='{$this->name}' value='{$value}'/>" .
                "</div>";
            break;
            case 'input:phone':
                return "<div class='form-group'>" .
                    "<label for='{$this->name}'>{$this->name}{$span}</label>" .
                    "<input {$required} type='phone' name='data[{$this->name}]' id='{$this->name}' class='form-control' placeholder='{$this->name}' value='{$value}'/>" .
                "</div>";
            break;
            case 'input:check':
                $checked = "";
                if (!empty($value))
                    $checked = "checked=true";
                return "<div class='form-group form-check'>" .
                    "<input type='hidden' name='check[]' value='{$this->name}'/>" .
                    "<input type='checkbox' {$required} class='form-check-input' name='data[{$this->name}]' value=1 id='{$this->name}' {$checked}>" .
                    "<label for='{$this->name}'>{$this->name}{$span}</label>" .
                "</div>";
            break;
            case 'textarea':
                return "<div class='form-group'>" .
                    "<label for='{$this->name}'>{$this->name}{$span}</label>" .
                    "<textarea {$required} name='data[{$this->name}]' id='{$this->name}' class='form-control' placeholder='{$this->name}'>{$value}</textarea>" .
                "</div>";
            break;
            default:
                return "";
        }
    }
}
