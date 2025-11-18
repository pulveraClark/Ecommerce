<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Illuminate\Support\Str;
use Illuminate\Support\Facades;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Filters\SelectFilter;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?int $navigationSort = 4;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make('Product Information')->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Product Name')
                             ->required()
                            ->reactive() 
                            ->afterStateUpdated(function ($state, callable $set) {
                               $set('slug', Str::slug($state));
                            })
                              ->maxLength(255),
                        Forms\Components\Textarea::make('slug')
                            ->label('Slug')
                            ->required()
                            ->disabled()
                            ->dehydrated()
                            ->maxLength(255)
                            ->unique(Product::class, 'slug', ignoreRecord: true),
                        Forms\Components\MarkdownEditor::make('description')
                            ->columnSpanFull()
                            ->fileAttachmentsDirectory('products')
                    ])->columns(2),
                     
                    Section::make('Images')->schema([
                        Forms\Components\FileUpload::make('images')
                            ->multiple()
                            ->directory('products')
                            ->maxFiles(5)
                            ->reorderable()
                    ])->columns(1),
                ])->columnSpan(2),

                Group::make()->schema([
                    Section::make('Price')->schema([
                        Forms\Components\TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->prefix('$'),
                    ]),
                        Section::make('Associations')->schema([
                        Forms\Components\Select::make('category_id')
                            ->searchable()
                            ->preload()
                            ->relationship('category', 'name')
                            ->required(),

                        Forms\Components\Select::make('brand_id')
                            ->searchable()
                            ->preload()
                            ->relationship('brand', 'name')
                            ->required()
                        ]),
                        Section::make('Status')->schema([
                        Forms\Components\Toggle::make('in_stock')
                            ->label('In Stock')
                            ->required()
                            ->default(true),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->required()
                            ->default(true),
                        Forms\Components\Toggle::make('is_featured')
                            ->label('Featured Product')
                            ->required(),
                        Forms\Components\Toggle::make('on_sale')
                            ->label('On Sale')
                            ->required(),

                        ]),
                ])->columnSpan(1),

            ])->columns(3);
            
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Product Name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('category.name')->label('Category')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('brand.name')->label('Brand')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('price')->label('Price')->money('usd', true)->sortable(),
                Tables\Columns\BooleanColumn::make('in_stock')->label('In Stock')->sortable(),
                Tables\Columns\BooleanColumn::make('is_active')->label('Active')->sortable(),
                Tables\Columns\BooleanColumn::make('is_featured')->label('Featured')->sortable(),
                Tables\Columns\BooleanColumn::make('on_sale')->label('On Sale')->sortable(),
                Tables\Columns\TextColumn::make('created_at')->label('Created At')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')->label('Updated At')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('category')->relationship('category', 'name'),
                SelectFilter::make('brand')->relationship('brand', 'name'),
                
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
