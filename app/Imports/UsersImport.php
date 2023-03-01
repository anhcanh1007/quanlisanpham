<?php

namespace App\Imports;

use App\Jobs\ProcessUser;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\RemembersChunkOffset;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;

class UsersImport implements ToCollection,
    WithHeadingRow,
    WithValidation,
    SkipsOnFailure,
    ShouldQueue,
    WithChunkReading
{
    use SkipsFailures, RemembersRowNumber;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    // public function model(array $row)
    // {
    //     return new User([
    //         'name' => $row['name'],
    //         'email' => $row['email'],
    //         'password' =>Hash::make($row['password']),
    //         'birthday' => DateTime::createFromFormat('Y-m-d', $row['birthday']),
    //         'address' => $row['address'],
    //     ]);
    // }

    public function collection(Collection $rows)
    {
        foreach($rows as $key => $row)
        {
            // User::create([
            //     'name' => $row['name'],
            //     'email' => $row['email'],
            //     'password' => Hash::make($row['password']),
            //     'birthday' =>  Date::excelToDateTimeObject($row['birthday'])
            //     ->format('y-m-d'),
            //     'address' => $row['address']
            // ]);
            dispatch(new ProcessUser($row));
        }
    }

    public function rules(): array
    {
        return [
            '*.name' => ['required', 'unique:users,name'],
            '*.email' => ['required', 'unique:users,email'],
            '*.password' => ['required','min:6'],
            '*.birthday' => ['required'],
            '*.address' => ['required'],
        ];
    }

    public function chunkSize(): int
    {
        return 500;
    }

}
