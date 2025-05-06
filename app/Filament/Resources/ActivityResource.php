<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityResource\Pages;
use App\Filament\Resources\ActivityResource\RelationManagers;
use App\Models\Activity;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Facades\Filament;
use Filament\Forms\Components\Hidden;

class ActivityResource extends Resource
{
    protected static ?string $model = Activity::class;
    protected static ?string $label = '活动管理';
    protected static ?string $navigationLabel = '活动管理';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    /**
     * 编辑功能
     * @param Form $form
     * @return Form
     */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('活动标题')
                    ->columnSpanFull()
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('description')
                    ->label('活动简介')
                    ->columnSpanFull(),

                Forms\Components\DateTimePicker::make('start_time')
                    ->label('开始时间')
                    ->required(),

                Forms\Components\DateTimePicker::make('end_time')
                    ->label('结束时间')
                    ->required(),

                Forms\Components\DateTimePicker::make('register_deadline')
                    ->label('报名截止时间'),

                Forms\Components\TextInput::make('location')
                    ->label('活动地点')
                    ->columnSpanFull()
                    ->maxLength(255),

                Forms\Components\TextInput::make('participant_limit')
                    ->label('人数限制')
                    ->numeric(),

                Hidden::make('admin_user_id')
                    ->default(fn() => Filament::auth()->user()->id),

            ]);
    }


    /**
     * 列表功能
     * @param Table $table
     * @return Table
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('活动标题')
                    ->searchable(),

                Tables\Columns\TextColumn::make('start_time')
                    ->label('开始时间')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('end_time')
                    ->label('结束时间')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('register_deadline')
                    ->label('报名截止时间')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('location')
                    ->label('活动地点')
                    ->searchable(),

                Tables\Columns\TextColumn::make('admin.username')
                    ->label('发起人')
                    ->sortable()
                    ->searchable(),


                Tables\Columns\TextColumn::make('participant_limit')
                    ->label('人数限制')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('状态')
                    ->formatStateUsing(fn($state) => match ($state) {
                        0 => '未开始',
                        1 => '进行中',
                        2 => '已结束',
                        default => '未知',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('创建时间')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('更新时间')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageActivities::route('/'),
        ];
    }
}
