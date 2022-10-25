<?php

namespace App\Filament\Resources\PostResource\Widgets;

use App\Models\Post;
use Filament\Widgets\Widget;
use Filament\Widgets\StatsOverviewWidget\Card;

class CustomerOverview extends Widget
{
    protected static string $view = 'filament.resources.post-resource.widgets.customer-overview';
    
    protected function getCards(): array
    {
        return [
            Card::make('All Posts', Post::all()->count()),
            Card::make('All Categories', '21%'),
            Card::make('All Tags', '3:12'),
        ];
    }
}
