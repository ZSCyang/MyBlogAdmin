<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BaseModel extends Model
{
    public function allowField($data, $table)
    {
        $fields = Schema::getColumnListing($table);
        $pFields = array_keys($data);
        $diffs = array_diff($pFields, $fields);
        if (!empty($diffs)) {
            foreach ($diffs as $v) {
                unset($data[$v]);
            }
        }
        return $data;
    }
}
