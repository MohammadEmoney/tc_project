<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Generate {

    /**
     * Generate a unique ID.
     *
     * @param int $id
     * @return string
     */
    public function uniqueId($id)
    {
        return $id . Str::uuid();
    }

}
