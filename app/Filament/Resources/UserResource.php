<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $label = '用户管理';

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
                Forms\Components\TextInput::make('name')
                    ->label('姓名')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('student_id')
                    ->label('学号')
                    ->maxLength(255),

                Forms\Components\TextInput::make('email')
                    ->label('邮箱')
                    ->email()
                    ->maxLength(255),

                Forms\Components\TextInput::make('username')
                    ->label('用户名')
                    ->maxLength(255),

                Forms\Components\TextInput::make('phone')
                    ->label('手机号')
                    ->tel()
                    ->maxLength(255),

                Forms\Components\Select::make('gender')
                    ->label('性别')
                    ->options([
                        'male' => '男',
                        'female' => '女',
                        'other' => '其他',
                    ])
                    ->nullable(),

                Forms\Components\TextInput::make('department')
                    ->label('院系')
                    ->maxLength(255),

                Forms\Components\TextInput::make('major')
                    ->label('专业')
                    ->maxLength(255),

                Forms\Components\TextInput::make('year')
                    ->label('入学年份')
                    ->numeric(),

                // Forms\Components\DateTimePicker::make('email_verified_at')
                //     ->label('邮箱验证时间'),
            ]);
    }

    /**
     * 前台列表
     * @param Table $table
     * @return Table
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('姓名')
                    ->searchable(),

                Tables\Columns\TextColumn::make('student_id')
                    ->label('学号')
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('邮箱')
                    ->searchable(),

                Tables\Columns\TextColumn::make('username')
                    ->label('用户名')
                    ->searchable(),

                Tables\Columns\TextColumn::make('phone')
                    ->label('手机号')
                    ->searchable(),

                Tables\Columns\TextColumn::make('gender')
                    ->label('性别')
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'male' => '男',
                        'female' => '女',
                        'other' => '其他',
                        default => '未知',
                    }),

                Tables\Columns\TextColumn::make('department')
                    ->label('院系')
                    ->searchable(),

                Tables\Columns\TextColumn::make('major')
                    ->label('专业')
                    ->searchable(),

                Tables\Columns\TextColumn::make('year')
                    ->label('入学年份')
                    ->numeric()
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
            'index' => Pages\ManageUsers::route('/'),
        ];
    }
}
