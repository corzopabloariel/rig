<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = [
        "entity",
        "entity_id",
        "data",
        "user_id",
        "type"
    ];
    /**
     * 0 -> "entity"
     * 1 -> "entity_id"
     * 2 -> "data"
     * 3 -> "user_id"
     * 4 -> "type"
     */
    public static function create(...$args) {
        $data = [];
        if (isset($args[0])) {
            $data["entity"] = $args[0];
            if (isset($args[1]))
                $data["entity_id"] = $args[1];
            if (isset($args[2]))
                $data["data"] = $args[2];
            if (isset($args[3]))
                $data["user_id"] = $args[3];
            if (isset($args[4]))
                $data["type"] = $args[4];
            $data["created_at"] = date("Y-m-d h:i:s",time());
            $data["updated_at"] = date("Y-m-d h:i:s",time());
            return \DB::table('logs')->insert($data);
        }
        return 0;
    }
}
