<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Setting';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()->required()->maxLength(255),
                TextInput::make('password')
                    ->password()
                    ->required()
                    ->maxLength(255),
                FileUpload::make('photo')->image()->imageEditor()->maxSize(2000)->disk('public')->directory('photo')->openable()->downloadable()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ViewColumn::make('name')->view('avatar.image-text')->label('Users')->searchable(),
                TextColumn::make('email_verified_at')->dateTime('d F Y')->sortable(),
                TextColumn::make('updated_at')->dateTime()->sortable()->searchable(),
                TextColumn::make('created_at')->dateTime('d F Y')->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filter::make('Email Verified')->query(fn (Builder $query): Builder => $query->where('email_verified_at', '!=', null)),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->icon('heroicon-s-eye')->iconButton(),
                Tables\Actions\EditAction::make()
                    ->icon('heroicon-s-pencil-square')->iconButton()
                    ->action(fn (User $record) => $record->update())
                    ->modalHeading('Edit User')
                    ->modalDescription('Update the user information below.'),
                Tables\Actions\DeleteAction::make()->icon('heroicon-m-trash')->iconButton()
                    ->requiresConfirmation()
                    ->modalHeading('Delete User?')
                    ->modalDescription('Are you sure you want to delete this user? This action cannot be undone.')
                    ->modalSubmitActionLabel('Yes, delete it'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->icon('heroicon-m-trash')->requiresConfirmation()
                        ->modalHeading('Delete User?')
                        ->modalDescription('Are you sure you want to delete this user? This action cannot be undone.')
                        ->modalSubmitActionLabel('Yes, delete it'),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            // 'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
