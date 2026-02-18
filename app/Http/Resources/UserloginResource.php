<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class UserloginResource extends JsonResource
{
    protected $token;
    public function __construct($user, $token)
    {
        parent::__construct($user);
        $this->token = $token;
    }


    public function toArray(Request $request): array
    {
        return [
            'message' => 'Login successful',
            'name' => $this->name,
            'email' => $this->email,
            'token' => $this->token
        ];
        
    }
}
