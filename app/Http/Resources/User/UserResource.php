<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Role\RoleResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,  
            'name' => $this->name,
            'role' => $this->role,
            'email' => $this->email,
            'gender' => $this->gender,
            'phone' => $this->phone,
            'address' => $this->address,
            'joined_on' => $this->joined_on,
        ];
    }
}
