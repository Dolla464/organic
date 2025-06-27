<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    
    public function toArray($request)
    {
        return [
            "ID"=> $this->id,
            "UserName"=> $this->name,
            "Email"=> $this->email,
            "Password"=> $this->password,
            "Role"=> $this->role,
            "Status"=> $this->status,
            "Created_at"=>$this->created_at,
            "Updated_at"=>$this->updated_at,
        ];
    }
}
