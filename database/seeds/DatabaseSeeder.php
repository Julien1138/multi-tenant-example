<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Blog;
// use App\Article;

use Hyn\Tenancy\Models\Website;
use Hyn\Tenancy\Models\Hostname;
use Hyn\Tenancy\Environment;

use Hyn\Tenancy\Contracts\Repositories\WebsiteRepository;
use Hyn\Tenancy\Contracts\Repositories\HostnameRepository;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //suppression du contenu des tables
        DB::table('users')->delete();
        DB::table('blogs')->delete();
        DB::table('websites')->delete();
        DB::table('hostnames')->delete();
        DB::table('customers')->delete();
        // DB::table('articles')->delete();

        $fakeUser = User::create(array(
            'name'      => 'FakeUser',
            'email'     => 'fake@user.com',
            'password'  => bcrypt('secret')
        ));

        $blog1 = Blog::create(array(
            'name'     => 'Premier Blog',
        ));

        $website = new Website;
        app(WebsiteRepository::class)->create($website);
        dump($website->uuid); // Unique id

        $hostname = new Hostname;
        $hostname->fqdn = 'premierblog.multitenant';
        app(HostnameRepository::class)->attach($hostname, $website);
        dump($website->hostnames); // Collection with $hostname
        
        $tenancy = app(Environment::class);

        $tenancy->hostname($hostname);

        $tenancy->hostname(); // resolves $hostname as currently active hostname
        $tenancy->website(); // resolves $website
        $tenancy->customer(); // resolves $customer

        $tenancy->identifyHostname(); // resets resolving $hostname by using the Request

        Storage::disk('tenant')->put('readme.md', 'Hi John.');

        // $article1 = Article::create(array(
        //     'title'     => 'Premier article',
        //     'content'   => 'Un contenu pour ce permier article',
        // ));
    }
}
