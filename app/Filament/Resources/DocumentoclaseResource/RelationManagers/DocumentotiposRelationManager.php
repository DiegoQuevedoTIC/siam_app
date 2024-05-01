<?php

namespace App\Filament\Resources\DocumentoclaseResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use App\Models\Documentoclase;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Checkbox;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DocumentotiposRelationManager extends RelationManager
{
    protected static string $relationship = 'documentotipos';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
            TextInput::make('nombre')
                ->label('Nombre del Tipo de Documento')
                ->required()
                ->maxLength(255),
            Textarea::make('descripcion')
                ->label('Descripción')
                ->rows(3)
                ->maxLength(500)
                ->hint('Opcional: Breve descripción del tipo de documento.'),
            Checkbox::make('exigido')
                ->label('¿Es Exigido?')
                ->default(true)
                ->hint('Indica si este tipo de documento es exigido en los procesos.'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nombre')
            ->columns([
                TextColumn::make('nombre')
                ->label('Tipo de Documento'),
                TextColumn::make('descripcion')
                ->label('Descripción'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
