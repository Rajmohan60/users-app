<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    /**
     * Return a collection of users and their profiles to be exported.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::with('profile')
            ->select('id', 'first_name', 'last_name', 'email', 'dob', 'created_at')
            ->get()
            ->map(function($user) {
                return [
                    'ID' => $user->id,
                    'First Name' => $user->first_name,
                    'Last Name' => $user->last_name,
                    'Email' => $user->email,
                    'Date of Birth' => $user->dob,
                    'Phone' => $user->profile->phone ?? '',
                    'Created At' => $user->created_at,
                ];
            });
    }

    /**
     * Define the headings for the Excel sheet.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'First Name',
            'Last Name',
            'Email',
            'Date of Birth',
            'Phone',
            'Address',
            'Created At',
        ];
    }
}
