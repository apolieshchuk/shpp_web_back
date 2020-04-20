<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->insert([
            [
               'book' => 'СИ++ И КОМПЬЮТЕРНАЯ ГРАФИКА',
               'authors' => 'Андрей Богуславский',
               'year' => 2020,
               'preview' => '_migration_book1.jpg'
            ],
            [
                'book' => 'Программирование на языке Go!',
                'authors' => 'Марк Саммерфильд',
                'year' => 2008,
                'preview' => '_migration_book2.jpg'
            ],
            [
                'book' => 'Толковый словарь сетевых терминов и аббревиатур',
                'authors' => 'М., Вильямс',
                'year' => 1998,
                'preview' => '_migration_book3.jpg'
            ],
            [
                'book' => 'Python for Data Analysis',
                'authors' => 'Уэс Маккинни',
                'year' => 2008,
                'preview' => '_migration_book4.jpg'
            ],
            [
                'book' => 'Thinking in Java (4th Edition)',
                'authors' => 'Брюс Эккель',
                'year' => 2006,
                'preview' => '_migration_book5.jpg'
            ],
            [
                'book' => 'Introduction to Algorithms',
                'authors' => 'Томас Кормен, Чарльз Лейзерсон, Рональд Ривест, Клиффорд Штайн',
                'year' => 2008,
                'preview' => '_migration_book6.jpg'
            ],
            [
                'book' => 'Adaptive Code via C#: Class and Interface Design, Design Patterns, and SOLID Principles',
                'authors' => 'Гэри Маклин Холл',
                'year' => 2008,
                'preview' => '_migration_book8.jpg'
            ],
            [
                'book' => 'Программирование на языке Go!',
                'authors' => 'Марк Саммерфильд',
                'year' => 2008,
                'preview' => '_migration_book2.jpg'
            ],
        ]);
    }
}
