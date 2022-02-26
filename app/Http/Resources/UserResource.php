<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    protected $api_token;
    protected bool $with_profile = false;

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
        ];
        $this->api_token ? $data['api_token'] = $this->api_token : '';

        if ($this->with_profile) {
            $data['is_admin'] = $this->is_admin;
            $data['is_stakeholder'] = $this->is_stakeholder;
            $data['stakeholder_id'] = $this->stakeholder_id;
            $data['gender'] = $this->gender;
            $data['nik'] = $this->nik;
            $data['address'] = $this->address;
            $data['blood_type'] = $this->blood_type;
            $data['phone'] = $this->phone;
            $data['emergency_contact'] = $this->emergency_contact;
        }

        return $data;
    }

    public function api_token($value)
    {
        $this->api_token = $value;
        return $this;
    }

    public function with_profile()
    {
        $this->with_profile = true;
        return $this;
    }
}

