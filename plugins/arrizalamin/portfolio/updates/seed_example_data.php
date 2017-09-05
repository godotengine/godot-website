<?php namespace ArrizalAmin\Portfolio\Updates;

use ArrizalAmin\Portfolio\Models\Category;
use ArrizalAmin\Portfolio\Models\Item;
use ArrizalAmin\Portfolio\Models\Tag;
use October\Rain\Database\Updates\Seeder;

class SeedExampleData extends Seeder
{

    public function run()
    {
        // exit when items are found
        if(Item::count()) {
            return false;
        }

        /**
         * Add example category
         */
        $ec = Category::create([
            'name' => 'Examples',
            'slug' => 'examples'
        ]);

        /**
         * Add example tag
         */
        $t1 = Tag::create([
            'name' => 'one',
        ]);

        /**
         * Add example item
         */
        $i1 = Item::create([
            'category_id' => $ec->id,
            'title' => 'Proactively disseminate',
            'slug' => 'proactively',
            'description' => 'Proactively disseminate parallel markets after open-source e-services. Quickly administrate goal-oriented sources through turnkey human capital. Intrinsicly transition installed base schemas with reliable resources. Proactively leverage other\'s compelling mindshare with interoperable applications. Holisticly aggregate transparent metrics through just in time value. Conveniently target pandemic paradigms through leading-edge intellectual capital. Authoritatively create next-generation products rather than reliable platforms. Dramatically predominate robust materials rather than principle-centered innovation. Quickly simplify market positioning niches through equity invested outsourcing. Intrinsicly integrate progressive niche markets.',
        ]);

        $i1->tags()->attach($t1->id);

        //TODO: find a way to attach sample images to the items.
    }

}
