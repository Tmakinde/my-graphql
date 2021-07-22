<?php
namespace App\GraphQL\Types;

use GraphQL;
use App\Models\Team;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class TeamType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'Team',
        'description'   => 'A team',
        // Note: only necessary if you use `SelectFields`
        'model'         => Team::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the user',
                // Use 'alias', if the database column is different from the type name.
                // This is supported for discrete values as well as relations.
                // - you can also use `DB::raw()` to solve more complex issues
                // - or a callback returning the value (string or `DB::raw()` result)
                'alias' => 'user_id',
                
            ],
            'seller_id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The email of user',
                'resolve' => function($root, $args) {
                    // If you want to resolve the field yourself,
                    // it can be done here
                    return $root->seller_id.'';
                }
            ],
            'user_id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The user id',
                'resolve' => function($root, $args) {
                    // If you want to resolve the field yourself,
                    // it can be done here
                    return $root->user_id.'';
                }
                
            ],
            'assigned' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'assigned or not ',
                
            ],
            'user' => [
                'type' => GraphQL::type('User'),
                'description' => 'user in team',
                
            ],
            
        ];
    }

    // You can also resolve a field by declaring a method in the class
    // with the following format resolve[FIELD_NAME]Field()

    protected function resolveIdField($root, $args)
    {
        return $root->id.'';
    }
}