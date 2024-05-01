<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentoResource\Pages;
use App\Filament\Resources\DocumentoResource\RelationManagers;
use App\Models\Documento;
use App\Models\Documentoclase;
use App\Models\Documentotipo;
use App\Models\Solicitud;
use App\Models\Comprobante;
use Filament\Forms\ComponentContainer;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Resource;
use Illuminate\Support\Collection;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DocumentoResource extends Resource
{
    protected static ?string $model = Documento::class;

    protected static ?string    $navigationIcon = 'heroicon-m-document';
    protected static ?string    $navigationLabel = 'Digitalizacion Documento';
    protected static ?string    $navigationGroup = 'Gestion Documental';
    protected static ?string    $modelLabel = 'Documentos';
    protected static ?string    $slug = 'Par/Tab/Digitalizar';
    protected static ?int       $navigationSort = 2;

    public static function form(Form $form): Form
    {
            return $form
            ->columns(6)
            ->schema([
            Select::make('documentoclase_id')
                ->label('Clase')
                ->columnSpan(2)
                ->options(Documentoclase::all()->pluck('nombre', 'id'))
                ->live(),
            Select::make('documentotipo_id')
                ->label('Tipo de Documento')
                ->columnSpan(3)
                ->options(fn (Get $get): Collection => Documentotipo::query()
                ->where('documentoclase_id', $get('documentoclase_id'))
                ->pluck('nombre', 'id')),
            Select::make('llave_de_consulta_id')
                ->columnSpan(1)
                ->label('Referencia')
                ->loadingMessage('Cargado Operaciones...')
                ->options(function (Get $get): Collection {
                    if ($get('documentoclase_id') == 1) {
                        return Collection::make(Solicitud::query()->pluck('solicitud', 'id')->toArray());
                    } elseif ($get('documentoclase_id') == 2) {
                        return Collection::make(Comprobante::query()->pluck('n_documento', 'id')->toArray());
                    } else {
                        return Collection::make([]);
                    }
                }),
            FileUpload::make('ruta_imagen')
                ->label('Imagen del Documento')
                ->columnSpan(6)
                ->openable()
                ->deletable(false)
                ->previewable(true)
                ->disk('C')
                ->directory('digital')
                ->visibility('public'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('documentoclase.sigla')
                        ->label('Sigla TD')
                        ->searchable(),
                TextColumn::make('documentotipo.nombre')
                        ->label('Tipo Documento')
                        ->searchable(),
                TextColumn::make('solicitud.solicitud')
                        ->label('Solicitud de Credito')
                        ->searchable(),
                TextColumn::make('solicitud.asociado_id')
                        ->label('Asociado')
                        ->searchable(),
            ])
            ->filters([
                //
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDocumentos::route('/'),
            'create' => Pages\CreateDocumento::route('/create'),
            'edit' => Pages\EditDocumento::route('/{record}/edit'),
        ];
    }
}
