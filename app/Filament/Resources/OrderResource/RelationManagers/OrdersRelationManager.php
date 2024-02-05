<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use App\Filament\Resources\ProductResource;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrdersRelationManager extends RelationManager
{
    protected static string $relationship = 'orders';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Repeater::make('orders')
                    ->schema([
                        Forms\Components\Select::make('product_id')
                            ->options(Product::query()->pluck('name', 'id'))
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(fn ($state, Forms\Set $set) => $set('unit_price', Product::find($state)?->price ?? 0))
                            ->distinct()
                            ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                            ->columnSpan([
                                'md' => 5,
                            ])
                            ->searchable(),

                        Forms\Components\TextInput::make('qty')
                            ->label('Quantity')
                            ->numeric()
                            ->default(1)
                            ->columnSpan([
                                'md' => 2,
                            ])->minValue(1)
                            ->required(),

                        Forms\Components\TextInput::make('unit_price')
                            ->label('Unit Price')
                            ->disabled()
                            ->dehydrated()
                            ->numeric()
                            ->required()
                            ->columnSpan([
                                'md' => 3,
                            ]),
                    ])
                    ->extraItemActions([
                        Action::make('openProduct')
                            ->tooltip('Open product')
                            ->icon('heroicon-m-arrow-top-right-on-square')
                            ->url(function (array $arguments, Repeater $component): ?string {
                                $itemData = $component->getRawItemState($arguments['item']);

                                $product = Product::find($itemData['product_id']);

                                if (!$product) {
                                    return null;
                                }

                                return ProductResource::getUrl('edit', ['record' => $product]);
                            }, shouldOpenInNewTab: true)

                    ])
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('product')
            ->columns([
                Tables\Columns\TextColumn::make('product'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
