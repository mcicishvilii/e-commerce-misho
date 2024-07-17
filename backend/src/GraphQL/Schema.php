<?php
// backend/src/GraphQL/Schema.php

namespace App\GraphQL;

use GraphQL\Type\Schema as GraphQLSchema;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;

class Schema
{
    public static function buildSchema()
    {
        return new GraphQLSchema([
            'query' => new ObjectType([
                'name' => 'Query',
                'fields' => [
                    'messages' => [
                        'type' => Type::listOf(Type::string()),
                        'resolve' => function () {
                            // Fetch messages from the database (placeholder)
                            return ['Message 1', 'Message 2'];
                        }
                    ]
                ]
            ]),
            'mutation' => new ObjectType([
                'name' => 'Mutation',
                'fields' => [
                    'addMessage' => [
                        'type' => Type::string(),
                        'args' => [
                            'message' => Type::nonNull(Type::string())
                        ],
                        'resolve' => function ($root, $args) {
                            // Save the message to the database (placeholder)
                            return $args['message'];
                        }
                    ]
                ]
            ])
        ]);
    }
}