<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Filament\Resources\CustomerResource;
use Filament\Actions;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewCustomer extends ViewRecord
{
    protected static string $resource = CustomerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Group::make()->schema([
                Section::make()->schema([
                    TextEntry::make('name'),
                    TextEntry::make('email')->copyable()->copyMessage('Copied!')->copyMessageDuration(1500),
                    TextEntry::make('phone'),
                    TextEntry::make('status'),
                    TextEntry::make('type'),
                ])->columns(3),
            ])->columnSpan(3),
            Section::make()->schema([
                TextEntry::make('updated_at')->since(),
                TextEntry::make('created_at')->dateTime('d F Y'),
            ])->columnSpan(1)->columns(['md'=>2,'lg'=>1,'sm'=>2])
        ])->columns(4);
    }
}
