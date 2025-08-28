<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('trad.name'))
                    ->required(),
                Textarea::make('ingredients')
                    ->label(__('trad.ingredients'))
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->label(__('trad.description'))
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('price')
                    ->label(__('trad.price').' (€)')
                    ->required()
                    ->numeric(),
                TextInput::make('stock')
                    ->label(__('trad.stock').' (kg)')
                    ->required()
                    ->numeric(),             
                Select::make('categories')
                    ->label(__('trad.categories'))
                    ->multiple()
                    ->relationship('categories', 'name')
                    ->preload(),
                Select::make('sale_type_id')
                    ->label(__('trad.sale_type'))
                    ->relationship('saleType', 'description')
                    ->required(),
                Repeater::make('images')
                    ->relationship()
                    ->schema([
                        FileUpload::make('path')
                            ->hiddenLabel()
                            ->directory('products')                       
                    ])
                    ->label(__('trad.images'))
                    ->nullable(),
            ]);
    }
}
