<?php

namespace Marshmallow\NovaResourceClick\Traits;

trait HasSortableManyToManyRows
{
    use HasSortableRows;

    public $disableSortOnIndex = true;
}
