<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id"                   => $this->id,
            "title"                => $this->title,
            "original_title"       => $this->original_title,
            "original_language"    => $this->original_language,
            "overview"             => $this->overview,
            "adult"                => $this->adult,
            "popularity"           => $this->popularity,
            "vote_average"         => $this->vote_average,
            "vote_count"           => $this->vote_count,
            "release_date"         => $this->release_date,
            "created_at"           => $this->created_at,
            "updated_at"           => $this->updated_at,
            "genres"               => $this->genres()->select("id","genre")->get()
        ];
    }
}

