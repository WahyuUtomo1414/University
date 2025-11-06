<?php

namespace App\Filament\Resources\Lectures\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class LectureForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('lecture_number')
                    ->required()
                    ->label('Lecture Number')
                    ->default(function () {
                        // Ambil nomor terakhir dari database
                        $lastStudent = \App\Models\Lecture::orderBy('id', 'desc')->first();

                        // Tentukan nomor berikutnya
                        $nextNumber = 1; // default jika belum ada data
                        if ($lastStudent && $lastStudent->lecture_number) {
                            // Ambil angka di belakang ST-
                            $lastNumber = (int) str_replace('LC-', '', $lastStudent->lecture_number);
                            $nextNumber = $lastNumber + 1;
                        }

                        // Format jadi ST-000001
                        return 'LC-' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
                    })
                    ->columnSpanFull(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('phone_number')
                    ->tel()
                    ->maxLength(16)
                    ->required(),
                Toggle::make('active')
                    ->required(),
            ]);
    }
}
