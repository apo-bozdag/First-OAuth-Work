<?php

namespace App\Repository\Transformers;

class CitiesTransformer extends Transformer{

    public function transform($article){

        return [
            'id' => $article->id,
            'name' => $article->name,
            'slug' => $article->slug,
            'body' => $article->body,
            'user' => [
                'id' => $article->user->id,
                'fullname' => $article->user->name,
                'email' => $article->user->email,
            ]
        ];

    }

}
