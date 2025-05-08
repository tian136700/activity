<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityUserSignupResource\Pages;
use App\Filament\Resources\ActivityUserSignupResource\RelationManagers;
use App\Models\ActivityUserSignup;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class ActivityUserSignupResource extends Resource
{
    protected static ?string $model = ActivityUserSignup::class;
    protected static ?string $label = '用户报名';
    protected static ?string $navigationLabel = '用户报名';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

//    public static function form(Form $form): Form
//    {
//        return $form
//            ->schema([
//                Forms\Components\TextInput::make('user_id')
//                    ->required()
//                    ->numeric(),
//                Forms\Components\TextInput::make('activity_id')
//                    ->required()
//                    ->numeric(),
//                Forms\Components\DateTimePicker::make('signed_at'),
//            ]);
//    }


//    public static function query(): Builder
//    {
//        return parent::query()
//            ->with('user.department', 'user.major', 'user.class');
//    }

    public static function table(Table $table): Table
    {

//        $userSignups = ActivityUserSignup::with('user.department', 'user.major', 'user.class')->get();
//        dd($userSignups);

        return $table
            ->columns([
                TextColumn::make('user.name')->label('姓名')->searchable(),
                TextColumn::make('user.student_id')->label('学号'),
                TextColumn::make('user.username')->label('用户名')->searchable(),
                TextColumn::make('user.phone')->label('手机号'),
                TextColumn::make('user.department.name')->label('院系'),
                TextColumn::make('user.major.name')->label('专业'),
                TextColumn::make('user.class.name')->label('班级'),
                TextColumn::make('activity.title')->label('活动名称')->searchable(),
                TextColumn::make('signed_at')->label('报名时间')->dateTime()->sortable()->formatAsDateTime(),
                // 新增的签到状态列
                TextColumn::make('sign_in_status')
                    ->label('签到状态')
                    ->formatStateUsing(fn($state) => $state == 1 ? '已签到' : '未签到')
                    ->sortable(),
            ])
            ->actions([
//                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->headerActions([
                ExportAction::make()
                    ->label('导出报名数据')
                    ->exports([
                        ExcelExport::make()
                            ->fromTable()
                            ->withFilename('用户报名数据')
                            ->withWriterType(\Maatwebsite\Excel\Excel::XLSX),
                    ]),
            ]);
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageActivityUserSignups::route('/'),
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
