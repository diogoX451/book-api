<?php


namespace App\GraphQL\Mutations\Category;

use App\Models\Book;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class UpdateBookMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateBook',
        'description' => 'Update a book'
    ];
    public  function type(): Type
    {
        return GraphQL::type('Book');
    }
    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required'],
            ],
            'title' => [
                'name' => 'title',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required'],
            ],
            'author_id' => [
                'name' => 'author_id',
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required'],
            ],
        ];
    }
    public function resolve($root, $args)
    {
        $book = Book::findOrFail($args['id']);
        $book->fill($args);
        $book->save();

        return $book;
    }
}
