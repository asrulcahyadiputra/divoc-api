<?php

    namespace App\Services\V1\Auth;

    use App\Exceptions\BusinessException;
    use App\Exceptions\Domain\AuthException;
    use App\Http\Resources\UserResource;
    use App\Models\DivocLocationPackage;
    use App\Models\Location;
    use App\Models\Role;
    use App\Models\User;
    use Illuminate\Support\Facades\Hash;

    class LoginService
    {
        public function login(array $credentials): array
        {
            $user = User::where('email', $credentials['email'])
                ->first();

            if(!$user) {
                throw AuthException::userNotFound();
            }

            if(!$user->active) {
                throw AuthException::inactiveUser();
            }

            if(!Hash::check($credentials['password'], $user->password_hash)) {
                throw AuthException::invalidCredential();
            }

            $role = Role::where('id', $user->role_id)->where('kode_lokasi', $user->kode_lokasi)->first();

            $location = Location::where('kode_lokasi', $user->kode_lokasi)->first();

            if(!$location) {
                throw AuthException::noLocation();
            }

            $package = DivocLocationPackage::where('kode_lokasi', $location->kode_lokasi)
                ->with('packet')
                ->where('is_active', 1)
                ->latest()
                ->first();

            if(!$package) {
                throw new BusinessException('Lokasi ini tidak terdaftar dalam paket.');
            }

            $token = $user->createToken('divoc-api')->plainTextToken;

            return [
                'user' => UserREsource::make($user),
                'location' => [
                    'id'   => $location->kode_lokasi,
                    'name' => $location->nama,
                    'code' => $location->kode_lokasi,
                ],
                'role' => [
                    'id'   => $role->id,
                    'name' => $role->name,
                ],
                'package' => [
                    'name'       => $package->packet->name,
                    'status'     => $package->is_active,
                    'expired_at' => $package->end_date,
                ],
                'token' => $token,
            ];
        }
    }
