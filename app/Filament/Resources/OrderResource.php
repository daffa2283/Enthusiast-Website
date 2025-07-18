<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationLabel = 'Orders';

    protected static ?string $modelLabel = 'Order';

    protected static ?string $pluralModelLabel = 'Orders';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Order Information')
                    ->schema([
                        TextInput::make('order_number')
                            ->required()
                            ->maxLength(255)
                            ->disabled()
                            ->dehydrated(),
                        
                        Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'processing' => 'Processing',
                                'shipped' => 'Shipped',
                                'delivered' => 'Delivered',
                                'cancelled' => 'Cancelled',
                            ])
                            ->required(),
                        
                        Select::make('payment_status')
                            ->options([
                                'pending' => 'Pending',
                                'paid' => 'Paid',
                                'failed' => 'Failed',
                                'rejected' => 'Rejected',
                                'refunded' => 'Refunded',
                            ])
                            ->required(),
                        
                        TextInput::make('payment_method')
                            ->maxLength(255),
                        
                        FileUpload::make('payment_proof')
                            ->label('Payment Proof')
                            ->disk('public')
                            ->directory('payment_proofs')
                            ->image()
                            ->imagePreviewHeight('200')
                            ->panelAspectRatio('16:9')
                            ->panelLayout('integrated')
                            ->removeUploadedFileButtonPosition('right')
                            ->uploadButtonPosition('left')
                            ->uploadProgressIndicatorPosition('left')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Customer Information')
                    ->schema([
                        TextInput::make('customer_name')
                            ->required()
                            ->maxLength(255),
                        
                        TextInput::make('customer_email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        
                        TextInput::make('customer_phone')
                            ->tel()
                            ->required()
                            ->maxLength(255),
                        
                        Textarea::make('shipping_address')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Order Totals')
                    ->schema([
                        TextInput::make('subtotal')
                            ->required()
                            ->numeric()
                            ->prefix('Rp')
                            ->disabled()
                            ->dehydrated(),
                        
                        TextInput::make('shipping_cost')
                            ->required()
                            ->numeric()
                            ->prefix('Rp')
                            ->default(0),
                        
                        TextInput::make('total')
                            ->required()
                            ->numeric()
                            ->prefix('Rp')
                            ->disabled()
                            ->dehydrated(),
                        
                        Textarea::make('notes')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_number')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->copyable()
                    ->copyMessage('Order number copied to clipboard'),
                
                TextColumn::make('customer_name')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('customer_email')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'info' => 'processing',
                        'primary' => 'shipped',
                        'success' => 'delivered',
                        'danger' => 'cancelled',
                    ])
                    ->sortable(),
                
                BadgeColumn::make('payment_status')
                    ->label('Payment')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'paid',
                        'danger' => 'failed',
                        'danger' => 'rejected',
                        'gray' => 'refunded',
                    ])
                    ->sortable(),
                
                ImageColumn::make('payment_proof')
                    ->label('Payment Proof')
                    ->disk('public')
                    ->height(50)
                    ->width(50)
                    ->defaultImageUrl(url('/images/no-payment-proof.svg'))
                    ->tooltip('Click to view full size')
                    ->toggleable(),
                
                TextColumn::make('total')
                    ->money('IDR')
                    ->sortable()
                    ->weight('bold'),
                
                TextColumn::make('created_at')
                    ->label('Order Date')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'processing' => 'Processing',
                        'shipped' => 'Shipped',
                        'delivered' => 'Delivered',
                        'cancelled' => 'Cancelled',
                    ]),
                
                SelectFilter::make('payment_status')
                    ->label('Payment Status')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'failed' => 'Failed',
                        'rejected' => 'Rejected',
                        'refunded' => 'Refunded',
                    ]),
                
                SelectFilter::make('payment_proof')
                    ->label('Payment Proof')
                    ->options([
                        'with_proof' => 'With Payment Proof',
                        'without_proof' => 'Without Payment Proof',
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['value'] === 'with_proof',
                            fn (Builder $query): Builder => $query->whereNotNull('payment_proof'),
                        )->when(
                            $data['value'] === 'without_proof',
                            fn (Builder $query): Builder => $query->whereNull('payment_proof'),
                        );
                    }),
                
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('Order Date From'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Order Date Until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Action::make('mark_as_processing')
                    ->label('Mark as Processing')
                    ->icon('heroicon-o-clock')
                    ->color('info')
                    ->action(function (Order $record) {
                        $record->update(['status' => 'processing']);
                        Notification::make()
                            ->title('Order status updated')
                            ->success()
                            ->send();
                    })
                    ->visible(fn (Order $record): bool => $record->status === 'pending'),
                
                Action::make('mark_as_shipped')
                    ->label('Mark as Shipped')
                    ->icon('heroicon-o-truck')
                    ->color('primary')
                    ->action(function (Order $record) {
                        $record->update(['status' => 'shipped']);
                        Notification::make()
                            ->title('Order marked as shipped')
                            ->success()
                            ->send();
                    })
                    ->visible(fn (Order $record): bool => $record->status === 'processing'),
                
                Action::make('mark_as_delivered')
                    ->label('Mark as Delivered')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->action(function (Order $record) {
                        $record->update(['status' => 'delivered']);
                        Notification::make()
                            ->title('Order marked as delivered')
                            ->success()
                            ->send();
                    })
                    ->visible(fn (Order $record): bool => $record->status === 'shipped'),
                
                Action::make('confirm_payment')
                    ->label('Confirm Payment')
                    ->icon('heroicon-o-check-badge')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Confirm Payment')
                    ->modalDescription('Are you sure you want to confirm this payment? This action will mark the payment as paid and update the order status.')
                    ->modalSubmitActionLabel('Confirm Payment')
                    ->action(function (Order $record) {
                        $record->update([
                            'payment_status' => 'paid',
                            'status' => $record->status === 'pending' ? 'processing' : $record->status
                        ]);
                        Notification::make()
                            ->title('Payment confirmed successfully')
                            ->body('Order payment has been confirmed and status updated.')
                            ->success()
                            ->send();
                    })
                    ->visible(fn (Order $record): bool => 
                        $record->payment_status === 'pending' && 
                        !empty($record->payment_proof) &&
                        $record->status !== 'cancelled'
                    ),
                
                Action::make('reject_payment')
                    ->label('Reject Payment')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Reject Payment')
                    ->modalDescription('Are you sure you want to reject this payment? This will mark the payment as rejected and cancel the order.')
                    ->modalSubmitActionLabel('Reject Payment')
                    ->action(function (Order $record) {
                        $record->update([
                            'payment_status' => 'rejected',
                            'status' => 'cancelled',
                            // Keep the payment_proof - do not remove it
                        ]);
                        Notification::make()
                            ->title('Payment rejected and order cancelled')
                            ->body('Payment proof has been rejected and the order has been cancelled.')
                            ->warning()
                            ->send();
                    })
                    ->visible(fn (Order $record): bool => 
                        $record->payment_status === 'pending' && 
                        !empty($record->payment_proof) &&
                        $record->status !== 'cancelled'
                    ),
                
                Action::make('view_payment_proof')
                    ->label('View Payment Proof')
                    ->icon('heroicon-o-photo')
                    ->color('info')
                    ->modalContent(function (Order $record) {
                        if (!$record->payment_proof) {
                            return view('filament.modals.no-payment-proof');
                        }
                        return view('filament.modals.payment-proof', ['paymentProof' => $record->payment_proof]);
                    })
                    ->modalHeading('Payment Proof')
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Close')
                    ->visible(fn (Order $record): bool => !empty($record->payment_proof)),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    
                    Tables\Actions\BulkAction::make('bulk_confirm_payment')
                        ->label('Confirm Payments')
                        ->icon('heroicon-o-check-badge')
                        ->color('success')
                        ->requiresConfirmation()
                        ->modalHeading('Confirm Multiple Payments')
                        ->modalDescription('Are you sure you want to confirm payment for all selected orders? This will mark them as paid and update their status.')
                        ->modalSubmitActionLabel('Confirm All Payments')
                        ->action(function ($records) {
                            $confirmedCount = 0;
                            foreach ($records as $record) {
                                if ($record->payment_status === 'pending' && !empty($record->payment_proof) && $record->status !== 'cancelled') {
                                    $record->update([
                                        'payment_status' => 'paid',
                                        'status' => $record->status === 'pending' ? 'processing' : $record->status
                                    ]);
                                    $confirmedCount++;
                                }
                            }
                            
                            Notification::make()
                                ->title("Confirmed {$confirmedCount} payments")
                                ->body("Successfully confirmed payment for {$confirmedCount} orders.")
                                ->success()
                                ->send();
                        }),
                    
                    Tables\Actions\BulkAction::make('bulk_reject_payment')
                        ->label('Reject Payments')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->modalHeading('Reject Multiple Payments')
                        ->modalDescription('Are you sure you want to reject payment for all selected orders? This will mark them as rejected and cancel the orders.')
                        ->modalSubmitActionLabel('Reject All Payments')
                        ->action(function ($records) {
                            $rejectedCount = 0;
                            foreach ($records as $record) {
                                if ($record->payment_status === 'pending' && !empty($record->payment_proof) && $record->status !== 'cancelled') {
                                    $record->update([
                                        'payment_status' => 'rejected',
                                        'status' => 'cancelled',
                                        // Keep the payment_proof - do not remove it
                                    ]);
                                    $rejectedCount++;
                                }
                            }
                            
                            Notification::make()
                                ->title("Rejected {$rejectedCount} payments")
                                ->body("Successfully rejected payment for {$rejectedCount} orders and cancelled them.")
                                ->warning()
                                ->send();
                        }),
                ]),
            ])
            ->emptyStateActions([
                // Tables\Actions\CreateAction::make(), // Removed new order functionality
            ])
            ->defaultSort('created_at', 'desc');
    }
    
    public static function getRelations(): array
    {
        return [
            RelationManagers\OrderItemsRelationManager::class,
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            // 'create' => Pages\CreateOrder::route('/create'), // Removed new order functionality
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }    
}