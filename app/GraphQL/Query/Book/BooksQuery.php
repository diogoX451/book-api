<?php

namespace App\GraphQL\Queries\Quest;

use App\Models\Book;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;


class BooksQuery extends Query
{

    protected $attributes = [
        'name' => 'books',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Book'));
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
            return Book::where('id', $args['id'])->get();
        }

        return Book::all();
    }
}
