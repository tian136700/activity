<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\Department;
use App\Models\Major;
use App\Models\SchoolClass;
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

                // 院系选择框
                Forms\Components\Select::make('department_id')
                    ->label('院系')
                    ->options(Department::all()->pluck('name', 'id'))
                    ->reactive() // 使得院系选择变得动态
                    ->afterStateUpdated(fn($state, $get) => $get('major_id') && $get('class_id') && $state ? self::loadMajors($state) : null), // 调用静态方法

                // 专业选择框
                Forms\Components\Select::make('major_id')
                    ->label('专业')
                    ->options(fn($get) => self::loadMajors($get('department_id')))
                    ->reactive()
                    ->afterStateUpdated(fn($state, $get) => self::loadClasses($state)),

                // 班级选择框
                Forms\Components\Select::make('class_id')
                    ->label('班级')
                    ->options(fn($get) => self::loadClasses($get('major_id')))
                    ->reactive(),

                Forms\Components\TextInput::make('year')
                    ->label('入学年份')
                    ->numeric(),
            ]);
    }


    // 将方法修改为静态方法
    public static function loadMajors($departmentId)
    {
        return Major::where('department_id', $departmentId)->pluck('name', 'id');
    }

    public static function loadClasses($majorId)
    {
        return SchoolClass::where('major_id', $majorId)->pluck('class_number', 'id');
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
                    ->formatStateUsing(fn($state) => match ($state) {
                        'male' => '男',
                        'female' => '女',
                        'other' => '其他',
                        default => '未知',
                    }),

                // 显示院系名称
                Tables\Columns\TextColumn::make('department.name')
                    ->label('院系')
                    ->searchable(),

                // 显示专业名称
                Tables\Columns\TextColumn::make('major.name')
                    ->label('专业')
                    ->searchable(),

                // 显示班级名称
                Tables\Columns\TextColumn::make('class.name')
                    ->label('班级')
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

    /**
     * 隐藏创建按钮
     * @return bool
     */
    public static function canCreate(): bool
    {
        return false;
    }
}
