<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TrainingSessionResouce extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
         'id'=>$this->id,
        'name'=>$this->name,
        'day'=>$this->day,
        'started_at'=>$this->started_at,
        'finished_at'=>$this->finished_at,
        'gym_id'=>$this->gym_id,
        'gym' =>$this->gyms,
        ];
    }
}
