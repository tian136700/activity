<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdminApplicationResource\Pages;
use App\Models\AdminApplication;
use App\Models\Department;
use App\Models\Major;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;

class AdminApplicationResource extends Resource
{
    protected static ?string $model = AdminApplication::class;
    protected static ?string $navigationLabel = '管理员申请';
    protected static ?string $label = '管理员申请';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    /**
     * 审核功能
     * @param Form $form
     * @return Form
     */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Placeholder::make('姓名')
                    ->content(fn($record) => $record?->user?->name),

                Forms\Components\Placeholder::make('学号')
                    ->content(fn($record) => $record?->user?->student_id),

                Forms\Components\Placeholder::make('用户名')
                    ->content(fn($record) => $record?->user?->username),

                Forms\Components\Placeholder::make('手机号')
                    ->content(fn($record) => $record?->user?->phone),

                Forms\Components\Placeholder::make('院系')
                    ->content(function ($record) {
                        return $record?->user?->department?->name ?? '无';
                    }),

                Forms\Components\Placeholder::make('专业')
                    ->content(function ($record) {
                        return $record?->user?->major?->name ?? '无';
                    }),

                Forms\Components\Placeholder::make('班级')
                    ->content(function ($record) {
                        return $record?->user?->class?->name ?? '无';
                    }),


                Forms\Components\Textarea::make('reason')
                    ->label('申请理由')
                    ->disabled()
                    ->columnSpanFull(),

                Forms\Components\Select::make('status')
                    ->label('审核状态')
                    ->options([
                        1 => '审核通过',
                        2 => '审核拒绝',
                    ])
                    ->required(),

                Forms\Components\Hidden::make('reviewed_at')
                    ->default(now())
                    ->dehydrated(), // ✅ 让值写入数据库

                Forms\Components\Hidden::make('reviewer_id')
                    ->default(fn() => auth()->id())
                    ->dehydrated(), // ✅ 同上

            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('申请人')
                    ->searchable(),
                TextColumn::make('user.username')
                    ->label('用户名')
                    ->searchable(),
                TextColumn::make('reason')
                    ->label('申请理由')
                    ->limit(30),
                TextColumn::make('status')
                    ->label('审核状态')
                    ->formatStateUsing(fn($state) => match ($state) {
                        0 => '未审核',
                        1 => '通过',
                        2 => '拒绝',
                        default => '未知',
                    })
                    ->sortable(),
                TextColumn::make('reviewed_at')
                    ->label('审核时间')
                    ->dateTime()
                    ->sortable()
                    ->formatAsDateTime(),
                TextColumn::make('reviewer.username')
                    ->label('审核人'),
                TextColumn::make('created_at')
                    ->label('提交时间')
                    ->dateTime()
                    ->sortable()
                    ->formatAsDateTime(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('审核'), // ✅ 将按钮名称改为“审核”,

//                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ManageAdminApplications::route('/'),
            'edit' => Pages\EditAdminApplication::route('/{record}/edit'),
        ];
    }

    /**
     * 隐藏创建按钮
     * @return bool
     */
    public static function canCreate(): bool
    {
        return false;
    }
}
