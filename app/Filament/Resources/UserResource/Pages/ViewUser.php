<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;
    // protected static string $na
    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()->icon('heroicon-m-pencil-square'),
            Actions\DeleteAction::make()->icon('heroicon-m-trash')->requiresConfirmation()
                ->modalHeading('Delete User?')
                ->modalDescription('Are you sure you want to delete this user? This action cannot be undone.')
                ->modalSubmitActionLabel('Yes, delete it'),
        ];
    }


    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Section::make()->schema([
                TextEntry::make('name'),
                TextEntry::make('email')->copyable()->copyMessage('Copied!')->copyMessageDuration(1500),
                TextEntry::make('email_verified_at')->dateTime('d F Y'),
                TextEntry::make('updated_at')->since(),
                TextEntry::make('created_at')->dateTime('d F Y'),
            ])->columns(3)
        ]);
    }
}
