<?php


use Illuminate\Database\Seeder;
use SIEC\NestedSetModel;


class NestedSetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $node = NestedSetModel::create([
            'name' => 'Foo',
            'children' => [
                [
                    'name' => 'Bar',
                    'children' => [
                        ['name' => 'Baz'],
                    ],
                ],
            ],
        ]);
    }
}
