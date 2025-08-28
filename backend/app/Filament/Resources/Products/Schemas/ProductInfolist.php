<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label(__('trad.name')),
                TextEntry::make('price')
                    ->label(__('trad.price'))
                    ->money('EUR'),
                TextEntry::make('stock')
                    ->label(__('trad.stock'))
                    ->suffix(' kg')
                    ->numeric(),
                ImageEntry::make('images.path')
                    ->label(__('trad.images'))
                    ->circular() // opcional
                    ->stacked()  // para que aparezcan una encima de otra
                    ->limit(5),
                TextEntry::make('saleType.description')
                    ->label(__('trad.sale_type')),
                TextEntry::make('created_at')
                    ->label(__('trad.created_at'))
                    ->dateTime('d M y - H:i'),
                TextEntry::make('updated_at')
                    ->label(__('trad.updated_at'))
                    ->dateTime('d M y - H:m'),
            ]);
    }
}
