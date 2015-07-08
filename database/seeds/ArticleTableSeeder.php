<?php
/**
 * Created by PhpStorm.
 * User: Daniele
 * Date: 17/06/15
 * Time: 00:55
 */

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use App\Article;
use App\Category;
use App\User;

class ArticleTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('it_IT');
        $articlesCount = 50;
        $categoriesIds = $this->getCategoriesIdsArray();

        for($c = 0; $c < $articlesCount; $c++)
        {
            $title = $faker->sentence();
            $slug = Str::slug($title);
            // creo l'articolo
            $article = Article::create([
                'title' => $title,
                'slug' => $slug,
                'body' => '<p>'.$faker->paragraph(10).'</p>',

                'is_published' => $faker->boolean(80),
                'published_at' => $faker->dateTimeThisYear($max = 'now'),

                'meta_keys' => implode(',', $faker->words(5)),
                'meta_description' => $faker->sentence(),

                // associo casualmente un autore all'articolo
                'user_id' => User::orderByRaw('RAND()')->first()->id ]);

            // associo le categorie casualmente (una o due per articolo)
            $article->categories()->sync($faker->randomElements($categoriesIds, mt_rand(1, 2))); } }


    private function getCategoriesIdsArray()
    {
        $result = [];
        $categories = Category::all();
        foreach($categories as $category)
        {
            $result[] = $category->id;
        }
        return $result;
    }
}