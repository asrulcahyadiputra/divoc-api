<?php

    namespace App\Services\V1\User;

    use App\Models\User;
    use Illuminate\Pagination\LengthAwarePaginator;

    class UserService
    {
        public function getAllUser(
            string $kodeLokasi,
            array $filters = [],
            int $perPage = 25
        ) :LengthAwarePaginator
        {
            $query = User::query()
                ->where('kode_lokasi', $kodeLokasi)
                ->with(['role:id,name']);

            if (!empty($filters['search'])) {
                $query->where(function ($q) use ($filters) {
                    $q->where('fullname', 'like', '%' . $filters['search'] . '%')
                        ->orWhere('email', 'like', '%' . $filters['search'] . '%');
                });
            }

            return $query
                ->orderBy('fullname')
                ->paginate($perPage);
        }
    }
