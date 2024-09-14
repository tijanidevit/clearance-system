<?php

namespace App\Imports;

use App\Enums\ClearanceStatusEnum;
use App\Enums\StudentStatusEnum;
use App\Enums\UserRoleEnum;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentsImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    // use Importable;
    public function __construct(protected $sessionId)
    {
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        DB::transaction(function () use ($row) {
            try {
                $user = User::updateOrCreate(
                    ['email' => $row['email']],
                    [
                        'name' => $row['name'],
                        'email' => $row['email'],
                        'password' => Hash::make('123456'),
                        'role' => UserRoleEnum::STUDENT->value,
                    ],
                );

                return Student::updateOrCreate(
                    [
                        'school_session_id' => $this->sessionId,
                        'matric_number' => $row['matric_number'],
                    ],
                    [
                        'user_id' => $user->id,
                        'status' => StudentStatusEnum::PENDING->value
                    ],
                );
            } catch (\Throwable $th) {
                DB::rollBack();
                throw $th;
            }
        });
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email',
            'matric_number' => ['required', 'string', Rule::unique('students')->ignore($this->sessionId, 'school_session_id')],
        ];
    }
}
