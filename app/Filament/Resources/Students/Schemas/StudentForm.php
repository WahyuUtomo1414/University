<?php

namespace App\Filament\Resources\Students\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class StudentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('student_number')
                    ->label('Student Number')
                    ->required()
                    ->default(function () {
                        // Ambil nomor terakhir dari database
                        $lastStudent = \App\Models\Student::orderBy('id', 'desc')->first();

                        // Tentukan nomor berikutnya
                        $nextNumber = 1; // default jika belum ada data
                        if ($lastStudent && $lastStudent->student_number) {
                            // Ambil angka di belakang ST-
                            $lastNumber = (int) str_replace('ST-', '', $lastStudent->student_number);
                            $nextNumber = $lastNumber + 1;
                        }

                        // Format jadi ST-000001
                        return 'ST-' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
                    })
                    ->columnSpanFull(),
                TextInput::make('name')
                    ->required(),
                DatePicker::make('born')
                    ->required(),
                Textarea::make('street')
                    ->required()
                    ->columnSpanFull(),
                Toggle::make('active')
                    ->required(),
            ]);
    }
}
