<?php

namespace App\GraphQL\Queries;


use App\Models\Author;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class AuthorsQuery extends Query
{
    protected $attributes = [
        'name' => 'authors',
    ];

    public function type(): Type
    {
        return Type::nonNull(Type::listOf(Type::nonNull(GraphQL::type('Author'))));
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int(),
            ],
        ];
    }

    public function resolve($root, $args)
    {
        if (isset($args['id'])) {
            return Author::where('id', $args['id'])->get();
        }

        return Author::all();
    }
}
