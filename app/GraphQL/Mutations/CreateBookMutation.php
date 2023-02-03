<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Book;
use Closure;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CreateBookMutation extends Mutation
{
    protected $attributes = [
        'name' => 'CreateBook',
        'description' => 'A mutation'
    ];

    public function type(): Type
    {
        return Type::nonNull(GraphQL::type('Book'));
    }

    public function args(): array
    {
        return [
            'title' => [
                'name' => 'title',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required'],
            ],
            'author_id' => [
                'name' => 'author_id',
                'type' => Type::int(),

            ],
        ];
    }

    public function resolve($root, array $args)
    {
        $book = new Book();
        $book->title = $args['title'];
        $book->author_id = $args['author_id'];
        $book->save();

        return $book;
    }
}
