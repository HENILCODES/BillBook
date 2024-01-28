<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Filament\Resources\CustomerResource;
use Filament\Actions;
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

            Section::make()->schema([
                ImageEntry::make('photo')->label('Profile Photo')->circular()->columnSpanFull(),
                TextEntry::make('name'),
                TextEntry::make('email')->copyable()->copyMessage('Copied!')->copyMessageDuration(1500),
                TextEntry::make('email_verified_at')->dateTime('d F Y'),
                TextEntry::make('updated_at')->since(),
                TextEntry::make('created_at')->dateTime('d F Y'),
            ])->columns(3)
        ]);
    }
}
