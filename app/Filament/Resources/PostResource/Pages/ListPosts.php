<?php

namespace App\Filament\Resources\PostResource\Pages;

use Filament\Pages\Actions;
use App\Filament\Resources\PostResource;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\PostResource\Widgets\CustomerOverview;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            CustomerOverview::class,
        ];
    }

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
