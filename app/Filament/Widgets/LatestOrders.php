<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\OrderResource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;
use App\Models\Order;
class LatestOrders extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 2;
    public function table(Table $table): Table
    {
        return $table
            ->query(OrderResource::getEloquentQuery())
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('id')->label('Order ID')->sortable()->searchable(),
                TextColumn::make('user.name')->label('Customer')->sortable()->searchable(),
                TextColumn::make('grand_total')->label('Total Amount')->money('usd', true)->sortable(),
                TextColumn::make('status')->sortable()->searchable()->badge()->color(fn ($state) => match ($state) {
                    'new' => 'info',
                    'processing' => 'warning',
                    'shipped' => 'warning',
                    'delivered' => 'success',
                    'canceled' => 'danger',
                   
                })
                ->icon(fn ($state) => match ($state) {
                    'new' => 'heroicon-o-sparkles',
                    'processing' => 'heroicon-o-arrow-path',
                    'shipped' => 'heroicon-o-truck',
                    'delivered' => 'heroicon-o-check-badge',
                    'canceled' => 'heroicon-o-x-circle',
                })
                ->sortable(),

                TextColumn::make('payment_method')->sortable()->searchable(),
                TextColumn::make('payment_status')->sortable()->searchable()->badge()->color(fn ($state) => match ($state) {
                    'pending' => 'warning',
                    'completed' => 'success',
                    'failed' => 'danger',
                })->icon(fn ($state) => match ($state) {
                    'pending' => 'heroicon-o-clock',
                    'completed' => 'heroicon-o-check-circle',
                    'failed' => 'heroicon-o-x-circle',
                }),
                TextColumn::make('created_at')->label('Order Date')->dateTime()->sortable(),
                TextColumn::make('updated_at')->label('Last Updated')->dateTime()->sortable(),
            ])
            ->actions([
                Action::make('View Order')
                    ->url(fn (Order $record):string => OrderResource::getUrl('view', ['record' => $record]))
                    ->icon('heroicon-o-eye')
                    ->color('warning')
                    ->openUrlInNewTab(),
            ]);
            
    }
}
