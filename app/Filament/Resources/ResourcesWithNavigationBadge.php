<?php

namespace App\Filament\Resources;

use Filament\Resources\Resource;

/**
 * This class adds navigation badge to all of the resoures witch extends it
 */

abstract class ResourcesWithNavigationBadge extends Resource
{
    public static function getNavigationBadge(): ?string
    {
        $model = static::getModel(); 
        return (string) $model::count();
    }
}