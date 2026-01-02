<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UsersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'       => $this->id,
            'name'     => $this->fullname,
            'email'    => $this->email,
            'status'   => $this->active,
            'role'     => [
                'id'   => $this->role_id,
                'name' => $this->role?->name,
            ],
            'avatar' => $this->profile_picture
                ? Storage::disk('s3')->temporaryUrl(
                    $this->profile_picture,
                    now()->addMinutes(5)
                )
                : null,
            'created_at' => $this->created_at?->toISOString(),
        ];
    }
}
