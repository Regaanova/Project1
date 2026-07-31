<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            "token" => $this["token"],

            "user" => [
                "id" => $this["user"]->id,
                "employe_id" => $this["user"]->employe_id,
                "name" => $this["user"]->name,
                "phone" => $this["user"]->phone,
                "is_active" => $this["user"]->is_active,

                "roles" => $this["user"]->getRoleNames()->first(),
            ],
        ];
    }
}
