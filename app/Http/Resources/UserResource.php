<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'    => $this->id,
            'name'  => $this->fullname,
            'email' => $this->email,

            'avatar' => $this->profile_picture
                ? Storage::disk('s3')->temporaryUrl(
                    $this->profile_picture,
                    now()->addMinutes(5)
                )
                : null,
        ];
    }
}
