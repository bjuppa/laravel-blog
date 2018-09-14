<?php

namespace Bjuppa\LaravelBlog\Database\Seeds;

use Illuminate\Database\Seeder;

class StylingTestEntriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Bjuppa\LaravelBlog\Eloquent\BlogEntry::create([
            'title' => 'A short title',
            'content' => "This is the first paragraph.\n\nThis is the second paragraph.",
            'summary' => "A short summary.",
            'author_name' => 'Jane Doe',
            'publish_after' => now(),
        ]);

        \Bjuppa\LaravelBlog\Eloquent\BlogEntry::create([
            'title' => 'A very long title with many but rather short words that will really put things to the test when it comes to available space',
            'content' => "There are so many words in that title, let's keep the contents shorter.",
            'author_name' => 'E. Mail',
            'author_email' => 'e.mail@example.com',
            'publish_after' => now(),
        ]);

        \Bjuppa\LaravelBlog\Eloquent\BlogEntry::create([
            'title' => 'Did you know that pneumonoultramicroscopicsilicovolcanoconiosis is the longest word in an english dictionary?',
            'content' => <<<EOT
The longest word in an english dictionary is Pneumonoultramicroscopicsilicovolcanoconiosis but there are place names that are longer.
For example Taumatawhakatangihangakoauauotamateaturipukakapikimaungahoronukupokaiwhenuakitanatahu, which is a hill in New Zealand.

The [Wikipedia article](https://en.wikipedia.org/wiki/Longest_word_in_English) contains more information.
EOT
            ,
            'summary' => <<<EOT
Pneumonoultramicroscopicsilicovolcanoconiosis and Taumatawhakatangihangakoauauotamateaturipukakapikimaungahoronukupokaiwhenuakitanatahu  are long words.

The [Wikipedia article](https://en.wikipedia.org/wiki/Longest_word_in_English) contains more information.
EOT
            ,
            'meta_tags' => [],
            'author_name' => 'Web Site',
            'author_url' => 'https://en.wikipedia.org/wiki/Website',
            'publish_after' => now(),
        ]);

        \Bjuppa\LaravelBlog\Eloquent\BlogEntry::create([
            'title' => 'A post with images',
            'image' => 'https://upload.wikimedia.org/wikipedia/commons/c/c4/PM5544_with_non-PAL_signals.png',
            'content' => <<<EOT
This paragraph contains an image
![Yawning Norwegian Forest Cat](https://upload.wikimedia.org/wikipedia/commons/1/1c/Yawning_Norwegian_Forest_Cat.JPG "By User:Mattes [Public domain], from Wikimedia Commons")
inline in the text.

![Yawning Norwegian Forest Cat](https://upload.wikimedia.org/wikipedia/commons/1/1c/Yawning_Norwegian_Forest_Cat.JPG "By User:Mattes [Public domain], from Wikimedia Commons")

Above this paragraph is a separate image.
EOT
            ,
            'publish_after' => now(),
        ]);

        \Bjuppa\LaravelBlog\Eloquent\BlogEntry::create([
            'title' => 'A reasonably long title',
            'content' => "This is the first paragraph.\n\nThis is the second paragraph.",
            'publish_after' => now(),
        ]);
    }
}
