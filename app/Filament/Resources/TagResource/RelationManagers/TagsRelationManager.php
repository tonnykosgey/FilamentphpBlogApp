<?php

namespace App\Filament\Resources\TagResource\RelationManagers;

use Closure;
use Filament\Forms;
use Filament\Tables;
use Illuminate\Support\Str;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Actions\DeleteAction;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DetachAction;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\DetachBulkAction;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class TagsRelationManager extends RelationManager
{
    protected static string $relationship = 'tags';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                              
                
                Card::make()->schema([ 
                    TextInput::make('title')->reactive()
                                ->afterStateUpdated(function (Closure $set, $state) {
                                    $set('slug', Str::slug($state));
                                })->required(),
                    TextInput::make('slug')->required(),
                    Select::make('category_id')->relationship('category', 'name'),
                    SpatieMediaLibraryFileUpload::make('thumbnail'),
                    RichEditor::make('content'),
                    Toggle::make('is_published')
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                
                TextColumn::make('id')->sortable(),
                TextColumn::make('title')->limit(50)->sortable(),
                ToggleColumn::make('is_published')
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\AttachAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DetachBulkAction::make(),
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }    
}
