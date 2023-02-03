<?php


namespace App\GraphQL\Mutations\Category;

use App\Models\Book;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class DeleteBookMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteBook',
        'description' => 'Delete a book'
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
        ];
    }
    public function resolve($root, $args)
    {
        $book = Book::findOrFail($args['id']);
        return $book->delete();
    }
}
