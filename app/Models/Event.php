<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'type', 'date', 'time', 'place', 'responsible', 'group', 'status', 'priority', 'needs_publicity', 'notes'])]
class Event extends Model
{
    protected function casts(): array
    {
        return ['date' => 'date', 'needs_publicity' => 'boolean'];
    }
}
