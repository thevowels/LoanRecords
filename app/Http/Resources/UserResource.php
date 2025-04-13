<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    private bool $adminRequest = false;

    public function adminRequest(): self
    {
        $this->adminRequest = true;
        return $this;
    }
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'profile_photo_path' => $this->profile_photo_path,
            'email' => $this->when($this->adminRequest, fn () => $this->email),
            'is_admin' => $this->is_admin,
            'limits' => UserLimitResource::collection($this->whenLoaded('limits')),

        ];
    }
}
