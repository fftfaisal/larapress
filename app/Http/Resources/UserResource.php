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
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->ID,
            'name' => $this->first_name.' '.$this->last_name,
            'username' => $this->user_login,
            'email' => $this->user_email,
            'avatar' => $this->avatar, // Uses Gravatar from the WordPress User model
            'email_verified_at' => null, // WordPress doesn't have email verification by default
            //            'created_at' => $this->user_registered?->toISOString(),
            'updated_at' => null, // WordPress users don't have updated_at
        ];
    }
}
