<?php

namespace App\Filament\Resources\BrandResource\Pages;

use App\Filament\Resources\BrandResource;
use Filament\Actions;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewBrand extends ViewRecord
{
    protected static string $resource = BrandResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([

            Group::make()->schema([
                Section::make()->schema([
                    TextEntry::make('name'),
                ])->columns(2)
            ])->columnSpan(3),
            Section::make()->schema([
                TextEntry::make('updated_at')->since(),
                TextEntry::make('created_at')->dateTime('d F Y'),
            ])->columnSpan(1)
        ])->columns(4);
    }
}
