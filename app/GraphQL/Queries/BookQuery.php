<?php


namespace App\GraphQL\Queries;

use Rebing\GraphQL\Support\Facades\GraphQL;

use App\Models\Book as ModelsBook;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class BookQuery extends Query
{
    protected $attributes = [
        'name' => 'book',
        'description' => 'Query que pode ser usada para buscar um livro por ID ou por Título'
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
                'type' => Type::int()
            ],
            'title' => [
                'name' => 'title',
                'type' => Type::string()
            ],

        ];
    }

    public function resolve($root, $args)
    {
        if (isset($args['id'])) {
            return ModelsBook::where('id', $args['id'])->first();
        }

        if (isset($args['title'])) {
            return ModelsBook::where('title', $args['title'])->first();
        }

        return modelsBook::all();
    }
}
