<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Jenssegers\Mongodb\Eloquent\Model;

class Server extends Model
{
    use HasFactory;

    public function getUrl(string $path = null): string
    {
        $s = (string) Str::finish(rtrim($this->host,'/') . ($this->port ? ':'.$this->port : ''),'/');

        return ($path) ? $s.$path : $s;
    }
}
